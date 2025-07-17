<div class="md:grid md:grid-cols-6 md:gap-6">
    <div class="md:mt-0 md:col-span-3">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <form wire:submit.prevent="save">
            <div class="px-4 py-3 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="card-header bg-white px-1 py-1">
                    <h5 class="py-1 font-weight-bold">Province</h5>
                </div>
                <div class="grid grid-cols-6 gap-6 mt-4">
                    <!-- Token Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Province Name
                        </label>
                        <input wire:model.lazy="province.name"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="name" type="text" autofocus="autofocus" data-bs-original-title=""
                            title="">
                        @error('province.name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div
                class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
