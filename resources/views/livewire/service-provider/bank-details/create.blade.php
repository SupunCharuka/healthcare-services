<div>
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="card md:grid md:grid-cols-3 md:gap-1">
        <div class="card-header md:col-span-1 flex justify-between">
            <h5 class="text-xl font-bold text-gray-900"> {{ __('Bank Account Details') }}</h5>
        </div>
        <div class="md:mt-0 md:col-span-2">
            <form wire:submit.prevent="save">
                <div class="px-4 py-4 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="account_holder" value="{{ __('Account Holder') }}" />
                            <x-input wire:model.lazy="account.account_holder" id="account_holder" type="text"
                                class="mt-1 block w-full" />
                            @error('account.account_holder')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="account_number" value="{{ __('Account Number') }}" />
                            <x-input wire:model.lazy="account.account_number" id="account_number" type="text"
                                class="mt-1 block w-full" />
                            @error('account.account_number')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="bank_id" value="{{ __('Bank Name') }}" />
                            <select wire:model.lazy="account.bank_id" id="bank_id" type="text"
                                class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                style="font-size: 1rem !important;">
                                <option selected="" value="">Selecte Bank</option>
                                @foreach ($listForFields['bank'] as $bank)
                                    <option value="{{ $bank['id'] }}">{{ $bank['bank_name'] }}</option>
                                @endforeach
                            </select>
                            @error('account.bank_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="branch_id" value="{{ __('Bank Branch') }}" />
                            <select wire:model.lazy="account.branch_id" id="branch_id" type="text"
                                class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                style="font-size: 1rem !important;">>
                                <option selected="" value="">Selecte Branch</option>
                                @foreach ($listForFields['branch'] as $branch)
                                    <option value="{{ $branch['id'] }}">{{ $branch['branch_name'] }}</option>
                                @endforeach
                            </select>
                            @error('account.branch_id')
                                <p class="text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="bankBookImg" value="{{ __('Upload your bank book details') }}" />

                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <input wire:model="bankBookImg" id="file"
                                    class="mt-1 block w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none rounded-md shadow-sm py-2"
                                    type="file" accept="image/*,application/pdf">
                                <input id="old_dile" type="hidden" value="{{ $account->bank_book }}">
                                <!-- Progress Bar -->
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                            @error('bankBookImg')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                            @if (!$errors->has('bankBookImg'))
                                @if ($bankBookImg && $bankBookImg->extension() !== 'pdf')
                                    <img class="img-thumbnail mt-2" src="{{ $bankBookImg->temporaryUrl() }}"
                                        style="width:300px" alt="">
                                @elseif($account->bank_book)
                                    @php
                                        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                        $explodeImage = explode('.', $account->bank_book);
                                        $extension = end($explodeImage);
                                    @endphp
                                    @if (in_array($extension, $imageExtensions, true))
                                        <img class="img-thumbnail mt-2"
                                            src="{{ storage('uploads/service-provider/bank-details/bank-book/' . $account->bank_book) }}"
                                            style="width:300px" alt="">
                                    @else
                                        <b>
                                            Current PDF : <br> <img
                                                src="https://img.icons8.com/fluency/48/000000/pdf-mail.png"
                                                alt="" />
                                        </b>
                                        <a href="{{ storage('uploads/service-provider/bank-details/bank-book/' . $account->bank_book) }}"
                                            target="blank">
                                            {{ $account->bank_book }}
                                        </a>
                                    @endif

                                @endif
                            @endif
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
