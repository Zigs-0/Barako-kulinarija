<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Blog
            </h2>

            @auth
                <a href="{{ route('blog.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition">
                    + Naujas įrašas
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @forelse($posts as $post)
            <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden mb-6">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-64 object-cover">
                @endif

                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-2">
                        {{ $post->title }}
                    </h3>

                    <p class="text-sm text-gray-400 mb-3">
                        {{ $post->user->name ?? 'Autorius' }}
                        •
                        {{ $post->created_at->format('Y-m-d') }}
                    </p>

                    @if($post->excerpt)
                        <p class="text-gray-300 mb-3">
                            {{ $post->excerpt }}
                        </p>
                    @endif

                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="text-pink-400 hover:text-pink-300 font-medium">
                        Skaityti daugiau
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-gray-900 border border-gray-800 rounded-xl p-6 text-gray-300">
                Kol kas blog įrašų nėra.
            </div>
        @endforelse
    </div>
</x-app-layout>