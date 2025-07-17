<div class="md:grid md:grid-cols-6 md:gap-6">

    <div class="md:mt-0 md:col-span-2">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <form wire:submit.prevent="save">
            <div class="px-4 py-3 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="card-header bg-white px-1 py-1">
                    <h5 class="py-1 font-weight-bold">Create Blog</h5>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <!-- Token Name -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="Title">
                            Title
                        </label>
                        <input wire:model.lazy="blog.title"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="title" type="text" autofocus="autofocus" data-bs-original-title=""
                            title="">
                        @error('blog.title')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Short Description
                        </label>
                        <textarea wire:model.lazy="blog.short_description" id="short_description" type="text"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"></textarea>
                        @error('blog.short_description')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Description
                        </label>
                        <div wire:ignore>
                            <textarea wire:model.lazy="blog.description" id="description" type="text" class="form-control"></textarea>
                        </div>
                        @error('blog.description')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Image
                        </label>
                        <input class="form-control" id="image" type="file" accept="image/*"
                            placeholder="Select Image">
                        @error('image')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        @if ($image && !$errors->has('image'))
                            <img class="img-thumbnail mt-2" src="{{ $image }}" width="300" alt="">
                        @endif
                    </div>
                </div>
            </div>
            <div
                class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Create
                </button>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/backend/js/canvasResize/binaryajax.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/exif.js') }}"></script>
    <script src="{{ asset('assets/backend/js/canvasResize/canvasResize.js') }}"></script>
    <script>
        const BLOG = () => @this
        let image = document.getElementById('image')
        // Upload a file:
        image.addEventListener("change", (e) => {
            let file = e.target.files[0];
            canvasResize(file, {
                width: 1170,
                // height: 500,
                crop: false,
                quality: 80,
                //rotate: 90,
                callback: function(data, width, height) {
                    @this.emit('setsImage', data)
                    image.value = ''
                }
            });
        });
    </script>
</div>
