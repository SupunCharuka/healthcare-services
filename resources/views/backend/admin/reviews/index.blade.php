@extends('backend.layouts.master')
@section('title', 'Reviews')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link href="{{ asset('assets/frontend/css/flaticon.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb-title', 'Reviews')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"> Reviews</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="adminReviews"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>To Whom</th>
                                            <th>From</th>
                                            <th>Rate</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Message</th>
                                            <th style="max-width: 400px;" class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>{{ $review->inquiry->serviceCategory->name }}</td>
                                                <td>{{ $review->inquiry->service->user->name }}</td>
                                                <td>{{ $review->inquiry->user->name }}</td>
                                                <td>
                                                    @php
                                                        $ratingValue = $review->rating;
                                                    @endphp
                                                        <ul class="rating clearfix d-flex">
                                                            <li><i
                                                                    class="icon-Star{{ $ratingValue >= 1 ? ' active' : '' }}"></i>
                                                            </li>
                                                            <li><i
                                                                    class="icon-Star{{ $ratingValue >= 2 ? ' active' : '' }}"></i>
                                                            </li>
                                                            <li><i
                                                                    class="icon-Star{{ $ratingValue >= 3 ? ' active' : '' }}"></i>
                                                            </li>
                                                            <li><i
                                                                    class="icon-Star{{ $ratingValue >= 4 ? ' active' : '' }}"></i>
                                                            </li>
                                                            <li><i
                                                                    class="icon-Star{{ $ratingValue >= 5 ? ' active' : '' }}"></i>
                                                            </li>
                                                        </ul>

                                                </td>
                                                <td>{{ $review->created_at->format('d M Y, h:iA') }}</td>
                                                <td>{{ $review->title }}</td>
                                                <td>{{ $review->message }}</td>
                                                <td class="text-center">
                                                    @if ($review->status == 1)
                                                        <span class="badge approve-btn p-2 f-14 m-1">
                                                            <i class="fa fa-check fa-lg"></i>
                                                            Published
                                                        </span>

                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#dataTableModal" data-id={{ $review->id }}
                                                            data-original-title="Unpublish"
                                                            class="unpublish p-2 badge badge-danger rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-ban fa-lg"></i><span
                                                                class="f-14 m-1">Unpublish</span></a>
                                                    @elseif ($review->status == 2)
                                                        <a href="javascript:void(0)" data-id="{{ $review->id }}"
                                                            data-original-title="Publish"
                                                            class="publish p-2 badge badge-success rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-check fa-lg"></i><span
                                                                class="f-14 m-1">Publish</span></a>

                                                        <span class="badge reject-btn  p-2 f-14 m-2">
                                                            <i class="fa fa-ban fa-lg"></i>Unpublished
                                                        </span>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{{ $review->id }}"
                                                            data-original-title="Publish"
                                                            class="publish p-2 badge badge-success rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-check fa-lg"></i><span
                                                                class="f-14 m-1">Publish</span></a>


                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#dataTableModal" data-id={{ $review->id }}
                                                            data-original-title="Unpublish"
                                                            class="unpublish p-2 badge badge-danger rounded-pill"
                                                            style="width:120px">
                                                            <i class="fa fa-ban fa-lg"></i><span
                                                                class="f-14 m-1">Unpublish</span></a>
                                                    @endif

                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dataTableModal" data-id={{ $review->id }}
                                                        data-original-title="Delete"
                                                        class="delete p-2 badge badge-danger rounded-pill"
                                                        style="width:120px">
                                                        <i class="fa fa-trash fa-lg"></i><span
                                                            class="f-14 m-1">Delete</span></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>To Whom</th>
                                            <th>From</th>
                                            <th>Rate</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Message</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
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
    <script src="{{ asset('js/admin/reviews/review.js') }}"></script>
@endsection
