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
                    <h5 class="py-1 font-weight-bold">Create Input</h5>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <!-- Token Name -->
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Input Name
                        </label>
                        <input wire:model.lazy="input.name"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="name" type="text" autofocus="autofocus" data-bs-original-title=""
                            title="">
                        @error('input.name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Input Type
                        </label>
                        <select wire:model.lazy="input.type"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="type">
                            <option selected="" value="">Choose...</option>
                            <option value="text">Text</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="select">Select</option>
                            <option value="datetime-local">Date & Time</option>
                            <option value="long-text">Long Text</option>
                            <option value="file">File</option>
                        </select>
                        @error('input.type')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Input PlaceHolder
                        </label>
                        <input wire:model.lazy="input.placeholder"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="placeholder" type="text" autofocus="autofocus" data-bs-original-title=""
                            title="">
                        @error('input.placeholder')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Input Required
                        </label>
                        <select wire:model.lazy="input.required"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="required">
                            <option selected="" value="">Choose...</option>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                        @error('input.required')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($input->type == 'select')
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Add Option:
                        </label>
                        <input wire:model.lazy="input.option"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="option" type="text" autofocus="autofocus" data-bs-original-title=""
                            title="" placeholder="Ex-Apple, Mango, Chery">
                        @error('input.option')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
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
