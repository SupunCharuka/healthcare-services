@extends('backend.customer.layouts.master')

@section('title', 'My Inquiry')

@section('link', 'My Inquiry')

@section('content')
    <div class="content-container">
        <div class="outer-container">
            <div class="doctors-appointment">
                <div class="title-box inquiry d-flex">
                    <h3>My Inquiry</h3>

                    <div class="ml-auto">
                        @can('viewInvoice', $inquiry)
                            <a href="{{ URL::signedRoute('customer.invoice', ['inquiry' => $inquiry]) }}" type="button"
                                id="invoiceBtn" class="btn btn-warning {{ $inquiry->cost ? '' : 'disabled' }}">Invoice</a>
                        @endcan
                    </div>
                </div>

                <div class="doctors-list">

                    <section class="" style="background-color: #ffffff;">
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="border border-secondary rounded mb-4">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <p class="text-dark mb-0">
                                                    <h5 class="text-center">
                                                        <h4>{{ $inquiry->serviceCategory->name }}
                                                        </h4>
                                                    </h5>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            @if ($inquiry->name)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Name</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ $inquiry->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                            @if ($inquiry->email)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ $inquiry->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                            @if ($inquiry->phone)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Phone Number</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ $inquiry->phone }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                            @if ($inquiry->is_video_call)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Video Call</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            @if ($inquiry->is_video_call == 1)
                                                                Yes
                                                            @elseif ($inquiry->is_video_call == 0)
                                                                No
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>

                                            @endif
                                            @if ($inquiry->duration)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Duration</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            @if ($inquiry->duration == '5_min')
                                                                5 min
                                                            @elseif ($inquiry->duration == '10_min')
                                                                10 min
                                                            @elseif ($inquiry->duration == '15_min')
                                                                15 min
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>

                                            @endif
                                            @if ($inquiry->appointment_datetime)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="mb-0">Appointment Date & Time</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ \Carbon\Carbon::parse($inquiry->appointment_datetime)->format('Y-m-d H:i:s') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                            @foreach ($inquiry->inputDetails as $inputDetail)
                                                <div class="row">
                                                    @if ($inputDetail->input->type == 'datetime-local')
                                                        <div class="col-sm-4">
                                                            <p class="text-dark mb-0">{{ $inputDetail->input->name }}</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p class="text-muted mb-0">
                                                                {{ \Carbon\Carbon::parse($inputDetail->data)->format('Y-m-d H:i:s') }}
                                                            </p>
                                                        </div>
                                                    @else
                                                        <div class="col-sm-4">
                                                            <p class="text-dark mb-0">{{ $inputDetail->input->name }}</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            @if (Str::endsWith($inputDetail->data, ['.jpg', '.jpeg', '.png', '.gif']))
                                                                <img src="{{ asset('uploads/frontend/inquiry/file/' . $inputDetail->data) }}"
                                                                    alt="Image">
                                                            @elseif (Str::endsWith($inputDetail->data, '.pdf'))
                                                                <a href="{{ asset('uploads/frontend/inquiry/file/' . $inputDetail->data) }}"
                                                                    target="blank">
                                                                    <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                                        alt="" />
                                                                </a>
                                                            @else
                                                                <p class="text-muted mb-0">{{ $inputDetail->data }}</p>
                                                            @endif

                                                        </div>
                                                    @endif
                                                </div>
                                                <hr>
                                            @endforeach
                                            @if ($inquiry->district->name)
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="text-dark mb-0">District</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ $inquiry->district->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="text-dark mb-0">City</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="text-muted mb-0">
                                                            {{ $inquiry->city->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                            <div class="row inquiry-status">
                                                <div class="col-sm-4">
                                                    <p class="text-dark mb-0">Status</p>
                                                </div>
                                                <div class="col-sm-8">

                                                    @if ($inquiry->member_status == 'completed')
                                                        <span class="badge badge-success p-2">Completed</span>
                                                    @elseif ($inquiry->member_status == 'rejected')
                                                        <span class="badge badge-danger p-2">Rejected</span>
                                                    @elseif ($inquiry->member_status == 'unpaid')
                                                        <span class="badge badge-warning p-2">Unpaid</span>
                                                    @elseif ($inquiry->member_status == 'confirmed')
                                                        <span class="badge badge-primary p-2">Confirmed</span>
                                                    @else
                                                        <span class="badge badge-info p-2">Pending</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <hr>

                                            @if ($inquiry->status != 2)
                                                {{-- status != reject --}}
                                                <div class="row inquiry-status">
                                                    <div class="col-sm-4">
                                                        <p class="text-dark mb-0">Assign Doctor's Name</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        @if ($inquiry->member_status != 'rejected')
                                                            @if ($inquiry->service->user->name ?? '')
                                                                <span
                                                                    class="pending">{{ $inquiry->service->user->name }}</span>
                                                            @else
                                                                <span class="pending text-dark">Pending</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-danger p-2">Cancelled</span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row inquiry-status">
                                                    <div class="col-sm-4">
                                                        <p class="text-dark mb-0">Cost</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        @if ($inquiry->member_status != 'rejected')
                                                            @if ($inquiry->cost)
                                                                <span class="cancel">LKR {{ $inquiry->cost }}/=</span>
                                                            @else
                                                                <span class="pending text-dark">Pending</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-danger p-2">Cancelled</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                @if ($inquiry->serviceCategory->slug == 'video-audio-consultation' && $inquiry->service_id)
                                                    <div class="row inquiry-status">
                                                        <div class="col-sm-4">
                                                            <p class="text-dark mb-0">Consultation with the Doctor</p>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <a href="{{ URL::signedRoute('video-call', ['inquiryId' => $inquiry->id, 'roomID' => $roomID]) }}"
                                                                target="_blank" type="button"
                                                                class="btn btn-primary btn-sm btn-pill"><i
                                                                    class="fa fa-phone mr-2"></i>Join Meeting</a>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endif

                                            @endif

                                            @if ($inquiry->latitude)
                                                <div id="map" style="height: 400px;"></div>
                                                <div id="latitude" data-latitude="{{ $inquiry->latitude }}">
                                                </div>
                                                <div id="longitude" data-longitude="{{ $inquiry->longitude }}">
                                                </div>
                                                <hr>
                                            @endif

                                            <div class="lower-box clearfix d-flex">
                                                @can('writeReview', $inquiry)
                                                    <div>
                                                        <a href="{{ route('customer.writeReview', ['inquiryId' => $inquiry->id]) }}"
                                                            class="write-review {{ $inquiry->member_status == 'completed' ? '' : 'disabled' }}">Write
                                                            a review</a>
                                                    </div>
                                                @endcan
                                                @if ($inquiry->service_id == null)
                                                    <div class="ml-auto">
                                                        <a href="javascript:void(0)"
                                                            data-action="{{ route('customer.myInquiry.reject', ['inquiry' => $inquiry->id]) }}"
                                                            class="btn btn-danger reject-inquiry">Reject</a>
                                                    </div>
                                                @endif

                                            </div>





                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $(document).on("click", ".reject-inquiry", function(e) {
            e.preventDefault();
            __this = $(this);
            let actionUrl = $(this).data("action");
            Swal.fire({
                title: "Are You Sure?",
                text: "Are you want to reject this inquiry?",
                icon: "warning",
                showCancelButton: true,
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: {
                            inquiry_id: actionUrl,
                        },
                        dataType: "JSON",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(response) {
                            Swal.fire("Done!", response.message,
                                "success");
                            window.location.reload();
                        },
                        error: function(response) {
                            Swal.fire(
                                "Error!",
                                "Something went wrong.",
                                "error"
                            );
                        },
                    });
                }
            });
        });
    </script>
    <!-- map script -->
    <script type="text/javascript">
        function initMap() {
            const latitudeElement = document.getElementById("latitude");
            const longitudeElement = document.getElementById("longitude");

            const latitude = parseFloat(latitudeElement.getAttribute("data-latitude"));
            const longitude = parseFloat(longitudeElement.getAttribute("data-longitude"));

            const myLatLng = {
                lat: latitude,
                lng: longitude
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatLng,
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "My Location",
            });
        }

        window.initMap = initMap;
    </script>

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ config('googlemaps.key') }}&callback=initMap"></script>
    <script src="{{ asset('assets/frontend/js/gmaps.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/map-helper.js') }}"></script>

@endsection
