@extends('backend.layouts.master')
@section('title', 'Business Proflle')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Business Proflle')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.businessProfile') }}">Manage Business Proflle</a></li>
    <li class="breadcrumb-item active">View Business Proflle</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div>

                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Name : </label>
                                    <span><strong>{{ $business->user->name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>Address : </label>
                                    <span><strong>{{ $business->address }}</strong></span>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label>District : </label>
                                    <span><strong>{{ $business->district->name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>City : </label>
                                    <span><strong>{{ $business->city->name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Postcode : </label>
                                    <span><strong>{{ $business->postcode }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Legal Name/ Business Owner Name : </label>
                                    <span><strong>{{ $business->owner_name }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Business Registration Number : </label>
                                    <span><strong>{{ $business->registration_no }}</strong></span>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <label>Upload Business Documents : </label>
                                    <br>
                                    <span><strong>
                                            @php
                                                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                                $explodeImage = explode('.', $business->document);
                                                $extension = end($explodeImage);
                                            @endphp
                                            @if (in_array($extension, $imageExtensions, true))
                                                <img class="img-thumbnail mt-2"
                                                    src="{{ asset('uploads/service-provider/business/profile/' . $business->document) }}"
                                                    style="width:150px" alt="">
                                            @else
                                                <b>
                                                    <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                        alt="" />
                                                    <a href="{{ asset('uploads/service-provider/business/profile/' . $business->document) }}"
                                                        target="blank">{{ $business->document }}

                                                    </a>
                                                </b>
                                            @endif
                                        </strong></span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <a class="btn btn-sm btn-primary mt-1" title="Edit"
                                        href="{{ route('service-provider.profile', ['business' => $business]) }}">
                                        <i class="fa fa-pencil"> </i>
                                    </a>
                                </div>
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

@endsection
