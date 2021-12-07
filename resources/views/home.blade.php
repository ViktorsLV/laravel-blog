@extends('layouts.app') {{-- layouts/app --}}  {{-- inputs the section below into the app file where "yield" was specified --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
      Home

      {{-- TODO: greet the user (with users name from User obj), create a banner (telling what is this app about--}}
      {{-- TODO: if user is not logged in -> prompt to log in and show some banner --}}
      {{-- TODO: Show some sections with statistics -> how many total posts the blog has, how many people have joined, how many tags have been created? --}}
    </div>
  </div>
@endsection