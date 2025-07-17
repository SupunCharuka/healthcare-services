@extends('backend.layouts.master')
@section('title', 'Create Product')
@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/prodcut.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/product/variation-photos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/product/product.css') }}">
@endsection
@section('breadcrumb-title', 'Manage Product')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manage Product</li>
@endsection
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row" id="listing-container">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Create Product</h5>
                        </div>
                        <div class="card-body">

                            <div class="image-content">
                                <form class="dropzone dropzone-primary dz-clickable cursor-pointer" id="croppier"
                                    action="">
                                    @csrf
                                    <input type="file" id="crop-image-and-compress-main" data-container="uploaded-img"
                                        data-key="0" class="crop-image-and-compress upl-fileInp">
                                    <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                        <h6>Drop files here or click to upload.</h6>
                                        <span class="note needsclick">
                                            (This is just a demo dropzone. Selected files are
                                            <strong>Automatically</strong>
                                            actually uploaded and save to the media center.)
                                        </span>
                                    </div>
                                    {{-- <span id="uploaded-img"> </span> --}}
                                </form>
                            </div>
                            <div class="dropzone dz-clickable mt-1 mb-3">
                                <div class="dz-message needsclick">
                                    <span class="note needsclick">
                                        <i class="icon-gallery"></i> <br>
                                        Uploaded images are preview here
                                    </span>
                                </div>
                                <span id="uploaded-img" class="upload-center">
                                    <!-- Uploaded images are preview here -->
                                </span>
                            </div>

                            <livewire:admin.product.create />
                        </div>

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Product </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="product"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Product Cateogry</th>
                                            <th>Product subcategory</th>
                                            <th>Product Images</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr id="product-record-{{ $product->id }}">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->productCategory->name }}</td>
                                                <td>{{ $product->productSubcategory->name }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#myModalImage{{ $product->id }}"><b>
                                                            <i class="fa fa-eye mr-2"></i>View Images</a>
                                                </td>

                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('admin.product.edit', ['product' => $product]) }}">
                                                        <i class="fa fa-pencil"> </i>
                                                    </a>
                                                    <a class="btn btn-sm delete-product btn-danger"
                                                        data-product="{{ $product->id }}"
                                                        id="product-{{ $product->id }}" href="javascript:void(0)">
                                                        <i class="fa fa-trash"> </i>
                                                    </a>

                                                </td>
                                            </tr>
                                           
                                            <!-- Product Image Modal-->
                                            <div class="modal fade" id="myModalImage{{ $product->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div>
                                                        <button class="btn-close theme-close" type="button"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="animate-widget">
                                                                    <div></div>
                                                                    <div class="text-center p-25">
                                                                        @foreach ($product->productImages as $index => $productImage)
                                                                            <div class="image-container">
                                                                                <img class="img-thumbnail"
                                                                                    src="{{ asset('uploads/admin/product-images/' . $productImage->images) }}"
                                                                                    width="100" alt="Preview Image">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Product Cateogry</th>
                                            <th>Product subcategory</th>
                                            <th>Product Images</th>
                                            <th class="text-center">Actions</th>
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
    <!-- ==========Crop Picture Modal Start========== -->
    <div id="modal_pic_upload" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="crop_platform"></div>
                        </div>
                        <div class="col-md-12  text-center">
                            <button class="btn btn-success crop_image">
                                Crop Picture
                                <i class="fa fa-check-circle"></i>
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close-modal-pro-pic">
                                Close
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const width = 1000;
        const height = 1000;
        const EDIT_PRODUCT = '';
        const MEDIA_UPLOAD_URL = "{{ route('admin.product.store') }}"
    </script>
    <script src="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/product/product.js') }}"></script>
    <script src="{{ asset('js/admin/product/product-tiny.js') }}"></script>
    <script src="{{ asset('assets/backend/js/modal-animated.js') }}"></script>
    <script src="{{ asset('assets/backend/js/croppie/croppie.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/admin/product/main-photos.js') }}" type="text/javascript"></script>
@endsection
