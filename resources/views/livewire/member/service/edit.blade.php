<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Edit Service</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save" class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label" for="">Title</label>
                        <input wire:model.lazy="service.title" class="form-control" id="title" type="text"
                            required="">
                        @error('service.title')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label" for="">Category</label>
                        <select wire:model.lazy="service.service_category_id" class="form-select" id="category"
                            name="category" required="">
                            {{-- <option selected="" value="">Choose...</option> --}}
                            
                            @foreach ($listForFields['category'] as $categories)
                                <option value="{{ $categories['id'] }}">{{ $categories['name'] }}</option>
                            @endforeach
                        </select>
                        @error('service.service_category_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Subcategory</label>
                        <select wire:model.lazy="service.sub_categories_id" class="form-select" id="subcategory"
                            name="subcategory" required="">
                            <option selected="" value="">Choose...</option>
                            @foreach ($listForFields['subcategory'] as $subcategories)
                                <option value="{{ $subcategories['id'] }}">{{ $subcategories['name'] }}</option>
                            @endforeach
                        </select>
                        @error('service.sub_categories_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                   
                    <div class="col-md-6">
                        <label class="form-label" for="">District</label>
                        <select wire:model.lazy="service.district_id" class="form-select" id="district" name="district"
                            required="">
                            <option selected="" value="">Choose...</option>
                            @foreach ($listForFields['district'] as $districts)
                                <option value="{{ $districts['id'] }}">{{ $districts['name'] }}</option>
                            @endforeach
                        </select>
                        @error('service.district_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">City</label>
                        <select wire:model.lazy="service.city_id" class="form-select" id="city" name="city"
                            required="">
                            <option selected="" value="">Choose...</option>
                            @foreach ($listForFields['city'] as $cities)
                                <option value="{{ $cities['id'] }}">{{ $cities['name'] }}</option>
                            @endforeach
                        </select>
                        @error('service.city_id')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                   
                    <div class="col-md-6">
                        <label class="form-label" for="">Phone Number</label>
                        <div wire:ignore>
                        <input wire:model.lazy="service.number" class="form-control" id="phone" type="text"
                            required="" placeholder="Enter Your Phone Number">
                        </div>
                        @error('service.number')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="form-label" for="">Description</label>
                        <textarea wire:model.lazy="service.description" class="form-control" id="description" name="description" required=""></textarea>
                        @error('service.description')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <div class="form-group row mb-2">
                        <label class="form-label" for="image">Image </label>
                        <div class="">
                            <input class="form-control" id="image" type="file" accept="image/*"
                                placeholder="Select Image">
                            @if ($image && !$errors->has('image'))
                                <img class="mt-2" src="{{ $image }}" width="100" alt="">
                            @elseif(!empty($service->image))
                                <img class="img-thumbnail mt-2"
                                    src="{{ asset('uploads/service-provider/service/' . $service->image) }}" width="100"
                                    alt="">
                            @endif
                            @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4">

                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
    <script>
        const SERVICE = () => @this
        let image = document.getElementById('image')
        // Upload a file:
        image.addEventListener("change", (e) => {
            let file = e.target.files[0];
            canvasResize(file, {
                width: 500,
                height: 500,
                crop: false,
                quality: 80,
                //rotate: 90,
                callback: function(data, width, height) {
                    @this.emit('setImage', data)
                    image.value = ''
                }
            });
        });
    </script>
     <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
     <script>
         const input = document.querySelector("#phone");
 
         const iti = window.intlTelInput(input, {
             utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
             initialCountry: "LK",
             separateDialCode: true,
         });
         input.addEventListener('change', function() {
             @this.set('service.number', iti.getNumber());
         });
     </script>
</div>
