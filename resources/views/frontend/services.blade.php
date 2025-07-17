@extends('frontend.layouts.master')
@section('title', 'Services')

@section('content')

    <!--Page Title-->
    <section class="page-title centred bg-color-1">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-70.png') }}');">
            </div>
            <div class="pattern-2" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-71.png') }}');">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Services</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->



    <section class="search-doctors-two" style="margin-bottom: 45px; position: relative;">
        <div class="auto-container">
            <div class="inner-container" style="margin-top: 45px;">
                <div class="row clearfix">
                    @foreach ($serviceCategories as $serviceCategory)
                        @if ($serviceCategory->slug === 'cosmetic')
                            @php
                                $url = route('public.productSub', ['product' => 'cosmetic-care']);
                                $onClickAction = "window.location.href = '{$url}';";
                            @endphp
                        @elseif ($serviceCategory->slug === 'medical-devices-equipment')
                            @php
                                $url = route('public.productSub', ['product' => 'medical-devices']);
                                $onClickAction = "window.location.href = '{$url}';";
                            @endphp
                        @else
                            @php
                                $onClickAction = "openPopup('{$serviceCategory->id}');";
                            @endphp
                            <!-- Custom popup content for this service category -->
                            <div class="custom-popup" id="popup{{ $serviceCategory->id }}">
                                <div class="popup-content">
                                    <div class="popup-header">
                                        <div class="popup-title">
                                            <p> {{ $serviceCategory->name }}</p>
                                        </div>
                                        <div>
                                            <button class="close-popup" onclick="closePopup('{{ $serviceCategory->id }}')">
                                                <div class="close-icon">
                                                    <div class="bar"></div>
                                                    <div class="bar"></div>
                                                </div>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="popup-body">
                                        {{-- {{dd(session('current_language'))}} --}}
                                        

                                        <div class="popup-description">
                                            <p style="color: black">{{ $serviceCategory->description }}</p>
                                        </div>
                                        <div class="popup-actions btn-box">
                                            <a href="{{ route('inquiry', ['servicecategory' => $serviceCategory]) }}"
                                                class="theme-btn-one enquire-btn">Online Enquire Now<i
                                                    class="icon-Arrow-Right"></i></a>
                                            <a href="tel:+94703858585" class="emergency-button">
                                                <i class="fas fa-phone call-icon pulse"></i> Emergency Call
                                                <div class="tooltip">Our Emergency Call service is here for you in critical
                                                    moments. Reach out with a single click to get immediate support when it
                                                    matters most.</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 feature-block">
                            <div class="imagination_content">
                                <div class="imagination_boxed">
                                    <div onclick="{{ $onClickAction }}" style="cursor: pointer;" class="a-tag">
                                        <img src="{{ asset('uploads/admin/service-category/' . $serviceCategory->image) }}"
                                            alt="img">
                                    </div>
                                    <div class="h3-tag">
                                        <div class="a-tag">
                                            <p class="service-category-name"> {{ $serviceCategory->name }}</p>
                                            <h3>{{ $serviceCategory->caption }} </h3>

                                        </div>
                                        <div class="btn-box">
                                            <button class="theme-btn-one enquire-btn" onclick="{{ $onClickAction }}">
                                                Enquire Now<i class="icon-Arrow-Right"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>



@endsection

@section('scripts')
    <script src="{{ asset('assets/frontend/js/jquery.paroller.min.js') }}"></script>
    <script>
        function openPopup(id) {
            // Set the 'position' style to 'initial' for the 'main-header' class
            document.querySelector('.main-header').style.position = 'initial';
            document.querySelector('.sticky-header').style.position = 'absolute';
            document.querySelector('.call-buton').style.display = 'none';
            document.getElementById('popup' + id).style.display = 'block';
        }

        function closePopup(id) {
            // Remove the 'position' style for the 'main-header' class
            document.querySelector('.main-header').style.removeProperty('position');
            document.querySelector('.sticky-header').style.removeProperty('position');
            document.querySelector('.call-buton').style.removeProperty('display');
            document.getElementById('popup' + id).style.display = 'none';
        }
    </script>
@endsection
