@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-white-100 rounded-md flex felx-row border-4 border-purple-100">

      <div class="w-6/12 bg-white-100 p-6 mt-0">
        <h1 class="text-3xl mb-2 font-bold text-gray-600">BlogIT</h1>
        <div class="bg-white p-6 rounded-md text-center mx-auto mt-10 text-gray-600">
          <img src="{{ asset('images/auth.svg') }}" alt="" width="250" class="mx-auto"> 
          <h1 class="text-2xl mb-2 font-bold mt-4">Login securely</h1>
          <p>Log in and discover new blog posts</p>
        </div>
      </div>
    
      <div class="w-6/12 bg-purple-100 p-6">

          @if (session('status')) 
          <div class="bg-red-400 rounded-md mb-6 p-3 text-white text-center">
            {{ session('status') }}
          </div>
          @endif
          
          <form action="{{route('login')}}" method="post" class="mt-10">
            @csrf
            <div class="mb-4">
              <label for="email" class="sr-only">Email</label>
              <input type="text" name="email" id="email" class="bg-white border-2 w-full p-4 rounded-lg @error('email') border-red-400 @enderror" value="{{ old('email')}}" placeholder="Email">

              @error('email')
                <div class="text-red-400 mt-4 text-sm">
                    {{$message}}
                </div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="password" class="sr-only">Password</label>
              <input type="password" name="password" id="password" class="bg-white border-2 w-full p-4 rounded-lg @error('password') border-red-400 @enderror" value="" placeholder="Password">

              @error('password')
                <div class="text-red-400 mt-4 text-sm">
                    {{$message}}
                </div>
              @enderror
            </div>

            {{-- for remembering user when logging in --}}
            {{-- TODO: actually remember the user --}}
            <div class="mb-4">
              <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember me</label>
              </div>
            </div>

            {{-- TODO: add register link --}}

            <button type="submit" class="bg-purple-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">Login</button>
            <p class="text-center mt-2">Don't have an account? <a class="text-blue-500 hover:text-blue-700" href="{{route('register')}}">Register here</a> </p>
          </form>
      </div>

    </div>
  </div>
@endsection