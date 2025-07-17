<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Add Bank Name') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{ __('Bank Name') }}" />
                            <x-input wire:model.lazy="bank.bank_name" id="name" type="text"
                                class="mt-1 block w-full" />
                            @error('bank.bank_name')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="code" value="{{ __('Bank Code') }}" />
                            <x-input wire:model.lazy="bank.bank_code" id="code" type="text"
                                class="mt-1 block w-full" />
                            @error('bank.bank_code')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-button wire:loading.attr="disabled">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    
    
</div>
