@extends('frontend.layouts.master')

@section('title', 'Shop')

@section('content')
    <div class="ui-title-page bg_title bg_transparent">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>ONLINE shop</h1>
                    <div class="ui-subtitle-page">Egestas dolor erat vamus suscip ipsum estduin</div>
                </div>
            </div>
        </div>
    </div><!-- end ui-title-page -->


    <div class="border_btm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="icon icon-home color_primary"></i></a></li>
                        <li class="active">Shop Main</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- end breadcrumb -->


    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <aside class="sidebar">
                    <div class="widget widget-search">
                        <form method="get" class="form-search clearfix" id="search-global-form">
                            <input class="form-search__input" type="text" name="" id="search2"
                                placeholder="Search Product / Medicine ...">
                            <button class="form-search__submit" type="submit"><i class="icon icon-magnifier"></i></button>
                        </form>
                    </div><!-- end widget-search -->

                    <div class="widget widget-category">
                        <h3 class="widget-title">categories</h3>
                        <div class="block_content">
                            <ul class="list-categories list-categories_widget">
                                <li><a href="javascript:void(0);"><span class="list-categories__name">Diagnose &amp;
                                            Research</span><span class="list-categories__amout color_primary">15</span></a>
                                </li>
                                <li><a href="javascript:void(0);"><span class="list-categories__name">Cancer
                                            Oncology</span><span class="list-categories__amout color_primary">20</span></a>
                                </li>
                                <li><a href="javascript:void(0);"><span class="list-categories__name">Dental
                                            Surgery</span><span class="list-categories__amout color_primary">6</span></a>
                                </li>
                                <li><a href="javascript:void(0);"><span class="list-categories__name">Neurology</span><span
                                            class="list-categories__amout color_primary">74</span></a></li>
                                <li><a href="javascript:void(0);"><span class="list-categories__name">Drug /
                                            Medicine</span><span class="list-categories__amout color_primary">101</span></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- end widget-category -->


                    <div class="widget widget-price">
                        <h3 class="widget-title">Filter by price</h3>
                        <div id="slider-price"></div>
                        <div class="widget-price__title">
                            <strong>Price From:</strong>
                            <input class="widget-price__input" id="slider-price_min">
                            to
                            <input class="widget-price__input" id="slider-price_max">
                        </div>
                    </div><!-- end widget-price -->


                    <div class="widget widget-top">
                        <h3 class="widget-title">TOP rated Products</h3>
                        <ul class="list-top unstyled">
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/1.jpg') }}" height="68" width="53" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/2.jpg') }}" height="61" width="63" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/3.jpg') }}" height="67" width="48" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i
                                            class="fa fa-star-o"></i> </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- end widget-top -->


                    <div class="widget widget-cloud clearfix">
                        <h3 class="widget-title">TAGS CLOUD</h3>
                        <div class="block_content">
                            <div class="tagcloud">
                                <ul class="wp-tag-cloud unstyled">
                                    <li><a href="/">HealthCare</a></li>
                                    <li><a href="/">Fitness</a></li>
                                    <li><a href="/">Food</a></li>
                                    <li><a href="/">Weight Loss</a></li>
                                    <li><a href="/">Medical Clinic</a></li>
                                    <li><a href="/">Popular Doctors</a></li>
                                    <li><a href="/">Dental</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end widget-cloud -->


                    <div class="widget widget-last">
                        <h3 class="widget-title">Last viewed</h3>
                        <ul class="list-top unstyled">
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/4.jpg') }}" height="66" width="39" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star-o"></i> </div>
                                </div>
                            </li>
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/5.jpg') }}" height="61" width="54" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-top__item">
                                <div class="list-top__foto helper">
                                    <img src="{{ asset('assets/frontend/media/top-products/6.jpg') }}" height="72" width="67" alt="Product">
                                </div>
                                <div class="list-top__inner">
                                    <span class="list-top__info">Curabitur id lectus mae enas non diam</span>
                                    <div class="product-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                            class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i
                                            class="fa fa-star-o"></i> </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- end widget-last -->

                </aside><!-- end sidebar -->
            </div><!-- end col -->


            <div class="col-md-9">
                <main class="main-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sorting-title">
                                Sort By:
                                <div role="select" class="jelect">
                                    <input id="jelect" name="tool" value="0" data-text="imagemin"
                                        type="text" class="jelect-input">
                                    <div tabindex="0" role="button" class="jelect-current">Select Your Department
                                    </div>
                                    <ul class="jelect-options">
                                        <li data-val='0' tabindex="0" role="option"
                                            class="jelect-option jelect-option_state_active">
                                            Department 1</li>
                                        <li data-val='1' tabindex="0" role="option" class="jelect-option">
                                            Department 2</li>
                                        <li data-val='2' tabindex="0" role="option" class="jelect-option">
                                            Department 3</li>
                                    </ul>
                                </div>
                            </div><!-- end sorting-title -->
                        </div><!-- end col -->
                    </div><!-- end row -->


                    <ul class="products">
                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/9.jpg') }}" height="226" width="226" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Electric Muscle Stimulator</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-20%</span>
                                <span class="price-block__price">$149.55</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                            <span class="products__label">SALE</span>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/1.jpg') }}" height="195" width="195" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">GlucoTabs™ Orange</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__price">$21.50</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/2.jpg') }}" height="207" width="186" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Insulin Cool Wallet</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-50%</span>
                                <span class="price-block__price">$29.99</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                            <span class="products__label">NEW</span>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/3.jpg') }}" height="219" width="170" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Autolet® Impression</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__price">$119.50</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/4.jpg') }}" height="163" width="236" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">CryOmega</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-15%</span>
                                <span class="price-block__price">$21.50</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                            <span class="products__label">SALE</span>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/5.jpg') }}" height="214" width="170" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Viora Reaction</a><i
                                    class="icon icon-heart"></i>
                            </h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-50%</span>
                                <span class="price-block__price">$69.99</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/6.jpg') }}" height="195" width="208" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Viora Pristine</a><i
                                    class="icon icon-heart"></i>
                            </h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-50%</span>
                                <span class="price-block__price">$119.50</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/7.jpg') }}" height="229" width="177" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">CeliVites Body Health</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-15%</span>
                                <span class="price-block__price">$21.50</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                        </li>

                        <li class="products__item wow bounceInRight" data-wow-delay=".5s">
                            <a class="products__foto helper" href="shop-product.html">
                                <img src="{{ asset('assets/frontend/media/products/8.jpg') }}" height="221" width="227" alt="Goods">
                            </a>
                            <h4 class="products__name"><a href="shop-product.html">Blood Pressure Monitor</a><i
                                    class="icon icon-heart"></i></h4>
                            <div class="products__info ui-text">Pellentesque vitae ultrice posu praesent justo laoret sed
                                dignis
                            </div>
                            <div class="price-block clearfix">
                                <span class="price-block__discount">-50%</span>
                                <span class="price-block__price">$69.99</span>
                            </div>
                            <div class="products__btn text-center">
                                <button class="btn"><i class="icon icon-basket-loaded"></i> Add to cart</button>
                            </div>
                            <span class="products__label">SALE</span>
                        </li>
                    </ul><!-- end products -->

                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="javascript:void(0);">Previous</a></li>
                            <li><a href="javascript:void(0);">1</a></li>
                            <li><a href="javascript:void(0);">2</a></li>
                            <li><a href="javascript:void(0);">3</a></li>
                            <li><a href="javascript:void(0);">Next</a></li>
                        </ul>
                    </div>
                </main>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->


    <section class="subscribe bg bg_3 bg_transparent color_white wow zoomIn" data-wow-delay="1s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="subscribe__inner clearfix">
                        <div class="pull-left">
                            <h2 class="subscribe__title">Subscribe to Newsletter</h2>
                            <p class="subscribe__text">Get healthy news and solutions to your problems from our experts!
                            </p>
                        </div>
                        <div class="pull-right">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Your email address here ...">
                                    <input class="btn bg-color_primary" type="submit" value="SIGN UP">
                                </div>
                            </form>
                            <p class="subscribe__note">* We respect your privacy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- end subscribe -->
@endsection

@section('scripts')
@endsection
