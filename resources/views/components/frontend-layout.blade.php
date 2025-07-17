@extends("frontend.layouts.master")
@section('title', config('app.name', 'healthcare.lk'))

@if (isset($styles))
   @section('styles')
      {{ $styles }}
   @endsection
@endif

@section('breadcrumb-items')
   @if (isset($breadcrumb_items))
      {{ $breadcrumb_items }}
   @endif
@endsection

@section('content')
   {{ $slot }}
@endsection

@if (isset($scripts))
   @section('scripts')
      {{ $scripts }}
   @endsection
@endif
