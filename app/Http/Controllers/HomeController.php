<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $latestRecipes = Recipe::query()
            ->with('category')
            ->latest()
            ->take(3)
            ->get();

        $latestBlogPosts = BlogPost::query()
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('latestRecipes', 'latestBlogPosts'));
    }
}