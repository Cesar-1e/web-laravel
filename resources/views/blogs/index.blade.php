<x-forum.layouts.app>
    <div class="my-8">

        @foreach ($blogs as $blog)

        <div class="mb-4">
            <h2 class="text-2xl font-bold">
                <a href="{{ route('blogs.show', $blog) }}" class="hover:underline">
                    {{ $blog->title }}
                </a>
            </h2>

            <div class="flex gap-2">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">{{ $blog->user->name }}</span> |
                    {{ $blog->category->name }} |
                    {{ $blog->created_at->diffForHumans() }}
                </p>
            </div>
        </div>

        @endforeach

        {{ $blogs->links() }}
    </div>
</x-forum.layouts.app>