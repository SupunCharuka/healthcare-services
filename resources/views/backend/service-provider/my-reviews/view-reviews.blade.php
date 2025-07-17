@extends('backend.layouts.master')
@section('title', 'My Reviews')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link href="{{ asset('assets/frontend/css/flaticon.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb-title', 'My Reviews')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">My Reviews</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    
                    <div class="card-body">
                        @foreach ($reviews as $review)
                            <div class="single-comment-box member-reviews mt-4">
                                <div class="comment">
                                    <figure class="comment-thumb">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="text-dark">{{ $review->inquiry->serviceCategory->name }}</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="float-right">
                                                    @if ($review->status == 1)
                                                        <span class="badge approve-btn p-2 f-14 m-1">
                                                            <i class="fa fa-check fa-lg"></i>
                                                            Published
                                                        </span>
                                                    @elseif ($review->status == 2)
                                                        <span class="badge reject-btn  p-2 f-14 m-2">
                                                            <i class="fa fa-ban fa-lg"></i>Unpublished
                                                        </span>
                                                    @else
                                                        <span class="badge pending-btn p-2 f-14 m-1">
                                                            <i class="fa fa-check fa-lg"></i>Pending
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>{{ $review->inquiry->user->name }}</h4>
                                        </div>
                                        @php
                                            $ratingValue = $review->rating;
                                        @endphp
                                        <div class="col-md-6">
                                            <ul class="rating clearfix">
                                                <li><i class="icon-Star{{ $ratingValue >= 1 ? ' active' : '' }}"></i></li>
                                                <li><i class="icon-Star{{ $ratingValue >= 2 ? ' active' : '' }}"></i></li>
                                                <li><i class="icon-Star{{ $ratingValue >= 3 ? ' active' : '' }}"></i></li>
                                                <li><i class="icon-Star{{ $ratingValue >= 4 ? ' active' : '' }}"></i></li>
                                                <li><i class="icon-Star{{ $ratingValue >= 5 ? ' active' : '' }}"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <span class="comment-time"><i
                                            class="fa fa-calendar"></i>{{ $review->created_at->format('d M Y, h:iA') }}</span>

                                    <h6>{{ $review->title }}</h6>
                                    <p>{{ $review->message }}</p>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
@endsection
