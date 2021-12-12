@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg mb-10">
      <a href="{{route('posts')}}" class="text-2xl ml-6 text-purple-500"><i class="fas fa-arrow-left"></i> Go back</a>
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-2 text-gray-600">{{$user->name}}</h1>
      </div>
      <ul class="ml-6 mb-4">
        <li>
          <p>Total posts created: {{ ($posts->count()) }}</p> {{-- Counts the entities in the array --}}
        </li>
        <li>
          <p>Total likes received: {{$user->receivedLikes->count()}} </p> {{-- taken from User model relationship --}}
        </li>
        <li>
          <p>Total comments made under posts: {{ ($user->comments->count()) }}</p>
        </li>
        <li>
          <p>Total comments received under posts: {{ ($user->receivedComments->count()) }}</p>
        </li>
      </ul>      
      <div class="rounded-lg">
        @if ($posts->count()) {{-- If we have posts then show posts --}}
        <p  class="text-xl font-medium text-gray-600 mb-2 ml-6">User's posts:</p>

        @foreach ($posts as $post)
          <x-post :post="$post"/> {{-- Takes in the post component which can be reused --}}
        @endforeach
    
        {{$posts->links()}} {{-- pagination --}}
    
        @else {{-- If there are NO posts then show this text --}}
          <p>{{ $user->name }} does not have any posts yet</p>
        @endif
      </div>
    </div>
  </div>
@endsection