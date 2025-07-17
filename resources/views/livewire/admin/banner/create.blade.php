<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card">
        <div wire:loading.delay class="loader-livewire">
            <div class="loader">
                <div class="whirly-loader"></div>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save" class="form theme-form" enctype="multipart/form-data">
                <div class="row mb-3 form-group">
                    <div class="col-md-12">
                        <label class="form-label" for="">Title</label>
                        <input wire:model.lazy="banner.title" class="form-control" id="title" type="text">

                        @error('banner.title')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3 form-group">
                    <div class="col-md-12">
                        <label class="form-label" for="">Link To</label>
                        <input wire:model.lazy="banner.link_to" class="form-control" id="link_to" type="text">

                        @error('banner.link_to')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="image">Upload Image For Desktop</label>

                        <input class="form-control" id="image" type="file" accept="image/*"
                            placeholder="Select Image">
                        @error('image')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        @if ($image && !$errors->has('image'))
                            <img class="img-thumbnail mt-2" src="{{ $image }}" width="300"  alt="">
                        @elseif (!empty($banner->image))
                            <img class="img-thumbnail mt-2" src="{{ storage('uploads/banners/' . $banner->image) }}"
                                width="300" alt="">
                        @endif

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label" for="image">Upload Image For Mobile</label>

                        <input class="form-control" id="mobile_image" type="file" accept="image/*"
                            placeholder="Select Image">
                        @error('mobile_image')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        @if ($mobile_image && !$errors->has('mobile_image'))
                            <img class="img-thumbnail mt-2" src="{{ $mobile_image }}" width="300"  alt="">
                        @elseif (!empty($banner->mobile_image))
                            <img class="img-thumbnail mt-2" src="{{ storage('uploads/banners/mobile-image/' . $banner->mobile_image) }}"
                                width="300" alt="">
                        @endif

                    </div>
                </div>
                <div class="form-group row media mb-2">
                    <label class="col-sm-1 col-form-label mr-4" for="is_active">Active</label>
                    <div class="col-sm-6">
                        <div class="media-body icon-state switch-md">
                            <label class="switch">
                                <input type="checkbox" wire:model.lazy="banner.is_active" id="is_active">
                                <span class="switch-state border-1"></span>
                            </label>
                        </div>
                    </div>
                    @error('banner.is_active')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            const BANNER = () => @this;
            let image = document.getElementById('image')
            // Upload a file:
            image.addEventListener("change", (e) => {
                let file = e.target.files[0];
                canvasResize(file, {
                    width: 1780,
                    crop: false,
                    quality: 90,
                    callback: function(data, width, height) {
                        @this.emit('setsImage', data)
                        image.value = ''
                    }
                });
            });
            let mobile_image = document.getElementById('mobile_image')
            // Upload a file:
            mobile_image.addEventListener("change", (e) => {
                let file = e.target.files[0];
                canvasResize(file, {
                    width: 1780,
                    crop: false,
                    quality: 90,
                    callback: function(data, width, height) {
                        @this.emit('setsMobileImage', data)
                        mobile_image.value = ''
                    }
                });
            });
        </script>
    @endpush
</div>
