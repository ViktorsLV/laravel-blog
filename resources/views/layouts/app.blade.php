<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- importing tailwind css --}}
  <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
  <title>BlogIT | IT Blog</title>
</head>
<body class="bg-white">
  <nav class="p-4 bg-purple-400 flex justify-between mb-6 text-white">
    <ul class="flex items-center">

      {{-- A way of displaying Navbar with php code and iteration -> doesnt allow for custom styling --}}
      {{-- @php
          $navLinks = [
              'Home' => route('home'),
              'Posts' => route('posts'),
              'Tags' => route('tags'),
          ];
      @endphp

      @foreach($navLinks as $name => $link)
      <li>
        <a href="{{ $link }}" class="mr-2 p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black">{{ $name }}</a>
      </li>
      @endforeach --}}

      
      <li>
        <a href="/" class="mr-2 {{request()->is('/') ? 'font-medium bg-gray-100 bg-opacity-50 rounded p-2 text-black' : ''}} p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black">Home</a>
      </li>
      <li>
        <a href="{{route('posts')}}" class="mr-2 {{request()->is('posts') || request()->is('posts/*')  ? 'font-medium bg-gray-100 bg-opacity-50 rounded p-2 text-black' : ''}} p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black">Posts</a>
      </li>
      {{-- <li>
        <a href="{{route('tags')}}" class="mr-2 {{request()->is('tags') ? 'font-medium bg-gray-100 bg-opacity-50 rounded p-2 text-black' : ''}} p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black">Tags</a>
      </li> --}}
      @auth
        <li>
          <a href="{{route('saved', auth()->user())}}" class="mr-2 {{request()->is('saved/*') ? 'font-medium bg-gray-100 bg-opacity-50 rounded p-2 text-black' : ''}} p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black">Saved</a>
        </li>
      @endauth
    </ul>

    {{-- some UI elements that should be visible depending on application/user state - logged in/not  --}}
    <ul class="flex items-center">
      @auth {{-- show the block of code only when user IS LOGGED IN --}}
      <li>
        <a href="{{route('user.profile', auth()->user())}}" class="mr-2 {{request()->is('profile/*') ? ' bg-gray-100 bg-opacity-50 rounded p-2 text-black' : ''}} border-2 border-gray-100 p-2 hover:bg-gray-100 hover:bg-opacity-50 rounded hover:text-black"> {{auth()->user()->name}} </a>
      </li>
      <li>
        <form action="{{route('logout')}}" method="post" class="inline"> {{-- has to be a form with CSRF so user cannot be logged out by an attack --}}
          @csrf
          <button type="submit" class="mr-2 hover:bg-gray-100 hover:bg-opacity-50 rounded p-2 hover:text-black">Logout</button> 
        </form>
      </li>
      @endauth

      @guest {{-- show the block of code only when user is NOT LOGGED in  ( https://laravel.com/docs/8.x/blade#authentication-directives ) --}}
      <li>
        <a href="{{route('login')}}" class="p-3 mr-4 hover:opacity-90 hover:text-gray-200">Log in</a>
      </li>
      <li>
        <button class="btn bg-purple-100 ">
          <a href="{{route('register')}}" class="mb-2 bg-purple-500 text-white px-4 py-3 rounded font-medium hover:bg-purple-600">Create account</a>
        </button>
      </li>
      @endguest
            
    </ul>
  </nav>

  @yield('content') {{-- content from other folders will go here --}}
</body>
</html>