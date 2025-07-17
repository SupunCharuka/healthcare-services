<x-backend-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/app-jetstream.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

    </x-slot>

    <x-slot name="breadcrumb_title">
        permissions
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">permissions</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <livewire:admin.create-permission />
            </div>
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Manage permissions</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="permissions"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th style="max-width: 400px;" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr id="permission-record-{{ $permission->id }}">
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.permission.edit', ['permission' => $permission]) }}">
                                                    <i class="fa fa-pencil"> </i>
                                                </a>
                                                <a class="btn btn-sm delete-permission btn-danger"
                                                    data-permission="{{ $permission->id }}"
                                                    id="permission-{{ $permission->id }}" href="javascript:void(0)">
                                                    <i class="fa fa-trash"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
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

    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/admin/permission.js') }}"></script>
    </x-slot>
</x-backend-layout>
