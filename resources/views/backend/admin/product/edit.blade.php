<x-backend-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}"> --}}
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/dropzone.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/prodcut.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/product/variation-photos.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/product/product.css') }}">
    </x-slot>
    <x-slot name="breadcrumb_title">
        Edit Product
    </x-slot>
    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.product') }}">Product</a></li>
        <li class="breadcrumb-item active">Edit Product</li>
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="card shadow">

                        <div class="card-body">

                            <div class="image-content">
                                <form class="dropzone dropzone-primary dz-clickable cursor-pointer" id="croppier"
                                    action="">
                                    @csrf
                                    <input type="file" id="crop-image-and-compress-main"
                                        data-container="uploaded-img" data-key="0"
                                        class="crop-image-and-compress upl-fileInp">
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
                                    @foreach ($product->productImages as $photo)
                                       <div class="dz-preview dz-processing dz-success dz-complete dz-image-preview" id="preview-{{ $photo->id }}">
                                          <div class="dz-image" style="height: 100%;">
                                             <img src="{{ storage('uploads/admin/product-images/thumb/' . $photo->images) }}" style="width: 120px; object-fit: cover; height: 100%;">
                                          </div>
                                          <div class="dz-error-mark remove-image" data-id="{{ $photo->id }}" data-key="0" data-container="uploaded-img">
                                             <img src="{{ asset('assets/backend/images/error-mark.svg') }}" alt="" id="indicator-{{ $photo->id }}" style="width: 54px;">
                                          </div>
                                       </div>
                                    @endforeach
                                 </span>
                            </div>
                            <livewire:admin.product.edit :product="$product" />
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
    <x-slot name="scripts">
        <script>
            const width = 1000;
            const height = 1000;
            const EDIT_PRODUCT = '/{{ $product->slug }}';
            const MEDIA_UPLOAD_URL = "{{ route('admin.product.store') }}"
         </script>
        <script src="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
        <script src="{{ asset('js/admin/product/product-tiny.js') }}"></script>
        <script src="{{ asset('assets/backend/js/croppie/croppie.js') }}" type="text/javascript" defer></script>
        <script src="{{ asset('js/admin/product/main-photos.js') }}" type="text/javascript"></script>
    </x-slot>
</x-backend-layout>
