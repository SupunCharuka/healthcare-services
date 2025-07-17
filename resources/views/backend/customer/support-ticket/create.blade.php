@extends('backend.customer.layouts.master')

@section('title', 'Support Ticket')
@section('styles')

@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">


            <div class="doctors-appointment">
                <livewire:customer.ticket.create />
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/customer/support-ticket/support-ticket.js') }}"></script>

@endsection
