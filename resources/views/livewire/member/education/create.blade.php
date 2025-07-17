<div class="md:grid md:grid-cols-6 md:gap-6">
    <div class="md:mt-0 md:col-span-2">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif

        <form wire:submit.prevent="store" class="theme-form" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="card-header bg-white px-1 py-1">
                    <h5 class="py-1 font-weight-bold">Education Details</h5>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-3">
                    <label class="block font-medium text-sm text-gray-700" for="name">
                        Title<span class="text-danger">*</span>
                    </label>
                    <input wire:model="education.title"
                        class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full"
                        type="text" autofocus="autofocus" data-bs-original-title="" title="" required>
                    @error('education.title')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6 col-span-6 sm:col-span-4 mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Start Date<span class="text-danger">*</span>
                        </label>
                        <input wire:model="education.start_date"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full"
                            type="date" autofocus="autofocus" data-bs-original-title="" title="" required>
                        @error('education.start_date')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6 col-span-6 sm:col-span-4 mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            End Date<span class="text-danger">*</span>
                        </label>
                        <input wire:model="education.end_date"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full"
                            type="date" data-bs-original-title="" title="" required>
                        @error('education.end_date')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-2 mt-4">
                    <label class="control-label" for="document" id="bank-upload-image">Upload certificate details<span class="text-danger">*</span></label>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!-- File Input -->
                        <input wire:model="document" id="file" class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full px-1 py-1" type="file" accept="image/*,application/pdf">
                        <input id="old_file" type="hidden" value="{{ $education->file }}">
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @error('document')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    @if (!$errors->has('document'))
                        @if ($document && $document->extension() !== 'pdf')
                            <img class="img-thumbnail mt-2" src="{{ $document->temporaryUrl() }}" style="width:300px"
                                 alt="">
                        @elseif($education->file)
                            @php
                                $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                $explodeImage = explode('.', $education->file);
                                $extension = end($explodeImage);
                            @endphp
                            @if (in_array($extension, $imageExtensions,true))
                                <img class="img-thumbnail mt-2"
                                     src="{{ storage('uploads/service-provider/education/' . $education->file) }}" style="width:300px"
                                     alt="">
                            @else
                                <b>
                                    Current PDF : <br> <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png" alt=""/>
                                </b>
                                <a href="{{ storage('uploads/service-provider/education/' . $education->file) }}" target="blank">
                                    {{ $education->file }}
                                </a>
                            @endif
        
                        @endif
                    @endif
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
</div>























