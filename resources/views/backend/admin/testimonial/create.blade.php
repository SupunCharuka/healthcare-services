@extends('backend.layouts.master')
@section('title', 'Create Testimonials')
@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.css') }}">

@endsection
@section('breadcrumb-title', 'Create Testimonial')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Create Testimonial</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">


                <div class="card-body">
                    <livewire:admin.testimonial.create />
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
    <script src="{{ asset('js/admin/testimonials/testimonial.js') }}"></script>
@endsection
