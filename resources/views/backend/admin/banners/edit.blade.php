@extends('backend.layouts.master')
@section('title', 'Banner')
@section('styles')

@endsection
@section('breadcrumb-title', 'Manage Banners')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.banner') }}">Banners</a></li>
    <li class="breadcrumb-item active">Edit Banner</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-body">
                    <livewire:admin.banner.edit :banner="$banner"/>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
@endsection
