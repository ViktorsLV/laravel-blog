@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    {{-- TODO: add back button  --}}
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-2 text-gray-600">{{$user->name}}</h1>
        {{-- TODO: crete user stats? --}}
        {{-- <p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}} and received {{$user->receivedLikes->count()}} likes</p> --}}
        <p  class="text-xl font-medium text-gray-600">User's posts:</p>
      </div>

      <div class="rounded-lg">
        @if ($posts->count()) {{-- If we have posts then show posts --}}

        @foreach ($posts as $post)
          <x-post :post="$post"/> {{-- Takes in the post component which can be reused --}}
        @endforeach
    
        {{$posts->links()}}
    
        @else {{-- If there are NO posts then show this text --}}
          <p>{{ $user->name }} does not have any posts yet</p>
        @endif
      </div>
    </div>
  </div>
@endsection