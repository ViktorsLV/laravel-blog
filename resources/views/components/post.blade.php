@props(['post' => $post])

{{-- TODO: Add save functionality --}}
{{-- TODO: Comments? --}}
{{-- TODO: Tags --}}

<div class="mb-4 bg-white p-6 pb-4 rounded-lg hover:shadow-md">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{ $post->user->name }}</a> <span
        class="text-gray-600 ml-2 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <p><a href="{{route('posts.show', $post)}}"
            {{-- class="mb-2 font-bold text-2xl hover:text-purple-400">{{Str::of($post->title)->limit(60, ' (...)')}}</a> --}} {{-- The easier way with Laravel built in method --}}
            class="mb-2 font-bold text-2xl hover:text-purple-400"> {{strlen($post->title) > 50 ? substr($post->title, 0, 50)."(...)" : $post->title}} {{-- the way with php and ternary operator --}}
            {{-- ( https://www.php.net/manual/en/function.substr.php ) --}}
        </a>
    </p>

    {{-- <p class="mb-2">{{ $post->body }}</p> --}}

    <div class="flex flex-row mt-4">
        @auth
        @if (!$post->likedBy(auth()->user()))
        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
            @csrf
            {{-- <button type="submit" class="text-blue-600 mr-2">Like</button> --}}
            <button
                class="transform motion-safe:hover:scale-110 mr-2 text-white bg-blue-500 py-1 px-3 rounded-xl hover:bg-blue-600">Like</button>
        </form>
        @else
        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="transform motion-safe:hover:scale-110 mr-2 text-blue-500 border-blue-500 py-1 px-3 rounded-xl border-2 hover:border-blue-600 hover:bg-blue-50">Unlike</button>
        </form>
        @endif
        @endauth

        {{-- TODO: add icons --}}
        <span class="mt-1">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        {{--(https://laravel.com/docs/8.x/helpers#strings) using string helpers conferts the word to its plural form
        --}}
        <span class="mt-1 ml-3">{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count())
            }}</span> {{--(https://laravel.com/docs/8.x/helpers#strings) using string helpers conferts the word to its
        plural form --}}

    </div>


    @auth
    <div class="text-right flex flex-row justify-end">
        {{-- TODO: add icons --}}
        @if (!$post->ownedBy(auth()->user())) {{-- If the post belongs to a user he cannot save it --}}
        <div>
            @if (!$post->savedBy(auth()->user())) {{-- if the post isnt saved by user -> show "save" option --}}
            <form action="{{ route('posts.save', $post->id) }}" method="post" class="mr-1">
                @csrf
                <button
                    class="transform motion-safe:hover:scale-110 mr-2 text-white bg-blue-500 py-1 px-6 rounded-xl hover:bg-blue-600">Save post</button>
            </form>
            @else {{-- otherwise -> show "unsave" option --}}
            <form action="{{ route('posts.save', $post->id) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="transform motion-safe:hover:scale-110 mr-2 text-blue-500 border-blue-500 py-1 px-3 rounded-xl border-2 hover:border-blue-600 hover:bg-blue-50">Unsave</button>
            </form>
            @endif
        </div>
        @endif
        <div>
            @if ($post->ownedBy(auth()->user()))
            <div class="flex flex-row">
                <a href="{{route('posts.edit', $post)}}">
                    <button class="border-purple-500 border-2 text-purple-500 px-4 py-2 mr-2 rounded-2xl font-medium hover:bg-purple-200">Edit Post</button>
                </a>
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                    class="border-red-500 text-red-500 border-2 px-4 py-2 mr-2 rounded-2xl font-medium hover:bg-red-200">Delete Post</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endauth
</div>