<x-frontend-layout>
    @section('title', 'Login')
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
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="content-box">
                        <div class="title-box">
                            <h3>Reset Password</h3>

                        </div>
                        <div class="inner">
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

                            @php
                                $user = App\Models\User::find($request->input('id'));
                            @endphp
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <x-input id="email" type="email" name="email" :value="old('email', $request->email ?? $user->email)" required
                                            autofocus autocomplete="username" readonly />
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <x-input type="password" id="password" name="password" required
                                            autocomplete="new-password" />
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                        <x-input type="password" id="password_confirmation" name="password_confirmation"
                                            required autocomplete="new-password" />
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mt-4">
                                        <button type="submit" class="theme-btn-one">{{ __('Reset Password') }}<i
                                                class="icon-Arrow-Right"></i></button>
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
        <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/product-filter.js') }}"></script>
    </x-slot>
</x-frontend-layout>
