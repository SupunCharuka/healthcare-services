<x-frontend-layout>
    @section('title', 'Mobile Veryfication')
    <x-slot name="styles">
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

                            {{-- <div class="mb-4 text-sm font-weight-bold">
                            </div> --}}
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
                                <div class="mb-4 font-medium text-sm text-success" id="status-message">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-4 font-medium text-sm text-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div id="message-container"></div>

                            <form method="POST" action="{{ route('verify.code') }}">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="phone">Your Phone Number</label>

                                        <x-input id="phone" type="text" name="phone" required
                                            value="{{ $phoneNumber }}" readonly />
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="code">Enter the verification code</label>

                                        <x-input id="code" type="text" name="code" required />
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-2">
                                        <a href="javascript:void(0);" id="resend-otp-button" class="resend-link">Resend
                                            OTP</a>
                                        <span id="countdown-timer" style="display: none;" class="text-danger"></span>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn  mt-4">
                                        <button type="submit" class="theme-btn-one">
                                            {{ __('Done') }}<i class="icon-Arrow-Right"></i></button>
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
        <script>
            function disableResendButton(duration) {
                const resendButton = document.getElementById('resend-otp-button');
                const countdownTimer = document.getElementById('countdown-timer');
                resendButton.classList.add('disabled');
                resendButton.style.pointerEvents = 'none';
                countdownTimer.style.display = 'block';

                let secondsLeft = duration / 1000;

                const countdownInterval = setInterval(function() {
                    countdownTimer.textContent = `Retry in ${secondsLeft} seconds`;
                    secondsLeft--;

                    if (secondsLeft < 0) {
                        clearInterval(countdownInterval);
                        countdownTimer.style.display = 'none';
                        resendButton.classList.remove('disabled');
                        resendButton.style.pointerEvents = 'auto';
                        countdownTimer.textContent = '';
                    }
                }, 1000);
            }

            document.getElementById('resend-otp-button').addEventListener('click', function(event) {
                event.preventDefault();
                disableResendButton(60000);

                const messageContainer = document.getElementById('message-container');

                const statusMessage = document.getElementById('status-message');
                if (statusMessage) {
                    statusMessage.style.display = 'none';
                }


                $.ajax({
                    type: 'GET',
                    url: "{{ route('verify.sendCode', ['phone' => $phoneNumber]) }}",
                    success: function(response) {

                        messageContainer.innerHTML =
                            '<div class="mb-4 font-medium text-sm text-success">OTP sent successfully.</div>';
                    },
                    error: function(xhr, status, error) {

                        messageContainer.innerHTML =
                            '<div class="mb-4 font-medium text-sm text-danger">Failed to send OTP.</div>';
                    }
                });
            });
        </script>
    </x-slot>
</x-frontend-layout>
