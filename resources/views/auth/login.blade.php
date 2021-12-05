@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-4/12 bg-purple-100 p-6 rounded-md">
      @if (session('status')) 
        <div class="bg-red-400 rounded-md mb-6 p-3 text-white text-center">
          {{ session('status') }}
        </div>
      @endif

      <form action="{{route('login')}}" method="post">
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

        <button type="submit" class="bg-purple-400 text-white px-4 py-3 rounded font-medium w-full hover:bg-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">Login</button>
      </form>
    </div>
  </div>
@endsection