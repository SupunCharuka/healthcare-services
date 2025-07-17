<x-backend-layout>
    @section('title', 'Deactivated Users')
    <x-slot name="styles">
     
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">

    </x-slot>

    <x-slot name="breadcrumb_title">
        Deactivated Users
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Deactivated Users</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="status-filter">
                                <label for="status">Filter by Member Type:</label>
                                <select id="memberTypeFilter">
                                    <option value="all">All</option>
                                    <option value="service provider">Service Provider</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>

                            <table class="table table-striped table-bordered dt-responsive nowrap" id="users"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deactivatedUsers as $key => $deactivatedUser)
                                        <tr>
                                            <td>{{ $deactivatedUser->id }}</td>
                                            <td>
                                                <img src="{{ $deactivatedUser->profile_photo_url }}" alt="Avatar"
                                                    class="rounded-circle" style="width: 50px;" />
                                            </td>

                                            <td>{{ $deactivatedUser->name }}</td>
                                            <td>
                                               
                                                @if ($deactivatedUser->hasRole('service-provider'))
                                                    Service Provider
                                                @elseif($deactivatedUser->hasRole('customer'))
                                                    Customer
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-sm recovery-btn btn-danger"
                                                    data-recovery="{{ $deactivatedUser->id }}"
                                                    id="recovery-{{ $deactivatedUser->id }}"
                                                    href="javascript:void(0)">
                                                    <i class="fa fa-repeat"> </i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Type</th>
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
    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/admin/deactivate/deactivate-users.js') }}"></script>

    </x-slot>
</x-backend-layout>
