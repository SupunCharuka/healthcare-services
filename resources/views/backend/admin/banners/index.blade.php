@extends('backend.layouts.master')
@section('title', 'Banner')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

@endsection
@section('breadcrumb-title', 'Manage Banners')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Banner</li>
@endsection
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">


                <div class="card-body">
                    <livewire:admin.banner.create />
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Manage Banners</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="banner"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Desktop Image</th>
                                    <th>Mobile Image</th>
                                    <th>Title</th>
                                    <th>Link To</th>
                                    <th> Order</th>
                                    
                                    <th>Is Active</th>
                                    <th style="max-width: 400px;" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr id="banner-record-{{ $banner->id }}">
                                        <td>
                                            <img src="{{ storage('uploads/banners/' . $banner->image) }}"
                                                width="80">
                                        </td>
                                        <td>
                                            <img src="{{ storage('uploads/banners/mobile-image/' . $banner->mobile_image) }}"
                                                width="80">
                                        </td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->link_to }}</td>
                                        <td>{{ $banner->local_order }}</td>
                                        
                                        <td>{{ $banner->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.banner.edit',$banner) }}">
                                                <i class="fa fa-pencil"> </i>
                                            </a>
                                            <a class="btn btn-sm delete-banner btn-danger" data-banner="{{ $banner->id }}"
                                                id="banner-{{ $banner->id }}" href="javascript:void(0)">
                                                <i class="fa fa-trash"> </i>
                                            </a>

                                            <a class="btn btn-success btn-sm" href="{{ route('admin.banner.localSort', ['banner' => $banner]) }}" data-bs-original-title="" title="Arrange to Banner">
                                                <i class="fa fa-random"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Desktop Image</th>
                                    <th>Mobile Image</th>
                                    <th>Title</th>
                                    <th>Link To</th>
                                    <th> Order</th>
                                   
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
    <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
    <script src="{{ asset('js/admin/banners/banner.js') }}"></script>
@endsection
