@extends('layouts.app') {{-- layouts/app --}}

@section('content')
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
    {{-- TODO: add back button  --}}
      <div class="p-6">
        <h1 class="text-2xl font-medium mb-2 text-gray-600">{{$user->name}}</h1>
        {{-- TODO: crete user stats? --}}
        
      </div>
      
    </div>
  </div>
@endsection