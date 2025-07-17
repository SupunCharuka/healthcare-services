<div>
    <div class="card">
        <div class="card-header">
            <h5>My Availability Days </h5>
        </div>
        <div class="card-body">
            <div class="col-md-12 form-group">
                @foreach ($services as $service)
                    <div class="d-flex justify-center mt-5">
                        <h4><strong>{{ $service->title }}</strong></h4>
                    </div>
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
                                <!-- Modal -->
                                @if ($availability)
                                    <div class="modal fade" id="availabilityModal{{ $availability->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="availabilityModalLabel{{ $availability->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="availabilityModalLabel{{ $availability->id }}">
                                                        Availability Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Service:</strong> {{ $service->title }}</p>
                                                    <p><strong>Start Time:</strong> {{ $availability->start_time }}</p>
                                                    <p><strong>End Time:</strong> {{ $availability->end_time }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button wire:click="deleteAvailability({{ $availability->id }})"
                                                        class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- End Modal -->
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </div>
</div>
