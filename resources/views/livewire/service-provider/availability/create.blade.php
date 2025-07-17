<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Add your Availability </h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submitForm" class="theme-form">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="">Your Service</label>
                        <select class="form-select" id="service" name="service" wire:model="availability.service_id">
                            <option selected="" value="">Choose...</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                        @error('availability.service_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-2 form-group">
                        <label class="form-label" for="week_day">Select Days:</label>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="monday"
                                value="monday" wire:model="week_day">
                            <label class="form-check-label" for="monday">Monday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="tuesday"
                                value="tuesday" wire:model="week_day">
                            <label class="form-check-label" wire:loading.attr="disabled" for="tuesday">Tuesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="wednesday"
                                value="wednesday" wire:model="week_day">
                            <label class="form-check-label" for="wednesday">Wednesday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="thursday"
                                value="thursday" wire:model="week_day">
                            <label class="form-check-label" for="thursday">Thursday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="friday"
                                value="friday" wire:model="week_day">
                            <label class="form-check-label" for="friday">Friday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="saturday"
                                value="saturday" wire:model="week_day">
                            <label class="form-check-label" for="saturday">Saturday</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" wire:loading.attr="disabled" type="checkbox" id="sunday"
                                value="sunday" wire:model="week_day">
                            <label class="form-check-label" for="sunday">Sunday</label>
                        </div>
                        @error('week_day')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="form-label" for="start_time">Start Time:</label>
                        <div class="input-group">
                            <input name="start_time" autocomplete="off" wire:model="availability.start_time"
                                class="form-control" type="time">
                        </div>
                        @error('availability.start_time')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="col-md-6 form-group">
                        <label class="form-label" for="end_time">End Time:</label>
                        <div class="input-group">
                            <input wire:model="availability.end_time" name="end_time" autocomplete="off"
                                class="form-control" type="time">
                        </div>
                        @error('availability.end_time')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary mt-3" wire:loading.attr="disabled" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
