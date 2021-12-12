@extends('layouts.app') {{-- layouts/app --}}

@section('content')
<div class="flex justify-center">
  <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    @auth
    <div class="bg-white p-6 rounded-lg mb-10">
      <form action="{{route('posts')}}" method="post">
        <div class="text-2xl font-medium mb-5 text-gray-600">Let the people know what's on your mind:</div>
        @csrf
        <div class="mb-2">
          <label for="title" class="sr-only">Title</label>
          <textarea type="text" name="title" id="title" cols="30" rows="1"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror"
            value="{{ old('title')}}" placeholder="Post Title"></textarea>

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
  </div>
</div>
@endsection