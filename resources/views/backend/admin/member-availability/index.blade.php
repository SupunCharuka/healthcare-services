@extends('backend.layouts.master')
@section('title', 'View Availabilities')
@section('styles')

@endsection

@section('breadcrumb-title', 'View Availabilities')


@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.getInquiry') }}">Inquiries</a></li>
    <li class="breadcrumb-item active">Availabilities</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="calendar-wrap">
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $service->user->name }}'s Availability Days for {{$service->title}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mt-2 form-group">
                                <label class="form-label" for="week_day"><strong>Selected Days:</strong></label>

                                <div class="service-availability">
                                    <ul class="availability-list">
                                        @php
                                            $highlightedDays = [];
                                            $remainingDays = [];
                                        @endphp

                                        @foreach ($service->weeklyAvailabilities as $availability)
                                            @if (strtolower($availability->week_day) === strtolower(now()->format('l')))
                                                @php
                                                    $highlightedDays[] = $availability;
                                                @endphp
                                            @else
                                                @php
                                                    $remainingDays[] = $availability;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @php
                                            // Create an array of days starting from the highlighted day
                                            $daysToShow = [];
                                            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            $currentDayIndex = array_search(strtolower(now()->format('l')), array_map('strtolower', $daysOfWeek));
                                            
                                            for ($i = 0; $i < 7; $i++) {
                                                $daysToShow[] = $daysOfWeek[$currentDayIndex % 7];
                                                $currentDayIndex++;
                                            }
                                        @endphp

                                        @foreach ($daysToShow as $day)
                                            @php
                                                $availability = null;
                                                // Find the availability for the current day
                                                foreach (array_merge($highlightedDays, $remainingDays) as $avail) {
                                                    if (strtolower($avail->week_day) === strtolower($day)) {
                                                        $availability = $avail;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            @if ($availability)
                                                <li class="availability-item">
                                                    <div class="availability-details">
                                                        <button
                                                            class="availability-button {{ strtolower($day) === strtolower(now()->format('l')) ? 'highlighted' : '' }}"
                                                            data-toggle="modal"
                                                            data-target="#availabilityModal{{ $availability->id }}"><span
                                                                class="day-name">
                                                                {{ ucfirst($day) }}</span>
                                                            <div class="availability-info">
                                                                <span>Start Time: {{ $availability->start_time }}</span><br>
                                                                <span>End Time: {{ $availability->end_time }}</span>
                                                            </div>
                                                        </button>

                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="{{ asset('assets/backend/js/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/calendar/fullcalendar.min.js') }}"></script>
@endsection
