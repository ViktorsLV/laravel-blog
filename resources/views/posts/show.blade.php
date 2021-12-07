{{-- file for showing single post --}}
@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
      {{-- TODO: Back button --}}
      <x-singlepost :post="$post"/>
    </div>
  </div>
@endsection