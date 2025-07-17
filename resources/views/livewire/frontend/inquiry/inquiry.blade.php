<div class="col-lg-12 col-md-12 col-sm-12 form-column">
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    <div class="form-inner">
        <form wire:submit.prevent="store" id="" class="default-form" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                @foreach ($staticInputs as $input)
                    @if ($input->serviceStaticInput->name == 'Name')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="inquiry.name"
                                class="form-control {{ $errors->has('inquiry.name') ? 'border border-danger' : '' }}"
                                type="text" name="name" placeholder="Enter Your Name">
                            @error('inquiry.name')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif

                    @if ($input->serviceStaticInput->name == 'Email')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="inquiry.email"
                                class="form-control {{ $errors->has('inquiry.email') ? 'border border-danger' : '' }}"
                                type="email" name="email" placeholder="Enter Your Email">
                            @error('inquiry.email')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif

                    @if ($input->serviceStaticInput->name == 'Phone')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <div wire:ignore>
                                <input wire:model="inquiry.phone"
                                    class="form-control {{ $errors->has('inquiry.phone') ? 'border border-danger' : '' }}"
                                    type="text" id="phone" name="phone" placeholder="Enter Your Phone Number">
                            </div>
                            @error('inquiry.phone')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif

                    @if ($input->serviceStaticInput->name == 'Province/District/City')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <select wire:model="inquiry.district_id"
                                class="form-control select-inquiry {{ $errors->has('inquiry.district_id') ? 'border border-danger' : '' }}"
                                name="district">
                                <option selected="" value="">
                                    Select District
                                </option>
                                @foreach ($listForFields['district'] as $districts)
                                    <option value="{{ $districts['id'] }}">
                                        {{ $districts['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inquiry.district_id')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>


                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <select wire:model="inquiry.city_id"
                                class="form-control select-inquiry {{ $errors->has('inquiry.city_id') ? 'border border-danger' : '' }}"
                                name="city">
                                <option selected="" value="">
                                    Select City
                                </option>
                                @foreach ($listForFields['city'] as $cities)
                                    <option value="{{ $cities['id'] }}">
                                        {{ $cities['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('inquiry.city_id')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif
                    @if ($input->serviceStaticInput->name == 'ConferenceMode')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <select wire:model="inquiry.is_video_call"
                                class="form-control select-inquiry {{ $errors->has('inquiry.is_video_call') ? 'border border-danger' : '' }}"
                                name="district">
                                <option selected="" value="">
                                    Video Call
                                </option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('inquiry.is_video_call')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif
                    @if ($input->serviceStaticInput->name == 'Duration')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <select wire:model="inquiry.duration"
                                class="form-control select-inquiry {{ $errors->has('inquiry.duration') ? 'border border-danger' : '' }}"
                                name="duration">
                                <option selected="" value="">
                                    Select Duration
                                </option>
                                <option value="5_min">5 min</option>
                                <option value="10_min">10 min</option>
                                <option value="15_min">15 min</option>
                            </select>
                            @error('inquiry.duration')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif
                    @if ($input->serviceStaticInput->name == 'DateAndTime')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="selectedDate"
                                class="form-control {{ $errors->has('selectedDate') ? 'border border-danger' : '' }}"
                                type="date" name="appoinment_datetime" placeholder="Select Appointment Date">
                            @error('selectedDate')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="selectedTime"
                                class="form-control {{ $errors->has('selectedTime') ? 'border border-danger' : '' }}"
                                type="time" name="appoinment_datetime" placeholder="Select Appointment Time">
                            @error('selectedTime')
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif
                    @if ($input->serviceStaticInput->name == 'Map')
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <button id="current-location-button" class="btn btn-primary"><i
                                    class="fas fa-map-marker-alt mr-2"></i>Get My Current
                                Location</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div id="map-container"
                                style="display: flex; justify-content: center; align-items: center;">
                                <input type="text" id="location-input" class="form-control"
                                    placeholder="Search location"
                                    style=" position: absolute; top: 10px; z-index: 1; width: 50%;">
                                <div wire:ignore id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mt-0">
                            <input type="hidden" wire:model="inquiry.latitude">
                            @error('inquiry.latitude')
                                <strong><span class="text-danger"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group mt-0">
                            <input type="hidden" wire:model="inquiry.longitude">
                            {{-- @error('inquiry.longitude')
                                <strong><span class="text-danger"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror --}}
                        </div>

                        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('googlemaps.key') }}&libraries=places">
                        </script>

                        <script>
                            document.addEventListener("livewire:load", function() {
                                var map;
                                var marker;
                                var searchInput = document.getElementById("location-input");
                                var currentLocationButton = document.getElementById("current-location-button");

                                map = new google.maps.Map(document.getElementById("map"), {
                                    zoom: 12,
                                    center: {
                                        lat: 6.9271,
                                        lng: 79.8612
                                    }
                                });

                                // Get current location using browser's geolocation API
                                currentLocationButton.addEventListener("click", function() {
                                    // Request the user's current location using browser's geolocation API
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(
                                            function(position) {
                                                const currentLatLng = {
                                                    lat: position.coords.latitude,
                                                    lng: position.coords.longitude
                                                };

                                                // Set map's center to current location
                                                map.setCenter(currentLatLng);

                                                // Add marker at current location
                                                addMarker(currentLatLng);

                                                // Emit the current location to the Livewire component
                                                Livewire.emit('locationSelected', {
                                                    latitude: currentLatLng.lat,
                                                    longitude: currentLatLng.lng
                                                });
                                            },
                                            function(error) {
                                                console.log("Error retrieving current location:", error);
                                            }
                                        );
                                    } else {
                                        console.log("Geolocation is not supported by this browser.");
                                    }
                                });

                                // Add click event listener to the map
                                map.addListener("click", function(event) {
                                    const clickedLatLng = {
                                        lat: event.latLng.lat(),
                                        lng: event.latLng.lng()
                                    };

                                    // Remove previous marker
                                    if (marker) {
                                        marker.setMap(null);
                                    }

                                    // Add new marker at clicked location
                                    addMarker(clickedLatLng);

                                    // Emit the selected location to the Livewire component
                                    Livewire.emit('locationSelected', {
                                        latitude: clickedLatLng.lat,
                                        longitude: clickedLatLng.lng
                                    });
                                });

                                // Set up the Places Autocomplete functionality
                                var autocomplete = new google.maps.places.Autocomplete(searchInput);
                                autocomplete.bindTo('bounds', map);

                                autocomplete.addListener('place_changed', function() {
                                    var place = autocomplete.getPlace();

                                    if (!place.geometry) {
                                        console.log("No details available for input: '" + place.name + "'");
                                        return;
                                    }

                                    // Set map's center to the selected place
                                    map.setCenter(place.geometry.location);

                                    // Add marker at the selected place
                                    addMarker(place.geometry.location);

                                    // Emit the selected location to the Livewire component
                                    Livewire.emit('locationSelected', {
                                        latitude: place.geometry.location.lat(),
                                        longitude: place.geometry.location.lng()
                                    });
                                });

                                function addMarker(position) {
                                    marker = new google.maps.Marker({
                                        position: position,
                                        map: map,
                                        title: "My Location"
                                    });
                                }

                                // Emit the selected location to the Livewire component
                                Livewire.on('locationSelected', function(location) {
                                    Livewire.emit('latitudeUpdated', location.latitude);
                                    Livewire.emit('longitudeUpdated', location.longitude);
                                });
                            });
                        </script>
                    @endif
                @endforeach

                @foreach ($listForFields['input'] as $key => $input)
                    @if ($input['type'] == 'text' || $input['type'] == 'email' || $input['type'] == 'datetime-local')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="form.{{ $input['id'] }}"
                                class="form-control {{ $errors->has('form.' . $input['id']) ? 'border border-danger' : '' }}"
                                type="{{ $input['type'] }}" name="{{ $input['slug'] }}"
                                placeholder="{{ $input['placeholder'] }}">
                            @error('form.' . $input['id'])
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @elseif ($input['type'] == 'number')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input wire:model="form.{{ $input['id'] }}"
                                class="form-control {{ $errors->has('form.' . $input['id']) ? 'border border-danger' : '' }}"
                                type="text" name="{{ $input['slug'] }}"
                                placeholder="{{ $input['placeholder'] }}">
                            @error('form.' . $input['id'])
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @elseif ($input['type'] == 'select')
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <select wire:model="form.{{ $input['id'] }}"
                                class="form-control select-inquiry {{ $errors->has('form.' . $input['id']) ? 'border border-danger' : '' }}"
                                name="{{ $input['slug'] }}">
                                @php
                                    $options = explode(',', $input['option']);
                                @endphp
                                <option selected="" value="">
                                    {{ $input['placeholder'] }}
                                </option>
                                @foreach ($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach

                            </select>
                            @error('form.' . $input['id'])
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @elseif ($input['type'] == 'file')
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label class="inquiry-label">{{ $input['placeholder'] }}</label>
                            <input wire:model="form.{{ $input['id'] }}"
                                class="form-control {{ $errors->has('form.' . $input['id']) ? 'border border-danger' : '' }}"
                                type="file" name="{{ $input['slug'] }}" accept="image/*,application/pdf">
                            @error('form.' . $input['id'])
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @else
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea wire:model="form.{{ $input['id'] }}"
                                class="form-control {{ $errors->has('form.' . $input['id']) ? 'border border-danger' : '' }}"
                                name="{{ $input['slug'] }}" placeholder="{{ $input['placeholder'] }}"></textarea>
                            @error('form.' . $input['id'])
                                <strong><span class="text-danger mt-2"><i class="fa fa-exclamation-circle mr-1"
                                            aria-hidden="true"></i>{{ $message }}</span></strong>
                            @enderror
                        </div>
                    @endif
                @endforeach
                @if (!collect($this->listForFields['input'])->isEmpty() || !collect($this->staticInputs)->isEmpty())
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3 form-group message-btn">
                        <button class="theme-btn-one" type="submit" name="submit-form">Submit Enquire<i
                                class="icon-Arrow-Right"></i></button>
                    </div>
                @endif

            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
    <script>
        const input = document.querySelector("#phone");

        const iti = window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
            initialCountry: "LK",
            separateDialCode: true,
        });
        input.addEventListener('change', function() {
            @this.set('inquiry.phone', iti.getNumber());
        });
    </script>
@endpush
