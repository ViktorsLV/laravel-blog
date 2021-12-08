@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg mb-10">
    {{-- TODO: add back button  --}}
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-2 text-gray-600">{{$user->name}}</h1>
        {{-- TODO: crete user stats? --}}
        <ul>
          <li>
            <p>Total posts created: {{ ($posts->count()) }}</p>
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
          <li>
            <p>Total posts <a href="{{route('saved', auth()->user())}}" class="text-blue-500 hover:underline"> saved</a>: {{ ($user->saves->count()) }}</p>
          </li>
        </ul>
      </div>
      
      <div class="rounded-lg">
        @if ($posts->count()) {{-- If we have posts then show posts --}}
        <p  class="text-xl font-medium text-gray-600 mb-2">My posts:</p>

        @foreach ($posts as $post)
          <x-post :post="$post"/> {{-- Takes in the post component which can be reused --}}
        @endforeach
    
        {{$posts->links()}}
    
        @else {{-- If there are NO posts then show this text --}}
        <div class="mt-10 text-center">
          <img src="{{ asset('images/noposts.svg') }}" alt="" width="250" class="mx-auto"> 
          <p class="mt-4"> You don't have any posts saved yet</p>
        </div>
        @endif
      </div>
    </div>
  </div>
@endsection