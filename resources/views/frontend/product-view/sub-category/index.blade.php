@extends('frontend.layouts.master')
@section('title', 'Online Shopping')
@section('styles')
    <link href="{{ asset('assets/frontend/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')

    <!--Page Title-->
    <section class="page-title bg-color-1 background top-link">
        <div class="auto-container">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="lower-content">
                        <ul class="bread-crumb clearfix">
                            <li class="ml-1"><a href="{{ url('') }}">Home</a></li>
                            <li class="ml-1"><a href="{{ route('public.product') }}">Healthcare Products</a></li>
                            <li class="ml-1">{{ $product->name }}</li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="sidebar-widget sidebar-search">
                        <div class="search-inner">
                            <form action="{{ route('public.productSub',['product' => $product]) }}" method="get" class="search-form">
                                <div class="form-group">
                                    <input type="search" name="search-field" placeholder="Search" required="">
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-12">
                    <livewire:frontend.product.cart />
                </div>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- team-style-two -->
    <section class="team-style-two bg-color-3 product-listing">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- ================================== Category List ================================== -->
                <div class="col-lg-3 col-md-3 mb-3 sidebar">
                    <div class="left--container--1QG-mBc">
                        <div class="view-container--container--1vvjvzz">

                            <div class="view-container--title--3rbtHFt">Categories</div>
                            <div class="view-container--content--3NiAmGp">
                                <div class="category--category--15ljggD">
                                    <div class="content">
                                        <ul>
                                            <li style="padding-left: 8px">
                                                <a href="{{ route('public.product') }}" target="_self"
                                                    class="category--link--1pMPE_T"><i
                                                        class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp; <span>All
                                                        Categories</span></a>
                                            </li>

                                            @foreach ($productSubCategories as $productSubCategory)
                                                <li style="padding-left: 16px">

                                                    <a href="{{ route('public.viewSub', ['category' => $productSubCategory]) }}"
                                                        target="_self" class="category--link--1pMPE_T"><i
                                                            class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;
                                                        <span>{{ $productSubCategory->name }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================================== Product ================================== -->
                <div class="col-md-9 col-lg-9">
                    <div class="row" id="products-container">

                        @if (isset($products) && $products->count() > 0)
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-12 team-block product">
                                    <div class="team-block-two wow fadeInUp animated animated" data-wow-delay="00ms"
                                        data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="pattern"
                                                style="background-image: url('{{ asset('assets/frontend/images/shape/shape-43.png') }}');">
                                            </div>
                                            <figure class="image-box" onClick="window.open( '{{ route('view.product', ['product' => $product]) }}' ); return false;" style="cursor: pointer;">

                                                <img src="{{ storage('uploads/admin/product-images/thumb/' . $product->productImages[0]->images) }}"
                                                    alt="">

                                            </figure>
                                            <div class="lower-content">
                                                <p class="product-title"><a
                                                        href="{{ route('view.product', ['product' => $product]) }}">{{ \Illuminate\Support\Str::limit($product->name, 34) }}</a>
                                                </p>


                                                <span class="designation">LKR
                                                    {{ $product->productVariations->first()->price }}</span>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-products col-md-12">
                                <p class="text-center">No products found.</p>
                            </div>
                        @endif
                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            @if ($products->currentPage() > 1)
                                <li><a href="{{ $products->previousPageUrl() }}"><i class="icon-Arrow-Left"></i></a></li>
                            @endif
                    
                            @php
                                $start = max($products->currentPage() - 2, 1);
                                $end = min($products->currentPage() + 2, $products->lastPage());
                            @endphp
                    
                            @for ($i = $start; $i <= $end; $i++)
                                <li>
                                    <a href="{{ $products->url($i) }}" class="{{ $i == $products->currentPage() ? 'current' : '' }}">{{ $i }}</a>
                                </li>
                            @endfor
                    
                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}"><i class="icon-Arrow-Right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team-style-two -->


@endsection

@section('scripts')
<script src="{{ asset('js/frontend/product-height.js') }}"></script>

@endsection
