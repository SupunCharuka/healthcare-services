<x-frontend-layout>
    @section('title', 'Mobile Veryfication')
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
                <div class="inner-box">

                    <div class="content-box">
                        <div class="title-box">
                            <h3>Login to Your Account</h3>

                        </div>
                        <div class="inner">

                            <div class="mb-4 text-sm font-weight-bold">
                                {{ __('Forgot your password? No problem. Just let us know your mobile number and we will mobile number you a password reset link that will allow you to choose a new one.') }}
                            </div>
                            @if ($errors->any())
                                <div>
                                    <div class="font-medium text-danger">{{ __('Whoops! Something went wrong.') }}</div>

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

                            @if (session('error'))
                                <div class="mb-4 font-medium text-sm text-danger">
                                    {{ session('error') }}
                                </div>
                            @endif



                            <form method="POST" action="{{ route('forgot-password.mobile.send-otp') }}">
                                @csrf
                                <div class="row clearfix">

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="code">Enter your Phone Number</label>

                                        <x-input id="phone" type="text" name="phone" required />
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn  mt-4">
                                        <button type="submit" class="theme-btn-one">
                                            {{ __('Done') }}<i class="icon-Arrow-Right"></i></button>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <p>Forgot password <a href="{{ route('password.request') }}">via Email</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- registration-section end -->
    @endsection
    <x-slot name="scripts">
        <script src="{{ asset('assets/frontend/js/intlTelInput.min.js') }}"></script>
        <script>
            const input = document.querySelector("#phone");

            const iti = window.intlTelInput(input, {
                utilsScript: "{{ asset('assets/frontend/js/build/utils.js') }}",
                initialCountry: "LK",
                separateDialCode: true,
            });

            document.querySelector("form").addEventListener("submit", function(e) {
                e.preventDefault(); 
                const phoneNumber = iti.getNumber();
                document.querySelector("#phone").value = phoneNumber;
                this.submit();
            });
        </script>
    </x-slot>
</x-frontend-layout>
