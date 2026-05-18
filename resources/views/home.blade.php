<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 space-y-10">

            {{-- HERO --}}
            <section class="rounded-2xl border border-gray-800 bg-gray-900 p-8 md:p-10">
                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div class="space-y-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-100">
                            Barako kulinarija 🍲
                        </h1>
                        <p class="text-gray-300 max-w-xl">
                            Greiti, pigūs ir skanūs receptai studentui.
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('recipes.index') }}"
                           class="px-5 py-2 rounded bg-pink-600 hover:bg-pink-500 text-white font-semibold">
                            Receptai
                        </a>

                        @auth
                            <a href="{{ route('admin.recipes.index') }}"
                               class="px-5 py-2 rounded border border-gray-700 hover:bg-gray-800 text-gray-100">
                                Admin
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-5 py-2 rounded border border-gray-700 hover:bg-gray-800 text-gray-100">
                                Prisijungti
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('recipes.index') }}" class="mt-6 flex flex-col sm:flex-row gap-2">
                    <input name="q" placeholder="Ieškok recepto (pvz. makaronai, vištiena...)"
                           class="w-full rounded border border-gray-700 bg-gray-950 text-gray-100 placeholder-gray-400 px-4 py-3" />
                    <button class="px-5 py-3 rounded bg-pink-600 hover:bg-pink-500 text-white font-semibold">
                        Ieškoti
                    </button>
                </form>
            </section>

            {{-- NAUJAUSI RECEPTAI (3) --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-100">Naujausi receptai</h2>
                    <a class="text-pink-400 hover:text-pink-300 underline" href="{{ route('recipes.index') }}">
                        Visi →
                    </a>
                </div>

                @if(($latestRecipes ?? collect())->isEmpty())
                    <div class="rounded border border-gray-800 bg-gray-900 p-6 text-gray-300">
                        Kol kas nėra receptų.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($latestRecipes as $r)
                            <a href="{{ route('recipes.show', $r->slug) }}"
                               class="rounded-xl border border-gray-800 bg-gray-900 p-5 hover:bg-gray-800 transition">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-400">{{ $r->category?->name ?? '—' }}</div>

                                    @if(!empty($r->video_path) || !empty($r->video_url))
                                        <span class="text-xs px-2 py-1 rounded bg-pink-600 text-white">VIDEO</span>
                                    @endif
                                </div>

                                <div class="mt-2 text-lg font-semibold text-gray-100">{{ $r->title }}</div>

                                @if(!empty($r->description))
                                    <div class="mt-2 text-gray-300">
                                        {{ \Illuminate\Support\Str::limit($r->description, 110) }}
                                    </div>
                                @endif

                                <div class="mt-4 flex flex-wrap gap-3 text-sm text-gray-400">
                                    @if(!empty($r->prep_time)) <span>⏱ {{ $r->prep_time }} min</span> @endif
                                    @if(!empty($r->cook_time)) <span>🔥 {{ $r->cook_time }} min</span> @endif
                                    @if(!empty($r->servings)) <span>🍽 {{ $r->servings }}</span> @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- NAUJAUSI BLOG ĮRAŠAI (3) --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-100">Naujausi įrašai</h2>
                    <a class="text-pink-400 hover:text-pink-300 underline" href="{{ url('/blog') }}">
                        Visi →
                    </a>
                </div>

                @if(($latestBlogPosts ?? collect())->isEmpty())
                    <div class="rounded border border-gray-800 bg-gray-900 p-6 text-gray-300">
                        Kol kas nėra blog įrašų.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($latestBlogPosts as $post)
                            @php
                                $slug = $post->slug ?? null;
                                $href = $slug ? url('/blog/'.$slug) : url('/blog');

                                $title = $post->title ?? 'Įrašas';
                                $excerpt = $post->excerpt
                                    ?? $post->summary
                                    ?? $post->content
                                    ?? $post->body
                                    ?? '';

                                $date = $post->created_at ? $post->created_at->format('Y-m-d') : '';
                            @endphp

                            <a href="{{ $href }}"
                               class="rounded-xl border border-gray-800 bg-gray-900 p-5 hover:bg-gray-800 transition">
                                <div class="text-sm text-gray-400">Blog</div>
                                <div class="mt-2 text-lg font-semibold text-gray-100">{{ $title }}</div>

                                @if($excerpt)
                                    <div class="mt-2 text-gray-300">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($excerpt), 120) }}
                                    </div>
                                @endif

                                @if($date)
                                    <div class="mt-4 text-sm text-gray-400">{{ $date }}</div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>