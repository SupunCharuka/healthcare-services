@extends('backend.layouts.master')
@section('title', 'My Reviews')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="reviews"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Date</th>
                                        <th>View More Details</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($inquiries as $inquiry)
                                        <tr>

                                            <td>{{ $inquiry->serviceCategory->name }}</td>
                                            <td>{{ $inquiry->created_at->format('M d, Y h:i A') }}</td>
                                            <td><a
                                                    href="{{ route('service-provider.viewReviews', ['serviceCategoryId' => $inquiry->service_category_id]) }}"><b>
                                                        <i class="fa fa-book mr-2"></i>View Details</a></td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Date</th>
                                        <th>View More Details</th>
                                    </tr>
                                </tfoot>
                            </table>
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
    <script src="{{ asset('js/member/my-reviews/review.js') }}"></script>
@endsection
