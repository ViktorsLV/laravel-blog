@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    {{-- TODO: add back button  --}}
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-2 text-gray-600">Posts saved by you</h1>
        {{-- TODO: crete user stats? --}}
        
      </div>
      
      {{-- {{ dd($posts);}} --}}
      
      <div class="rounded-lg">
        @if ($posts->count()) {{-- If we have posts then show posts --}}
        {{-- <p  class="text-xl font-medium text-gray-600 mb-2">Posts saved by me:</p> --}}
        <div class="text-2xl font-medium mb-3 ml-6 text-gray-600">Saved ({{ $user->savedPosts->count() }})</div>
        @foreach ($posts as $post)
          <x-post :post="$post"/> {{-- Takes in the post component which can be reused --}}
        @endforeach
    
        {{$posts->links()}}
    
        @else {{-- If there are NO posts then show this text --}}
          <p> You don't have any posts yet</p>
        @endif
      </div>
      
    </div>
  </div>
@endsection