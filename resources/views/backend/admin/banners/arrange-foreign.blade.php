@extends('backend.layouts.master')
@section('title', 'Arrange Banners')

@section('styles')
@endsection

@section('breadcrumb-title', 'Arrange Banners')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.banner') }}">Banners</a></li>
    <li class="breadcrumb-item active">Arrange</li>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="row ui-sortable" id="draggableMultiple" data-banner="{{ $banner->id }}">
            @foreach ($banners as $banner)
                <div class="col-auto col-sm-6" data-id="{{ $banner->id }}">
                    <div class="card">
                        <div class="card-body p-2">
                            <img src="{{ storage('uploads/banners/' . $banner->image) }}">
                            <h5 class="card-text text-center mt-2"><strong>{{ $banner->title }}</strong></h5>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/notify/notify-script.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/dragable/sortable.js') }}"></script>
    <script src="{{ asset('js/admin/banners/arrange-foreign.js') }}"></script>
@endsection
