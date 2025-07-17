<x-backend-layout>
    @section('title', 'Blog')
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.css') }}">
    </x-slot>

    <x-slot name="breadcrumb_title">
        Edit Blog
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.blog') }}">Blogs</a></li>
        <li class="breadcrumb-item active">Edit Blog</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto  pb-5 pt-1 sm:px-6 lg:px-8">
                <livewire:admin.blog.edit :blog="$blog" />
            </div>
           
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/editor/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/admin/blog/blog.js') }}"></script>

    </x-slot>
</x-backend-layout>
