@extends('backend.customer.layouts.master')

@section('title', 'My Health Profle')

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
                <livewire:customer.health-profile.index />
            </div>


            <div class="doctors-appointment mt-5">
                <div class="title-box inquiry">
                    <h5 class="pl-1 font-weight-bold">My Medical Report Details</h5>
                </div>
                <div class="doctors-list">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-striped  dt-responsive nowrap dataTable no-footer"
                                id="healthProfile" style="width:100%">
                                <thead class="table-header">
                                    <tr>
                                      
                                        <th>Created Date</th>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($healthProfiles as $key => $healthProfile)
                                        <tr id="health-record-{{ $healthProfile->id }}">
                                         
                                            <td>
                                                {{ $healthProfile->created_at->format('M d, Y h:i A') }}
                                            </td>
                                             <td>
                                                {{ $healthProfile->title }}
                                            </td>
                                            <td class="inquiry-status">
                                                @php
                                                    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                                    $explodeImage = explode('.', $healthProfile->file);
                                                    $extension = end($explodeImage);
                                                @endphp
                                                @if (in_array($extension, $imageExtensions, true))
                                                    <img class="img-thumbnail mt-2"
                                                        src="{{ asset('uploads/customer/health-profile/' . $healthProfile->file) }}"
                                                        style="width:80px" alt="">
                                                @else
                                                    <b>
                                                        <a href="{{ asset('uploads/customer/health-profile/' . $healthProfile->file) }}"
                                                            target="blank">
                                                            <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                                alt="" />
                                                        </a>
                                                    </b>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @can('update', $healthProfile)
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ URL::signedRoute('customer.healthProfile.edit', ['health' => $healthProfile]) }}">
                                                        <i class="fa fa-pencil"> </i>
                                                    </a>
                                                @endcan
                                                @can('delete', $healthProfile)
                                                    <a class="btn btn-sm delete-health btn-danger"
                                                        data-health="{{ $healthProfile->id }}"
                                                        id="health-{{ $healthProfile->id }}" href="javascript:void(0)">
                                                        <i class="fa fa-trash"> </i>
                                                    </a>
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
    <script src="{{ asset('js/customer/health-profile.js') }}"></script>

@endsection
