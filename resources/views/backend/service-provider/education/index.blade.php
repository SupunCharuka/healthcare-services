<x-backend-layout>
    @section('title', 'Education')
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
        My Education
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('service-provider.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"> My Education</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <livewire:member.education.create />
            </div>
            <div class="col-sm-12">
                <div class="card shadow">
                    
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="education"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>certificate</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($educations as $key => $education)
                                            <tr id="education-record-{{ $education->id }}">
                                                <td>{{ $education->title }}</td>
                                                <td>{{ $education->start_date }}</td>
                                                <td>{{ $education->end_date }}</td>
                                                <td>
                                                    @php
                                                        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                                        $explodeImage = explode('.', $education->file);
                                                        $extension = end($explodeImage);
                                                    @endphp
                                                    @if (in_array($extension, $imageExtensions, true))
                                                        <img class="img-thumbnail mt-2"
                                                            src="{{ asset('uploads/service-provider/education/' . $education->file) }}"
                                                            style="width:80px" alt="">
                                                    @else
                                                        <b>
                                                            <a href="{{ asset('uploads/service-provider/education/' . $education->file) }}"
                                                                target="blank">
                                                                <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                                    alt="" />
                                                            </a>
                                                        </b>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('service-provider.education.edit', ['education' => $education]) }}">
                                                        <i class="fa fa-pencil"> </i>
                                                    </a>
                                                    <a class="btn btn-sm delete-education btn-danger"
                                                        data-education="{{ $education->id }}"
                                                        id="education-{{ $education->id }}" href="javascript:void(0)">
                                                        <i class="fa fa-trash"> </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>certificate</th>
                                            <th style="max-width: 400px;" class="text-center">Actions</th>
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
    <x-slot name="scripts">
        <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/backend/js/datatable/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/member/education/education.js') }}"></script>

    </x-slot>
</x-backend-layout>
