@extends('layouts.app') {{-- layouts/app --}}  {{-- inputs the section below into the app file where "yield" was specified --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-gray-50 p-6 rounded-lg text-center">
      <h1 class="text-5xl mb-2 font-bold mt-4 text-gray-600">Welcome to BlogIT!</h1>
      <p class="text-2xl mb-2 font-bold mt-4 text-gray-600">A blog for everybody</p>

      <div class="mt-10">
        <img src="{{ asset('images/home_banner.svg') }}" alt="" width="450" class="mx-auto"> 
      </div>

      <div class="mx-auto text-center mt-10">
        <a href="{{route('posts')}}"><button class="mb-2 bg-purple-500 text-white px-4 py-3 rounded font-medium w-2/12 hover:bg-purple-600"> Explore <i class="fas fa-arrow-right ml-2 mt-1"></i></button> </a> 
      </div>
    </div>
  </div>
@endsection