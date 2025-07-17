@extends('backend.customer.layouts.master')

@section('title', 'Dashboard')

@if (isset($styles))
   @section('styles')
      {{ $styles }}
   @endsection
@endif

       
@section('content')
   {{ $slot }}
@endsection

@if (isset($scripts))
   @section('scripts')
      {{ $scripts }}
   @endsection
@endif
