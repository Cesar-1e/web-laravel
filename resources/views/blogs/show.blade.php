<x-forum.layouts.app>
    <div class="flex items-center gap-2 w-full my-8">
        <livewire:heart :heartable="$blog" />

        <div class="w-full">
            <h2 class="text-2xl font-bold md:text-3xl">
                {{ $blog->title }}
            </h2>

            <div class="flex justify-between">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">{{ $blog->user->name }}</span> |
                    {{ $blog->category->name }} |
                    {{ $blog->created_at->diffForHumans() }}
                </p>

                <div class="flex items-center gap-2">
                    <a href="{{ route('blogs.edit', $blog) }}" class="text-xs font-semibold hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('blogs.destroy', $blog) }}" onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 hover:bg-red-500 px-2 py-1 text-xs font-semibold text-white cursor-pointer">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4">
        <p class="text-gray-200">
            {{ $blog->content }}
        </p>
        
        <livewire:comment :commentable="$blog" />
    </div>
</x-forum.layouts.app>