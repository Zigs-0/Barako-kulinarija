<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('user')
        ->where('status', 'published')
        ->latest()
        ->get();

    return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $blogPost)
    {
        if ($blogPost->status !== 'published') {
            abort(404);
        }
    
        return view('blog.show', compact('blogPost'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog-images', 'public');
        }
    
        BlogPost::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'image' => $imagePath,
            'status' => 'published',
        ]);
    
        return redirect()->route('blog.index')->with('success', 'Įrašas sukurtas.');
    }

    public function edit(BlogPost $blogPost)
    {
        abort_unless($blogPost->user_id === auth()->id(), 403);

        return view('blog.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        abort_unless($blogPost->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'excerpt' => ['nullable', 'max:500'],
            'content' => ['required', 'min:50'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog-images');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . $blogPost->id;
        $validated['status'] = 'pending';

        $blogPost->update($validated);

        return redirect()->route('blog.show', $blogPost->slug);
    }

    public function destroy(BlogPost $blogPost)
    {
        abort_unless($blogPost->user_id === auth()->id(), 403);

        $blogPost->delete();

        return redirect()->route('blog.index')->with('success', 'Įrašas ištrintas.');
    }
}
