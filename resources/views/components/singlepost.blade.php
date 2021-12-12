@props(['post' => $post])

{{-- TODO: Tags --}}
{{-- TODO: Add user avatar --}}

<div class="mb-4 bg-white p-6 pb-4 rounded-lg hover:shadow-md">
    <div class="flex flex-col">
        <div class="flex flex-row w-12/12 justify-between">
            <div class="flex flex-col">
                <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{ $post->user->name }}</a>
                <span class="text-gray-600 text-sm">Posted {{ $post->created_at->diffForHumans() }}</span>
            </div>
                
            @auth
            @if (!$post->ownedBy(auth()->user())) {{-- If the post belongs to a user he cannot save it --}}
            <div class="">
                @if (!$post->savedBy(auth()->user())) {{-- if the post isnt saved by user -> show "save" option --}}
                <form action="{{ route('posts.save', $post->id) }}" method="post" class="mr-1">
                    @csrf
                    <button
                    class="transform motion-safe:hover:scale-110 mr-2 text-white bg-purple-500 py-2 px-4 rounded-xl hover:bg-purple-600"><i class="far fa-bookmark"></i> Save post</button>
                </form>
                @else {{-- otherwise -> show "unsave" option --}}
                <form action="{{ route('posts.save', $post->id) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                    class="transform motion-safe:hover:scale-110 mr-2 text-purple-500 border-purple-500 py-1 px-3 rounded-xl border-2 hover:border-purple-600 hover:bg-purple-50"><i class="fas fa-bookmark"></i> Unsave</button>
                </form>
                @endif
            </div>
            @endif
            @endauth
        </div>

        <div class="border-2 border-gray-400 rounded-lg p-4 mt-4">
            <p class="mt-4 mb-2 font-bold text-3xl"> {{ $post->title }} </p>
            
            <p class="mb-2 mt-10">{{ $post->body }}</p>
        </div>
    </div>

    <div class="flex flex-col mt-4">
        <div class="flex flex-row">
            @auth
            @if (!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                @csrf
                {{-- <button type="submit" class="text-blue-600 mr-2">Like</button> --}}
                <button
                class="transform motion-safe:hover:scale-110 mr-2 text-white bg-purple-500 py-1 px-3 rounded-xl hover:bg-purple-600"><i class="fas fa-thumbs-up fa-1x mr-1 text-white"></i> Like</button>
            </form>
            @else
            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                class="transform motion-safe:hover:scale-110 mr-2 text-purple-500 border-purple-500 py-1 px-3 rounded-xl border-2 hover:border-purple-600 hover:bg-purple-50"><i class="fas fa-thumbs-down text-purple-500 fa-1x mr-1"></i> Unlike</button>
            </form>
            @endif
            @endauth

            <span class="mt-1">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span> {{--
            (https://laravel.com/docs/8.x/helpers#strings) using string helpers conferts the word to its plural form
            --}}
        </div>

        <div class="mt-10 mb-5">
            <div class="text-2xl font-medium mb-3 text-gray-600">Comments ({{ $post->comments->count() }})</div>
            @auth
            <form action="{{route('posts.comments', $post->id)}}" method="post">

                <div class="text-lg font-medium mb-2 text-gray-600">Add your comment:</div>
                @csrf
                <div class="mb-2 w-8/12">
                    <label for="commentBody" class="sr-only">Comment Body</label>
                    <textarea type="text" name="commentBody" id="commentBody" cols="10" rows="2"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('commentBody') border-red-500 @enderror"
                        value="{{ old('commentBody')}}" placeholder="Type here..."></textarea>

                    @error('commentBody')
                    <div class="text-red-500 mt-4 text-sm">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit"
                    class="mb-2 bg-purple-500 text-white px-4 py-3 rounded font-medium w-2/12 hover:bg-purple-600">Post</button>
            </form>
            @endauth
        </div>

        @if ($post->comments->count()) {{-- If we have any comments to sho, then ... --}}
            <div>

                @foreach ($post->comments as $comment)
                    <div class="mt-1 mb-2 p-5 border-2 border-gray-200 rounded-md ">
                        <div class="mb-2">
                            <a href="" class="font-bold">{{ $comment->user->name }}</a> {{-- taken from Comment model where relationship was made with user --}}
                            <span class="text-gray-600 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p >{{ $comment->commentBody }}</p>
                    </div>
                @endforeach

                {{-- {{$posts->links()}} --}}
            </div>
        @else {{-- If there are NO posts then show this text --}}
        {{-- TODO: add SVG --}}
           <p>No comments here yet</p>
        @endif

    </div>

    @auth
    @if ($post->ownedBy(auth()->user()))
        <div class="flex flex-row w-12/12 justify-end">
            <a href="{{route('posts.edit', $post->id)}}">
                <button class="border-purple-500 border-2 text-purple-500 px-4 py-2 mr-2 rounded-2xl font-medium hover:bg-purple-200"><i class="fas fa-edit text-purple-500 fa-1x mr-1"></i> Edit Post</button>
            </a>
            <form action="{{ route('posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                class="border-red-500 text-red-500 border-2 px-4 py-2 mr-2 rounded-2xl font-medium hover:bg-red-200"><i class="fas fa-trash text-red-500 fa-1x mr-1"></i>Delete Post</button>
            </form>
        </div>
    @endif
    @endauth
</div>