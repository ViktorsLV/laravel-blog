@extends('layouts.app') {{-- layouts/app --}}

{{-- POSSIBLE FEATURES AFTER BLOG IS DEVELOPED --}}
{{-- TODO: Filtering? (Most liked, most recent) --}}
{{-- TODO: Calculate how long is the reading time? --}}
{{-- TODO: Social accounts? --}}
{{-- TODO: Use markdown? --}}

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-purple-100 p-6 rounded-lg">

    <div class="flex flex-row w-12/12 justify-between ">
      <div class="text-2xl font-medium mb-5 text-gray-600">Recent Posts</div>
      @auth
      <a href="{{route('posts.create')}}">
        <button  class="transform motion-safe:hover:scale-110 mb-2 text-white bg-purple-500 text-2xl py-2 px-3 rounded-xl hover:bg-purple-600"><i class="fas fa-plus fa-1x mr-1 text-white"></i> Create Post</button>
      </a>
      @endauth
    </div>
    @if ($posts->count()) {{-- If we have posts then show posts --}}

    @foreach ($posts as $post)
      <x-post :post="$post" /> {{-- Takes in the post component which can be reused --}}
    @endforeach

    {{$posts->links()}} {{-- Pagination -> styling is built in with tailwind --}}

    @else {{-- If there are NO posts then show this text --}}
    <div class="mt-10 text-center">
      <img src="{{ asset('images/empty.svg') }}" alt="" width="250" class="mx-auto"> 
      <p class="mt-4"> No posts here</p>
    </div>
    @endif
  </div>
</div>
@endsection