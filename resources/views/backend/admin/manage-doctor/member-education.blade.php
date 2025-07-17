<x-backend-layout>
    @section('title', ' Education Details')
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
        Education Details
    </x-slot>

    <x-slot name="breadcrumb_items">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.getDoctorsList') }}">Doctors</a></li>
        <li class="breadcrumb-item active">Education Details</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">

                    <div class="card-body">
                        <section class="" style="background-color: #ffffff;">

                            <div class="row d-flex justify-content-center align-items-center h-100">

                                <div class="" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="bg-warning gradient-custom text-center text-white"
                                            style="border-radius: .5rem;">
                                            <img src="{{ $educations->first()->user->profile_photo_url ?? '' }}"
                                                alt="Avatar" class="img-fluid my-5" style="width: 15%;" />
                                            <h5>{{ $educations->first()->user->name ?? '' }}</h5>
                                        </div>
                                        <div class="">
                                            @foreach ($educations as $education)
                                                <div class="card-body p-4">
                                                    <h6>{{ $education->title }}</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>Start Date</h6>
                                                            <p class="text-muted">{{ $education->start_date }}</p>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <h6>End Date</h6>
                                                            <p class="text-muted">{{ $education->end_date }}</p>
                                                        </div>
                                                    </div>
                                                    <h6>Certificate</h6>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="row pt-1">
                                                        <div class="col-6 mb-3">
                                                            <h6>File</h6>
                                                            @php
                                                                $imageExtensions = [
                                                                    'jpg',
                                                                    'jpeg',
                                                                    'gif',
                                                                    'png',
                                                                    'bmp',
                                                                    'svg',
                                                                ];
                                                                $explodeImage = explode('.', $education->file);
                                                                $extension = end($explodeImage);
                                                            @endphp
                                                            @if (in_array($extension, $imageExtensions, true))
                                                                <img class="img-thumbnail mt-2"
                                                                    src="{{ asset('uploads/service-provider/education/' . $education->file) }}"
                                                                    width="250" alt="">
                                                            @else
                                                                <b>
                                                                    <a href="{{ asset('uploads/service-provider/education/' . $education->file) }}"
                                                                        target="blank">
                                                                        <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                                            alt="" />{{ $education->file }}
                                                                    </a>
                                                                </b>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <a class="btn btn-sm btn-primary mt-1" title="Edit"
                                                                    href="{{ route('service-provider.education.edit', ['education' => $education]) }}">
                                                                    <i class="fa fa-pencil"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="height: 10px; background: #0014ff;">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>
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
    </x-slot>
</x-backend-layout>
