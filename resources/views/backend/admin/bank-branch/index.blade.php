@extends('backend.layouts.master')
@section('title', 'Bank-Branch')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Bank')

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Add Bank Name</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div>
            <div class="row">
                @can('bank.create')
                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                        <livewire:admin.bank.create />
                    </div>
                @endcan

                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Manage Bank Name</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="banks"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Bank Name</th>
                                            <th>Bank Code</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banks as $key => $bank)
                                            <tr id="bank-record-{{ $bank->id }}">
                                                <td>{{ $bank->id }}</td>
                                                <td>{{ $bank->bank_name }}</td>
                                                <td>{{ $bank->bank_code }}</td>

                                                <td class="text-center">
                                                    @can('bank.update')
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('admin.bank.edit', ['bank' => $bank]) }}">
                                                            <i class="fa fa-pencil"> </i>
                                                        </a>
                                                    @endcan
                                                    @can('bank.delete')
                                                        <a class="btn btn-sm delete-bank btn-danger"
                                                            data-bank="{{ $bank->id }}" id="bank-{{ $bank->id }}"
                                                            href="javascript:void(0)">
                                                            <i class="fa fa-trash"> </i>
                                                        </a>
                                                    @endcan
                                                    <a class="btn btn-sm btn-info"
                                                        href="{{ route('admin.branch', ['bank' => $bank]) }}">
                                                        <i class="fa fa-link"> </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Bank Name</th>
                                            <th>Bank Code</th>
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
    <script src="{{ asset('js/admin/bank/bank.js') }}"></script>


@endsection
