@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 ">
    {{-- TODO: add back button  --}}
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-1">{{$user->name}}</h1>
        {{-- TODO: crete user stats? --}}
        <p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}} and received {{$user->receivedLikes->count()}} likes</p>
      </div>

      <div class="bg-white p-6 rounded-lg">
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