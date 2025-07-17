<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card shadow">
        <div class="card-body">
            <form wire:submit.prevent="save" class="theme-form mega-form row">
                <h6>Account Information</h6>
                <div class="row">
                    <div class="mb-3">
                        <label class="col-form-label">Address</label>
                        <input wire:model.="business.address" class="form-control" type="text" placeholder="Address">
                        @error('business.address')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label">District</label>
                        <select wire:model.="business.district_id" class="form-select " id="">
                            <option selected="" value="">Select District</option>
                            @foreach ($listForFields['district'] as $districts)
                                <option value="{{ $districts['id'] }}">{{ $districts['name'] }}</option>
                            @endforeach
                        </select>
                        @error('business.district_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label">City</label>
                        <select wire:model.="business.city_id" class="form-select " id="">
                            <option selected="" value="">Select City</option>
                            @foreach ($listForFields['city'] as $cities)
                                <option value="{{ $cities['id'] }}">{{ $cities['name'] }}</option>
                            @endforeach
                        </select>
                        @error('business.city_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label">Postcode</label>
                        <input wire:model.="business.postcode" class="form-control" type="text"
                            placeholder="Postcode">
                        @error('business.postcode')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr class="mt-4 mb-4">
                <h6>Verify Corporate File</h6>
                <div class="row">
                    <div class="mb-3">
                        <label class="col-form-label">Legal Name/ Business Owner Name</label>
                        <input wire:model.="business.owner_name" class="form-control" type="text"
                            placeholder="Legal Name/ Business Owner Name">
                        @error('business.owner_name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label class="col-form-label">Business Registration Number</label>
                        <input wire:model.="business.registration_no" class="form-control" type="text"
                            placeholder="Business Registration Number">
                        @error('business.registration_no')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="control-label" for="document">Upload Business Documents</label>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <input wire:model="document" id="document" class="form-control" type="file"
                            accept="image/*,application/pdf">
                        <input id="old_document" type="hidden" value="{{ $business->document }}">
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @error('document')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    @if (!$errors->has('document'))
                        @if ($document && $document->extension() != 'pdf')
                            <img class="img-thumbnail mt-2" src="{{ $document->temporaryUrl() }}" style="width:300px"
                                alt="">
                        @elseif(!$document && $business->document)
                            @php
                                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                $explodeImage = explode('.', $business->document);
                                $extension = end($explodeImage);
                            @endphp
                            @if (in_array($extension, $imageExtensions))
                                <img class="img-thumbnail mt-2"
                                    src="{{ storage('uploads/service-provider/business/profile/' . $business->document) }}"
                                    style="width:300px" alt="">
                            @else
                                <b>
                                    Current PDF : <br> <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                        alt="" />
                                </b>
                                <a href="{{ storage('uploads/service-provider/business/profile/' . $business->document) }}"
                                    target="blank">
                                    {{ $business->document }}
                                </a>
                            @endif
                        @endif
                    @endif
                </div>

                <div class="row">
                    <div class="mb-3 mt-3">
                        @if ($editMode)
                            <button class="btn btn-primary" type="submit">Update</button>
                        @else
                            <button class="btn btn-primary" type="submit">Submit</button>
                        @endif
                    </div>
                </div>
                @if ($business->document)
                <div class="row">
                    <div class="mt-2 mb-3">
                        <label class="col-form-label">Status : </label>
                        @if ($business->status == 1)
                            <span class="badge approve-btn p-2 f-14 m-1">
                                <i class="fa fa-check fa-lg"></i>
                                Approved
                            </span>
                        @elseif ($business->status == 2)
                            <span class="badge reject-btn  p-2 f-14 m-1">
                                <i class="fa fa-ban fa-lg"></i>Rejected
                            </span>
                        @else
                            <span class="badge pending-btn p-2 f-14 m-1">
                                <i class="fa fa-check fa-lg"></i>Pending
                            </span>
                        @endif

                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
