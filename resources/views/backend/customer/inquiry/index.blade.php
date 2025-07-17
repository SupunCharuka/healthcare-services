@extends('backend.customer.layouts.master')

@section('title', 'My Inquiry')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">

            <div class="doctors-appointment">
                <div class="title-box inquiry">
                    <h3>My Inquiry</h3>
                </div>
                <div class="doctors-list">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-striped  dt-responsive nowrap dataTable no-footer" id="inquiry"
                                style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                        <th>Id</th>
                                        <th>Service Name</th>
                                        <th>Date & Tme</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($myInquiries as $key => $myInquiry)
                                        <tr id="myInquiry-record-{{ $myInquiry->id }}">

                                            <td>
                                                <strong>{{ $myInquiry->id }}</strong>
                                            </td>
                                            <td>
                                                {{ $myInquiry->serviceCategory->name }}
                                            </td>
                                            <td>
                                                {{ $myInquiry->created_at->format('M d, Y h:i A') }}
                                            </td>
                                            <td class="inquiry-status text-center">
                                                @if ($myInquiry->member_status == 'completed')
                                                    <span class="badge badge-success p-2">Completed</span>
                                                @elseif ($myInquiry->member_status == 'rejected')
                                                    <span class="badge badge-danger p-2">Rejected</span>
                                                @elseif ($myInquiry->member_status == 'unpaid')
                                                    <span class="badge badge-warning p-2">Unpaid</span>
                                                @elseif ($myInquiry->member_status == 'confirmed')
                                                    <span class="badge badge-primary p-2">Confirmed</span>
                                                @else
                                                    <span class="badge badge-info p-2">Pending</span>
                                                @endif
                                            </td>
                                            <td class="inquiry-status text-center">
                                                @can('viewInquiryDetails', $myInquiry)
                                                    <a href="{{ URL::signedRoute('customer.myInquiryDetails', ['inquiry' => $myInquiry->id]) }}"
                                                        class="btn btn-primary btn-sm"><span class="view"><i
                                                                class="fas fa-eye mr-1"></i>View</span></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
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
    <script src="{{ asset('js/customer/inquiry/inquiry.js') }}"></script>

@endsection
