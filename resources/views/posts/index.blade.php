@extends('layouts.app') {{-- layouts/app --}}

{{-- POSSIBLE FEATURES AFTER BLOG IS DEVELOPED --}}
{{-- TODO: Filtering? (Most liked, most recent) --}}
{{-- TODO: Calculate how long is the reading time? --}}
{{-- TODO: Social accounts? --}}
{{-- TODO: Pagination --}} 
{{-- TODO: Likes under posts --}} 
{{-- TODO: Use markdown? --}} 

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-white p-6 rounded-lg">
    <form action="{{route('posts')}}" method="post">
      <div class="text-2xl font-medium mb-5">Posts</div>
      @auth
      @csrf
        <div class="mb-4">
          <label for="body" class="sr-only">Body</label>
          <textarea type="text" name="body" id="body" cols="30" rows="4"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
            value="{{ old('body')}}" placeholder="Post something!"></textarea>

          @error('body')
          <div class="text-red-500 mt-4 text-sm">
            {{$message}}
          </div>
          @enderror
        </div>
        <button type="submit" class="mb-2 bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Post</button>
      @endauth
    </form>

    @if ($posts->count()) {{-- If we have posts then show posts  --}}

    @foreach ($posts as $post)
     {{-- TODO: Create component --}}
     {{-- TODO: Go to single post --}}
     <div class="mb-4">
       <a href="" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
       
       <p class="mb-2">{{ $post->body }}</p>     
      </div>
    @endforeach

    {{$posts->links()}}

    @else {{-- If there are NO posts then show this text --}}
      <p>No posts here yet</p>
    @endif
  </div>
</div>
@endsection