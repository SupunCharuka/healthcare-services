<x-backend-layout>
    @section('title', 'Users')
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
        Users
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"> Users</li>
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
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>

                            <table class="table table-striped table-bordered dt-responsive nowrap" id="getMembers"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile Photo</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>SLMC Number</th>
                                        <th>View Profile</th>
                                        <th>View Services</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($membersLists as $key => $membersList)
                                        <tr id="inquiry-record-{{ $membersList->id }}">
                                            <td>{{ $membersList->id }}</td>
                                            <td>
                                                @if ($membersList->user && $membersList->user->profile_photo_url)
                                                    <img src="{{ $membersList->user->profile_photo_url }}"
                                                        alt="Avatar" class="rounded-circle" style="width: 50px;" />
                                                @else
                                                    <span>User not available</span>
                                                @endif
                                            </td>


                                            <td>
                                                @if ($membersList->user)
                                                    {{ $membersList->user->name }}
                                                @else
                                                    User not available
                                                @endif
                                            </td>
                                            <td>
                                                @if ($membersList->user && $membersList->user->member_type)
                                                    {{ $membersList->user->member_type == 'service-provider' ? 'Service Provider' : 'Doctor' }}
                                                @else
                                                    Member type not available
                                                @endif
                                            </td>
                                            <td>{{ $membersList->user->slmc_number ?? '' }}</td>
                                            <td>
                                                @if ($membersList->user)
                                                    <a href="{{ route('admin.memberDetails', $membersList->user_id) }}"
                                                        target="_blank">
                                                        <b><i class="fa fa-eye mr-2"></i>View Details</b>
                                                    </a>
                                                @else
                                                    User not available
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $memberServices = App\Models\Service::where('user_id', $membersList->user_id)->get();
                                                @endphp
                                                @if ($memberServices->isEmpty())
                                                    <a href="javascript:void(0)" class="text-danger"><b>
                                                            <i class="fa fa-exclamation-circle mr-2"></i>Not
                                                            Details</a>
                                                @else
                                                    <a href="{{ route('admin.memberServices', $membersList->user_id) }}"
                                                        target="_blank"><b>
                                                            <i class="fa fa-eye mr-2"></i>View Details</a>
                                                @endif

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
                                        <th>SLMC Number</th>
                                        <th>View Profile</th>
                                        <th>View Services</th>
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
        <script src="{{ asset('js/admin/members/member.js') }}"></script>

    </x-slot>
</x-backend-layout>
