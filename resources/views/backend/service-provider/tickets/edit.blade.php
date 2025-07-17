@extends('backend.layouts.master')
@section('title', 'Create Ticket')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection
@section('breadcrumb-title', 'Create Ticket')
@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('service-provider.tickets.index') }}">Tickets</a></li>
    <li class="breadcrumb-item active">Edit Ticket</li>
@endsection
@section('content')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:service-provider.ticket.edit :ticket="$ticket" />
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
