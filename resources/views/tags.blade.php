@extends('layouts.app') {{-- layouts/app --}}  {{-- inputs the section below into the app file where "yield" was specified --}}

@section('content')
{{-- A page where tags can be listed ..  --}}
  <div class="flex justify-center">
    <div class="w-8/12 bg-purple-100 p-6 rounded-lg">
      Tags
    </div>
  </div>
@endsection