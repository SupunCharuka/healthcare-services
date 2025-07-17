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
        Manage Blog
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Manage Blog</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto  pb-5 pt-1 sm:px-6 lg:px-8">
                <livewire:admin.blog.create />
            </div>
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Manage Blog</h5>
                    </div>
                    <div class="card-body">
                      
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="blog"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $key => $blog)
                                        <tr id="blog-record-{{ $blog->id }}">
                                            <td>{{ $blog->id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>
                                                <img class=""
                                                src="{{ asset('uploads/admin/blog/' . $blog->image) }}"
                                                width="80">
                                            </td>
                                           
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.blog.edit', ['blog' => $blog]) }}">
                                                    <i class="fa fa-pencil"> </i>
                                                </a>
                                                <a class="btn btn-sm delete-blog btn-danger"
                                                    data-blog="{{ $blog->id }}"
                                                    id="blog-{{ $blog->id }}" href="javascript:void(0)">
                                                    <i class="fa fa-trash"> </i>
                                                </a>
                                               
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
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
