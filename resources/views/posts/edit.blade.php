@extends('layouts.app') {{-- layouts/app --}}

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    @auth
    <div class="bg-white p-6 rounded-lg mb-10">
      <form action="{{route('posts.edit', $post)}}" method="POST"> {{-- passing the post that needs to be edited --}}
        <div class="text-2xl font-medium mb-5 text-gray-600">Edit this post:</div>
        @if (session('status')) 
          <div class="bg-green-500 rounded-md my-4 p-3 text-white text-center">
            {{ session('status') }}
          </div>
        @endif
        <div class="mb-2">
          <label for="title" class="sr-only">Title</label>
          <textarea type="text" name="title" id="title" cols="30" rows="1"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
            value="{{ $post->title }}" placeholder="Post Title">{{ $post->title }}</textarea>

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
            value="{{ $post->body }}" placeholder="Type here...">{{ $post->body }}</textarea>

          @error('body')
          <div class="text-red-500 mt-4 text-sm">
            {{$message}}
          </div>
          @enderror
        </div>
        @csrf
        @method('PUT')
        <button type="submit" class="mb-2 bg-purple-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-purple-600">Confirm Edit</button>
      </form>
    </div>
    @endauth

  </div>
</div>
@endsection