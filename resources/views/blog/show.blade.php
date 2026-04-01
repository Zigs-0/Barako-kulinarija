<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $blogPost->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
            @if($blogPost->image)
                <img src="{{ asset('storage/' . $blogPost->image) }}"
                     alt="{{ $blogPost->title }}"
                     class="w-full h-80 object-cover">
            @endif

            <div class="p-6">
                <p class="text-sm text-gray-400 mb-4">
                    {{ $blogPost->user->name ?? 'Autorius' }}
                    •
                    {{ $blogPost->created_at->format('Y-m-d') }}
                </p>

                @if($blogPost->excerpt)
                    <p class="text-lg text-gray-300 mb-6">
                        {{ $blogPost->excerpt }}
                    </p>
                @endif

                <div class="text-gray-200 whitespace-pre-line">
                    {{ $blogPost->content }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>