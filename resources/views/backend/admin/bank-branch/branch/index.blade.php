@extends('backend.layouts.master')
@section('title', 'Bank-Branch')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Bank Branch')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.bank') }}">Banks</a></li>
    <li class="breadcrumb-item active">Bank Branch</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">

                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <livewire:admin.bank.branch.create :bank="$bank" />
                </div>


                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Branch Name</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="branch"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Branch Name</th>
                                            <th>Branch Code</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $key => $branch)
                                            <tr id="branch-record-{{ $branch->id }}">
                                                <td>{{ $branch->id }}</td>
                                                <td>{{ $branch->branch_name }}</td>
                                                <td>{{ $branch->branch_code }}</td>

                                                <td class="text-center">

                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('admin.branch.edit', ['branch' => $branch]) }}">
                                                        <i class="fa fa-pencil"> </i>
                                                    </a>


                                                    <a class="btn btn-sm delete-branch btn-danger"
                                                        data-branch="{{ $branch->id }}" id="branch-{{ $branch->id }}"
                                                        href="javascript:void(0)">
                                                        <i class="fa fa-trash"> </i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Branch Name</th>
                                            <th>Branch Code</th>
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

@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/admin/bank/bank-branch.js') }}"></script>
@endsection
