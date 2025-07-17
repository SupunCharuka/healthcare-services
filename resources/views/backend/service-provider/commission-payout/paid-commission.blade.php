<x-backend-layout>
    @section('title', 'Paid | Commission Payout')
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
        Paid | Commission Payout
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Paid | Commission Payout</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap display"
                                id="commissionPayout" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Commission Payout</th>
                                        <th class="text-center">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inquiriesWithPaidCommissions as $key => $inquiry)
                                        <tr id="inquiry-record-{{ $inquiry->id }}">
                                            <td>{{ $inquiry->invoice->id }}</td>
                                            <td>{{ $inquiry->id }}</td>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->serviceCategory->name }}</td>
                                            <td>
                                                @php
                                                    $commission = ($inquiry->serviceCategory->commission / 100) * $inquiry->invoice->amount;
                                                    $commissionPayout = $inquiry->invoice->amount - $commission;
                                                @endphp
                                                LKR {{ number_format($commissionPayout, 2) }}
                                            </td>

                                            <td class="text-center">
                                                @php
                                                    $hasCommissionPayout = $inquiry->service->commissionPayouts->isNotEmpty();
                                                @endphp

                                                @if ($hasCommissionPayout)
                                                      <span class="badge badge-success">Paid</span>
                                                @else
                                                   <span class="badge badge-danger">Not Paid</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Inquiry ID</th>
                                        <th>Name</th>
                                        <th>Category Name</th>
                                        <th>Commission Payout</th>
                                        <th class="text-center">Status</th>
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
        <script src="{{ asset('js/service-provider/commission/commission-payout.js') }}"></script>

    </x-slot>
</x-backend-layout>
