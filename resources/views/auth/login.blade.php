<x-frontend-layout>
    @section('title', 'Login')
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/intlTelInput.css') }}">
    </x-slot>
    @section('content')

        <!-- registration-section -->
        <section class="registration-section bg-color-3 my-account-section">
            <div class="pattern">
                <div class="pattern-1"
                    style="background-image: url('{{ asset('assets/frontend/images/shape/shape-85.png') }}');"></div>
                <div class="pattern-2"
                    style="background-image: url('{{ asset('assets/frontend/images/shape/shape-86.png') }}');"></div>
            </div>
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                        <div class="auto-container">
                            <div class="inner-box">
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <div class="content-box">
                                    <div class="title-box">
                                        <h3>Login to Your Account</h3>

                                    </div>
                                    <div class="inner" id="emailLoginForm">

                                        @if ($errors->any())
                                            <div>
                                                <div class="font-medium text-danger">
                                                    {{ __('Whoops! Something went wrong.') }}
                                                </div>

                                                <ul class="mt-3 mb-3 list-disc list-inside text-sm text-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}" class="registration-form">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email"
                                                        value="{{ old('email') }}"
                                                        class="{{ $errors->has('email') ? 'border border-danger' : '' }}"
                                                        placeholder="Enter your email" required="">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" name="password"
                                                        placeholder="Your password" class="password-login" required="">
                                                    {{-- <i class="fa fa-eye password-eye" id="toggleLoginPassword"></i> --}}
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                    <div class="custom-check-box">
                                                        <div class="custom-controls-stacked">
                                                            <label class="custom-control material-checkbox">
                                                                <input type="checkbox"
                                                                    class="material-control-input material-control-indicator"
                                                                    name="remember" id="remember_me" />
                                                                <span class="description">
                                                                    {{ __('Remember me') }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">

                                                    @if (Route::has('password.request'))
                                                        <div class="forgot-passowrd clearfix">
                                                            <a href="{{ route('password.request') }}">Forget
                                                                Password?</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                                    <button type="submit" class="theme-btn-one">Login Now<i
                                                            class="icon-Arrow-Right"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text"><span>or</span></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <a class="continue-button" href="#" id="continueWithPhoneNumber">
                                                <i class="fas fa-phone"></i>Continue with phone number</a>
                                        </div>

                                    </div>
                                    <div class="inner"id="phoneNumberForm" style="display: none;">

                                        @if ($errors->any())
                                            <div>
                                                <div class="font-medium text-danger">
                                                    {{ __('Whoops! Something went wrong.') }}
                                                </div>

                                                <ul class="mt-3 mb-3 list-disc list-inside text-sm text-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}"
                                            class="registration-form phone-form" id="phoneForm">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label for="email">Phone Number</label>
                                                    <input type="text" id="loginPhone" name="email"
                                                        value="{{ old('email') }}"
                                                        class="{{ $errors->has('email') ? 'border border-danger' : '' }}"
                                                        placeholder="Enter your phone number" required=""
                                                        inputmode="numeric" pattern="[0-9]*">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" name="password"
                                                        placeholder="Your password" class="password-login" required="">
                                                    {{-- <i class="fa fa-eye password-eye" id="toggleLoginPassword"></i> --}}
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                    <div class="custom-check-box">
                                                        <div class="custom-controls-stacked">
                                                            <label class="custom-control material-checkbox">
                                                                <input type="checkbox"
                                                                    class="material-control-input material-control-indicator"
                                                                    name="remember" id="remember_me" />
                                                                <span class="description">
                                                                    {{ __('Remember me') }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">

                                                    @if (Route::has('forgot-password.mobile'))
                                                        <div class="forgot-passowrd clearfix">
                                                            <a href="{{ route('password.request') }}">Forget
                                                                Password?</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                                    <button type="submit" class="theme-btn-one">Login Now<i
                                                            class="icon-Arrow-Right"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text"><span>or</span></div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <a class="continue-button" href="#" id="continueWithEmail"><i
                                                    class="fas fa-envelope"></i>Continue with email</a>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3 customer-sign-up">
                        <div class="auto-container">
                            <livewire:auth.register-steps />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- registration-section end -->
    @endsection

    <x-slot name="scripts">
        <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/product-filter.js') }}"></script>
        {{-- <script src="{{ asset('js/auth/login-password.js') }}"></script> --}}
        <script>
            $(document).ready(function() {
                $('#emailLoginForm').show();
                $('#phoneNumberForm').hide();

                $('#continueWithPhoneNumber').click(function(e) {
                    e.preventDefault();

                    $('#emailLoginForm').hide();
                    $('#phoneNumberForm').show();
                });


                $('#continueWithEmail').click(function(e) {
                    e.preventDefault();
                    $('#emailLoginForm').show();
                    $('#phoneNumberForm').hide();
                });
            });
        </script>
        <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
        <script>
            const loginInput = document.querySelector("#loginPhone");

            const loginIti = window.intlTelInput(loginInput, {
                utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
                initialCountry: "LK",
                separateDialCode: true,
            });

            document.querySelector("#phoneForm").addEventListener("submit", function(e) {
                e.preventDefault();
                const phoneNumber = loginIti.getNumber();
                document.querySelector("#loginPhone").value = phoneNumber;
                this.submit();
            });

            loginInput.addEventListener('input', function(event) {
                this.value = this.value.replace(/\D/g, '');
            });
        </script>
    </x-slot>
</x-frontend-layout>
