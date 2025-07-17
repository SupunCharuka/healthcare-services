<div>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="card md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ $serviceCategory->name }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        @foreach ($staticInputs as $input)
                            @if ($input->serviceStaticInput->name == 'Name')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="{{ __('Enter Your Name') }}" />
                                    <x-input wire:model.lazy="inquiry.name" id="name" type="text"
                                        class="mt-1 block w-full" />
                                    @error('inquiry.name')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif

                            @if ($input->serviceStaticInput->name == 'Email')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="email" value="{{ __('Enter Your Email') }}" />
                                    <x-input wire:model.lazy="inquiry.email" id="email" type="email"
                                        class="mt-1 block w-full" />
                                    @error('inquiry.email')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif

                            @if ($input->serviceStaticInput->name == 'Phone')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone" value="{{ __('Enter Your Phone Number') }}" />
                                    <x-input wire:model.lazy="inquiry.phone" id="phone" type="text"
                                        class="mt-1 block w-full" />
                                    @error('inquiry.phone')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif

                            @if ($input->serviceStaticInput->name == 'Province/District/City')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="district_id" value="{{ __('Select District') }}" />
                                    <select wire:model.lazy="inquiry.district_id" id="district_id" type="text"
                                        class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        style="font-size: 1rem !important;">
                                        <option selected="" value="">Selecte District</option>
                                        @foreach ($listForFields['district'] as $districts)
                                            <option value="{{ $districts['id'] }}">
                                                {{ $district['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('inquiry.district_id')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="city_id" value="{{ __(' Select City') }}" />
                                    <select wire:model.lazy="inquiry.city_id" id="city_id" type="text"
                                        class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        style="font-size: 1rem !important;">
                                        <option selected="" value=""> Select City</option>
                                        @foreach ($listForFields['city'] as $cities)
                                            <option value="{{ $cities['id'] }}">
                                                {{ $cities['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('inquiry.city_id')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif

                            @if ($input->serviceStaticInput->name == 'ConferenceMode')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="is_video_call" value="{{ __('Video Call') }}" />
                                    <select wire:model.lazy="inquiry.is_video_call" id="is_video_call" type="text"
                                        class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        style="font-size: 1rem !important;">
                                        <option selected="" value=""> Video Call</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @error('inquiry.is_video_call')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif


                            @if ($input->serviceStaticInput->name == 'Map')
                                <div class="col-span-6 sm:col-span-4">
                                    <div id="map-container"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <input type="text" id="location-input" class="form-control"
                                            placeholder="Search location"
                                            style=" position: absolute; top: 45%; z-index: 1; width: 25%;">
                                        <div wire:ignore id="map" style="width: 100%; height: 400px;"></div>
                                    </div>
                                    @error('inquiry.latitude')
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

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

                                </div>
                            @endif
                        @endforeach



                        @foreach ($listForFields['input'] as $key => $input)
                            @if ($input['type'] == 'text' || $input['type'] == 'email' || $input['type'] == 'datetime-local')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone" value="{{ $input['placeholder'] }}" />
                                    <x-input wire:model="form.{{ $input['id'] }}" id="phone"
                                        type="{{ $input['type'] }}" name="{{ $input['slug'] }}"
                                        class="mt-1 block w-full" />
                                    @error('form.' . $input['id'])
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @elseif ($input['type'] == 'number')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone" value="{{ $input['placeholder'] }}" />
                                    <x-input wire:model="form.{{ $input['id'] }}" id="phone" type="text"
                                        name="{{ $input['slug'] }}" class="mt-1 block w-full" />
                                    @error('form.' . $input['id'])
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @elseif ($input['type'] == 'select')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="city_id" value=" {{ $input['placeholder'] }}" />
                                    <select wire:model="form.{{ $input['id'] }}" name="{{ $input['slug'] }}"
                                        type="text"
                                        class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        style="font-size: 1rem !important;">
                                        @php
                                            $options = explode(',', $input['option']);
                                        @endphp
                                        <option selected="" value=""> {{ $input['placeholder'] }}</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.' . $input['id'])
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @elseif ($input['type'] == 'file')
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone" value="{{ $input['placeholder'] }}" />
                                    <x-input wire:model="form.{{ $input['id'] }}" id="phone" type="file"
                                        name="{{ $input['slug'] }}" class="mt-1 block w-full"
                                        accept="image/*,application/pdf" />
                                    @error('form.' . $input['id'])
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @else
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="" value="{{ $input['placeholder'] }}" />
                                    <textarea wire:model="form.{{ $input['id'] }}" name="{{ $input['slug'] }}" class="form-control mt-1 block w-full"></textarea>
                                    @error('form.' . $input['id'])
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @if (!collect($this->listForFields['input'])->isEmpty() || !collect($this->staticInputs)->isEmpty())
                    <div
                        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        <x-button wire:loading.attr="disabled">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
