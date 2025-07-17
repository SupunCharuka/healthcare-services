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

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4 mt-2">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Full Name<span class="text-danger">*</span>
                        </label>
                        <input wire:model="form.name"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            type="text" autofocus="autofocus" data-bs-original-title="" title="" required>
                        @error('form.name')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Email<span class="text-danger">*</span>
                        </label>
                        <input wire:model="form.email"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            type="email" autofocus="autofocus" data-bs-original-title="" title="" required>
                        @error('form.email')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Mobile Number<span class="text-danger">*</span>
                        </label>
                        <input wire:model="form.phone"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            type="text" autofocus="autofocus" data-bs-original-title="" title="" required>
                        @error('form.phone')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-1">
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            SLMC Number
                        </label>
                        <input wire:model="form.slmc_number"
                            class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            type="text" autofocus="autofocus" data-bs-original-title="" title="" required>
                        @error('form.slmc_number')
                            <span class="text-danger mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    @can('users.add-new')
                        <div class="col-span-6 sm:col-span-4 mt-1">
                            <label class="block font-medium text-sm text-gray-700" for="name">
                                Assign Role<span class="text-danger">*</span>
                            </label>
                            <select wire:model="form.role_id"
                                class="form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                name="role" id="role" required>
                                <option value="">Select role name</option>
                                @foreach ($role->all() as $key => $role)
                                    @if (Auth::user()->getRoleNames()->first() == 'super-admin')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @else
                                        @if ($key != 0)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('form.role_id')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    @endcan


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
