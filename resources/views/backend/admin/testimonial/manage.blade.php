@extends('backend.layouts.master')
@section('title', 'Testimonials')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'Manage Testimonials')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Testimonials</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Manage Testimonials</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="testimonial"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Image</th>
                                        <th>Is Active</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $testimonial)
                                        <tr id="testimonial-record-{{ $testimonial->id }}">
                                            <td>{{ $testimonial->id }}</td>
                                            <td>{{ $testimonial->title }}</td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->country }}</td>
                                            <td>
                                                <img src="{{ storage('uploads/testimonial/' . $testimonial->image) }}"
                                                    width="80">
                                            </td>
                                            <td>{{ $testimonial->is_active ? 'Active' : 'Inactive' }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.testimonial.edit', $testimonial) }}">
                                                    <i class="fa fa-pencil"> </i>
                                                </a>
                                                <a class="btn btn-sm delete-testimonial btn-danger"
                                                    data-testimonial="{{ $testimonial->id }}"
                                                    id="testimonial-{{ $testimonial->id }}" href="javascript:void(0)">
                                                    <i class="fa fa-trash"> </i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Country</th>
                                        <th>Image</th>
                                        <th>Is Active</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
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
    <script src="{{ asset('js/admin/testimonials/manage-testimonials.js') }}"></script>
@endsection
