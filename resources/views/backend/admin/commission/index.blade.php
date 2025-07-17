<x-backend-layout>
    @section('title', 'Commissions for ' . $date)
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatable-extension.css') }}">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </x-slot>

    <x-slot name="breadcrumb_title">
        Commissions
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Commissions</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">

                        <div class="dt-ext table-responsive date-range-commission">
                            <div class="datepicker-container">
                                <input type="text" id="datepicker" class="datepicker-input"
                                    placeholder="Select a date" value="{{ $date }}">
                                <span class="datepicker-icon">&#x1F4C5;</span>
                            </div>
                            <button id="markPaidButton" class="btn btn-success float-right">Mark All Paid</button>
                        
                            <table class="table table-striped table-bordered dt-responsive nowrap display"
                                id="commission" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Actions</th>
                                        <th>Service ID</th>
                                        <th>Service Provider Name</th>
                                        <th>Service Name</th>
                                        <th>Service Category Name</th>
                                        <th>Account Holder</th>
                                        <th>Account No</th>
                                        <th>Bank Name</th>
                                        <th>Branch Name</th>
                                        <th>Number Of Inquiries</th>
                                        <th>Commission Rate</th>
                                        <th>Commissions</th>
                                        <th>Earnings</th>
                                        <th class="text-center">View Inquiries</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalCommissions = 0;
                                        $totalEarnings = 0;
                                    @endphp
                                    @foreach ($services as $key => $service)
                                        <tr id="commission-record-{{ $service->id }}">
                                            <td>
                                                @if ($service->commissionPayouts->where('date', $date)->count() > 0)
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <span class="badge badge-danger">Not Paid</span>
                                                @endif
                                            </td>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->user->name }}</td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ $service->category->name }}</td>
                                            <td>{{ $service->bankDetail->account_holder }}</td>
                                            <td>{{ $service->bankDetail->account_number }}</td>
                                            <td>{{ $service->bankDetail->bank->bank_name ?? '' }}</td>
                                            <td>{{ $service->bankDetail->branch->branch_name ?? '' }}</td>
                                            <td> {{ $service->inquiries()->where('member_status', 'completed')->whereDate('updated_at', $date)->count() }}
                                            </td>
                                            <td>{{ $service->category->commission }}%</td>
                                            <td>
                                                @php
                                                    $totalServiceCommissions = 0;
                                                    $totalServiceEarnings = 0;
                                                @endphp
                                                @foreach ($service->inquiries as $inquiry)
                                                    @if ($inquiry->member_status === 'completed' && $inquiry->updated_at->toDateString() === $date)
                                                        @php
                                                            $commission = ($inquiry->cost * $service->category->commission) / 100;
                                                            $totalCommissions += $commission;
                                                            $totalServiceCommissions += $commission;
                                                            $totalEarnings += $inquiry->cost - $commission;
                                                            $totalServiceEarnings += $inquiry->cost - $commission;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                LKR {{ number_format($totalServiceCommissions, 2) }}
                                            </td>
                                            <td>LKR {{ number_format($totalServiceEarnings, 2) }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.commission.inquiries', ['service' => $service, 'date' => $date]) }}"><b>
                                                        <i class="fa fa-eye mr-2"></i>View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Actions</th>
                                        <th>Service ID</th>
                                        <th>Service Provider Name</th>
                                        <th>Service Name</th>
                                        <th>Service Category Name</th>
                                        <th>Account Holder</th>
                                        <th>Account No</th>
                                        <th>Bank Name</th>
                                        <th>Branch Name</th>
                                        <th>Number Of Inquiries</th>
                                        <th>Commission Rate</th>
                                        <th>Commissions</th>
                                        <th>Earnings</th>
                                        <th class="text-center">View Inquiries</th>
                                    </tr>

                                </tfoot>
                            </table>
                            <div class="mt-2">
                                <h6 class="font-weight-bold text-sm">Total Commissions:
                                    <span id="totalCommissions">LKR {{ number_format($totalCommissions, 2) }}</span>
                                </h6>
                            </div>
                            <div class="mt-2">
                                <h6 class="font-weight-bold text-sm">Total Earnings:
                                    <span id="totalEarnings">LKR {{ number_format($totalEarnings, 2) }}</span>
                                </h6>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/jquery.ui.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script src="{{ asset('js/admin/commissions/commission.js') }}"></script>

        <script>
            $(function() {
                $("#datepicker").datepicker({
                    dateFormat: "yy-mm-dd",
                    onSelect: function(dateText, inst) {
                        window.location.href = "{{ route('admin.commission') }}?date=" + dateText;
                    }
                });
            });
        </script>
    </x-slot>
</x-backend-layout>
