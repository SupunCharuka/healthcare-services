<div class="inner-box">
    @if (Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="content-box">
        <div class="title-box">
            <h3>Customer Sign-Up</h3>
        </div>
        <div class="inner">
            <form wire:submit.prevent="store" class="registration-form" enctype="multipart/form-data">
                @csrf
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label>Fast name</label>
                        <input wire:model.lazy="form.first_name" type="text" name="first_name"
                            placeholder="Enter your name" required="">
                        @error('form.first_name')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                        <label>Last name</label>
                        <input wire:model.lazy="form.last_name" type="text" name="last_name"
                            placeholder="Enter your name" required="">
                        @error('form.last_name')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>Email</label>
                        <input wire:model.lazy="form.email" type="email" name="email" placeholder="Enter your email"
                            required="">
                        @error('form.email')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" wire:ignore>
                        <label>Mobile Number</label>
                        <input wire:model.lazy="form.phone" type="text" id="registerPhone" name="phone"
                            placeholder="Enter your Mobile Number" required="">
                    </div>
                    @error('form.phone')
                        <div class="text-danger col-lg-12 col-md-12 col-sm-12" style="margin-top:-20px;">
                            <strong> {{ $message }} </strong>
                        </div>
                    @enderror
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group member-type">
                        <label>Gender</label>
                        <div class="row">
                            <label class="col-md-6"><input wire:model.lazy="form.gender" type="radio" name="gender"
                                    value="male"><span>Male</span></label>
                            <label class="col-md-6"><input wire:model.lazy="form.gender" type="radio" name="gender"
                                    value="female"><span> Female</span></label>
                        </div>
                        @error('form.gender')
                            <div class="text-danger">
                                <strong> {{ $message }} </strong>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>Password</label>
                        <input wire:model.lazy="form.password" type="password" id="password" name="password"
                            placeholder="Your password" class="password-register" required="">
                        {{-- <i class="fa fa-eye password-eye" id="togglePassword"></i> --}}
                        <span wire:loading wire:target="form.password">Checking...</span>
                        <span wire:loading.remove
                            class="{{ $passwordStrengthClass }}">{{ $passwordStrengthMessage }}</span>
                        @error('form.password')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                        <label>Confirm password</label>
                        <input wire:model.lazy="form.password_confirmation" type="password" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm password" required="">
                        {{-- <i class="fa fa-eye password-eye" id="togglePassword_confirmation"></i> --}}
                        @error('form.password_confirmation')
                            <div class="text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <div class="custom-check-box">
                                <div class="custom-controls-stacked">
                                    <label class="custom-control material-checkbox">
                                        <input type="checkbox" class="material-control-input material-control-indicator"
                                            wire:model.lazy="form.terms" name="terms" id="terms" required />
                                        <span class="description">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' =>
                                                    '<a target="_blank" href="' .
                                                    route('terms.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Terms of Service') .
                                                    '</a>',
                                                'privacy_policy' =>
                                                    '<a target="_blank" href="' .
                                                    route('policy.show') .
                                                    '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                                    __('Privacy Policy') .
                                                    '</a>',
                                            ]) !!}
                                        </span>
                                        @error('form.terms')
                                            <div class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                        <button type="submit" class="theme-btn-one">Register Now<i
                                class="icon-Arrow-Right"></i></button>
                    </div>
                </div>
            </form>
            {{-- <div class="text"><span>or</span></div>
            <ul class="social-links clearfix">
                <li><a href="{{ route('login.facebook.redirect') }}">Login with Facebook</a></li>
                <li><a href="{{ route('login.google.redirect') }}">Login with Google Plus</a></li>
            </ul> --}}
            <div class="login-now">
                <p>Register as a Service Provider <a href="{{ route('service-provider.register') }}">Register Now</a>
                </p>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
    <script>
        const registerInput = document.querySelector("#registerPhone");

        const registerIti = window.intlTelInput(registerInput, {
            utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
            initialCountry: "LK",
            separateDialCode: true,
        });

        registerInput.addEventListener('change', function() {
            const formattedPhoneNumber = registerIti.getNumber();
            Livewire.emit('phoneNumberUpdated', formattedPhoneNumber);
        });
    </script>
@endpush
