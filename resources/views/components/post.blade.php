@props(['post' => $post])

{{-- TODO: add save functionality --}}
{{-- TODO: Click to single post view --}}
{{-- TODO: Title --}}
{{-- TODO: Comments? --}}
{{-- TODO: Tags --}}

<div class="mb-4 bg-white p-6 rounded-lg hover:shadow-md">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{ $post->user->name }}</a> <span
        class="text-gray-600 text-sm">{{
        $post->created_at->diffForHumans() }}</span>

    <p class="mb-2">{{ $post->body }}</p>

    <div class="flex flex-row">
        @auth
        @if (!$post->likedBy(auth()->user()))
        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
            @csrf
            {{-- <button type="submit" class="text-blue-600 mr-2">Like</button> --}}
            <button class="transform motion-safe:hover:scale-110 mr-2 text-white bg-blue-500 py-1 px-3 rounded-xl hover:bg-blue-600">Like</button>
        </form>
        @else
        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="transform motion-safe:hover:scale-110 mr-2 text-blue-500 border-blue-500 py-1 px-3 rounded-xl border-2 hover:border-blue-600">Unlike</button>
        </form>
        @endif
        @endauth

        <span class="mt-1">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span> {{--
        (https://laravel.com/docs/8.x/helpers#strings) using string helpers conferts the word to its plural form --}}
    </div>

    @if ($post->ownedBy(auth()->user()))
    <div class="text-right">
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-3xl font-medium hover:bg-red-600">Delete</button>
        </form>
    </div>
    @endif
</div>