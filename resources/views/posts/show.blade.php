{{-- file for showing single post --}}
@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
      {{-- {{ URL::previous() }} -- to go route back --}}
      <a href="{{route('posts')}}" class="text-2xl text-purple-500"><i class="fas fa-arrow-left"></i> Go back</a>
      <x-singlepost :post="$post"/>
    </div>
  </div>
@endsection