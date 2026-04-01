<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Naujas blog įrašas
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Pavadinimas</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        class="w-full rounded-md bg-gray-950 border border-gray-700 text-white px-3 py-2"
                    >
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Trumpas aprašymas</label>
                    <textarea
                        name="excerpt"
                        rows="3"
                        class="w-full rounded-md bg-gray-950 border border-gray-700 text-white px-3 py-2"
                    >{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Nuotrauka</label>
                    <input
                        type="file"
                        name="image"
                        class="w-full rounded-md bg-gray-950 border border-gray-700 text-white px-3 py-2"
                    >
                    @error('image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1">Turinys</label>
                    <textarea
                        name="content"
                        rows="8"
                        class="w-full rounded-md bg-gray-950 border border-gray-700 text-white px-3 py-2"
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-500 transition"
                    >
                        Išsaugoti
                    </button>

                    <a
                        href="{{ route('blog.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-gray-700 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition"
                    >
                        Atgal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>