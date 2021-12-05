<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/app.css')}}"> {{-- importing tailwind css --}}
  <title>Laravel Blog</title>
</head>
<body class="bg-white">
  <nav class="p-6 bg-purple-400 flex justify-between mb-6 text-white">
    <ul class="flex items-center">
      <li>
        <a href="/" class="p-3">Home</a>
      </li>
      <li>
        <a href="{{route('posts')}}" class="p-3">Posts</a>
      </li>
      <li>
        <a href="{{route('tags')}}" class="p-3">Tags</a>
      </li>
      <li>
        <a href="{{route('saved')}}" class="p-3">Saved</a>
      </li>
    </ul>

    {{-- TODO: show only when not logged in --}}
    {{-- some UI elements that should be visible depending on application/user state - logged in/not  --}}
    <ul class="flex items-center">
      <li>
        <a href="" class="p-3"> USERNAME </a>
      </li>
      {{-- TODO: Profile? --}}
      <li>
        {{-- <form action="{{route('logout')}}" method="post" class="inline p-3"> --}}
          <button type="submit" class="">Logout</button>
        {{-- </form> --}}
      </li>

      <li>
        <a href="{{route('login')}}" class="p-3">Login</a>
      </li>
      <li>
        <a href="{{route('register')}}" class="p-3">Register</a>
      </li>
            
    </ul>
  </nav>

  @yield('content') {{-- content from other folders will go here --}}
</body>
</html>