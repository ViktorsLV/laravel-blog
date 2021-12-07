@extends('layouts.app') {{-- layouts/app --}}

{{-- POSSIBLE FEATURES AFTER BLOG IS DEVELOPED --}}
{{-- TODO: Filtering? (Most liked, most recent) --}}
{{-- TODO: Calculate how long is the reading time? --}}
{{-- TODO: Social accounts? --}}
{{-- TODO: Likes under posts --}}
{{-- TODO: Use markdown? --}}
{{-- TODO: add save functionality --}}

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    <div class="text-2xl font-medium mb-5 text-gray-600">Recent Posts</div>
    @auth
    <div class="bg-white p-6 rounded-lg mb-10">
      <form action="{{route('posts')}}" method="post">
        <div class="text-2xl font-medium mb-5 text-gray-600">Let the people know what's on your mind:</div>
        @csrf
        <div class="mb-2">
          <label for="title" class="sr-only">Title</label>
          <textarea type="text" name="title" id="title" cols="30" rows="1"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
            value="{{ old('title')}}" placeholder="Post Tite"></textarea>

          @error('title')
          <div class="text-red-500 mt-4 text-sm">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="mb-4">
          <label for="body" class="sr-only">Body</label>
          <textarea type="text" name="body" id="body" cols="30" rows="4"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
            value="{{ old('body')}}" placeholder="Type here..."></textarea>

          @error('body')
          <div class="text-red-500 mt-4 text-sm">
            {{$message}}
          </div>
          @enderror
        </div>
        <button type="submit"
          class="mb-2 bg-purple-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-purple-600">Post</button>
      </form>
    </div>
    @endauth

    @if ($posts->count()) {{-- If we have posts then show posts --}}

    @foreach ($posts as $post)
    <x-post :post="$post" /> {{-- Takes in the post component which can be reused --}}
    @endforeach

    {{$posts->links()}}

    @else {{-- If there are NO posts then show this text --}}
    <p>No posts here yet</p>
    @endif
  </div>
</div>
@endsection