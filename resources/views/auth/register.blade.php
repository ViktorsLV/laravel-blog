@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-4/12 bg-purple-100 p-6 rounded-md">
      {{-- TODO: add heading --}}

      <form action="{{route('register')}}" method="post">
        @csrf {{-- Cross-site request forgerie protector - CSRF token allows middleware to validate the request (creates a hidden input with a value?) --}} 
        <div class="mb-4">
          <label for="name" class="sr-only">Name</label>
          {{-- old('') - helps with reading old session data and if on form submit some values are incorrect the form doesn't go completely empty but saves the old values - ( https://laravel.com/docs/8.x/requests#retrieving-old-input )--}}
          <input type="text" name="name" id="name" class="bg-white-100 border-2 w-full p-4 rounded-lg @error('name') border-red-400 @enderror" value="{{ old('name')}}" placeholder="Your name">

          @error('name') {{--( https://laravel.com/docs/8.x/blade#validation-errors ) - link to error handling on frontend --}}
            <div class="text-red-400 mt-4 text-sm">
                {{$message}}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="username" class="sr-only">Username</label>
          <input type="text" name="username" id="username" class="bg-white-100 border-2 w-full p-4 rounded-lg @error('username') border-red-400 @enderror" value="{{ old('username')}}" placeholder="Username">

          @error('username')
            <div class="text-red-400 mt-4 text-sm">
                {{$message}}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="sr-only">Email</label>
          <input type="text" name="email" id="email" class="bg-white-100 border-2 w-full p-4 rounded-lg @error('email') border-red-400 @enderror" value="{{ old('email')}}" placeholder="Email">

          @error('email')
            <div class="text-red-400 mt-4 text-sm">
                {{$message}}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="bg-white-100 border-2 w-full p-4 rounded-lg @error('password') border-red-400 @enderror" value="" placeholder="Password">

          @error('password')
            <div class="text-red-400 mt-4 text-sm">
                {{$message}}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="sr-only">Password again</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="bg-white-100 border-2 w-full p-4 rounded-lg" value="" placeholder="Repeat your password">

          {{-- @error('password_confirmation')
            <div class="text-red-400 mt-4 text-sm">
                {{$message}}
            </div>
          @enderror --}}
        </div>

        <button type="submit" class="bg-purple-400 text-white px-4 py-3 rounded font-medium w-full hover:bg-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">Register</button>
      </form>

      {{-- TODO: add "log in button" --}}
    </div>
  </div>
@endsection