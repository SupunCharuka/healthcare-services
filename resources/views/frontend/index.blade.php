@extends('frontend.layouts.master')

@section('title', 'Home')

@section('content')
    <div id="iview" class="main-slider">
        <div data-iview:thumbnail="{{ asset('assets/frontend/media/slider_main/1.jpg') }}" data-iview:image="assets/frontend/media/slider_main/1.jpg"
            data-iview:transition="block-drop-random">
            <div class="container">
                <div class="iview-caption bg-no-caption" data-x="660" data-y="143" data-transition="expandLeft">
                    <div class="custom-caption">
                        <p class="slide-title bg-color_second">A Team Of Medical Professionals</p>
                        <p class="slide-title_second">To Take Care Of Your Health</p>
                        <p class="slide-text">Sed posuere nunc libero pellentesque vitae</p>
                        <p class="slide-text">Vestibulum tincidunt ante ipsum</p>
                        <a href="javascript:void(0);" class="btn bg-color_primary">VIEW SERVICES <span
                                class="btn-plus">+</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div data-iview:thumbnail="{{ asset('assets/frontend/media/slider_main/2.jpg') }}" data-iview:image="assets/frontend/media/slider_main/2.jpg"
            data-iview:transition="block-drop-random">
            <div class="container">
                <div class="iview-caption  bg-no-caption" data-x="260" data-y="293" data-transition="expandLeft">
                    <div class="custom-caption">
                        <p class="slide-title bg-color_second">A Team Of Medical Professionals</p>
                        <p class="slide-title_second">To Take Care Of Your Health</p>
                        <p class="slide-text">Sed posuere nunc libero pellentesque vitae</p>
                        <p class="slide-text">Vestibulum tincidunt ante ipsum</p>
                        <a href="javascript:void(0);" class="btn bg-color_primary">VIEW SERVICES <span
                                class="btn-plus">+</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end iview -->

    {{-- <div class="container">
        <div class="block-hourse bg bg_1 bg_transparent wow zoomIn" data-wow-delay="1s">
            <div class="row">
                <div class="col-md-6">
                    <div class="block-hourse__inner block-hourse__inner_first">
                        <p class="block-hourse__text"><i class="icon icon-note"></i>Need a Doctor for Check-up?</p>
                        <p class="block-hourse__title">JUST MAKE AN APPOINTMENT</p>
                        <a class="btn btn_transparent" href="javascript:void(0);">GET AN APPOINTMENT</a>
                    </div>
                </div>
                <section class="col-md-6">
                    <div class="block-hourse__inner block-hourse__inner_second">
                        <div class="block-hourse__title-table"><i class="icon icon-clock"></i>OPENING HOURS</div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Monday - Friday</td>
                                    <td><span class="line-bottom"></span></td>
                                    <td>08:00am - 10:00pm</td>
                                </tr>
                                <tr>
                                    <td>Saturday - Sunday</td>
                                    <td><span class="line-bottom"></span></td>
                                    <td>09:00am - 06:00pm</td>
                                </tr>
                                <tr>
                                    <td>Emergency Services</td>
                                    <td><span class="line-bottom"></span></td>
                                    <td>24 hours Open</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <!-- end row -->
        </div>
        <!-- end block-hourse -->
    </div> --}}
    <!-- end container -->

    <section class="advantages wow fadeInUp" data-wow-delay="1.5s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="ui-title-block">Welcome to <strong class="font-weight_600">HEALTHCARE</strong><span
                            class="font-weight-norm color_primary">AGENCY</span></h1>
                    <div class="ui-subtitle-block">Our medical specialists care about you & your family’s health</div>
                </div>
                <section class="advantages__inner col-sm-4"> <i class="icon flaticon-medical51 color_second"></i>
                    <h2 class="ui-title-inner">HealthCare Professionals</h2>
                    <i class="decor-brand"></i>
                    <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent
                        justo
                        aoreet dignissim lectus etiam ipsum habitant tristique</p>
                    <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a>
                </section>
                <section class="advantages__inner col-sm-4"> <i class="icon flaticon-medical109 color_second"></i>
                    <h2 class="ui-title-inner">Medical Excellence</h2>
                    <i class="decor-brand"></i>
                    <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent
                        justo
                        aoreet dignissim lectus etiam ipsum habitant tristique</p>
                    <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a>
                </section>
                <section class="advantages__inner col-sm-4"> <i class="icon flaticon-healthcare6 color_second"></i>
                    <h2 class="ui-title-inner">Latest Technologies</h2>
                    <i class="decor-brand"></i>
                    <p class="ui-text text-center">Sed posuere nunc libero pellentesque vitae ultrices posuere. Praesent
                        justo
                        aoreet dignissim lectus etiam ipsum habitant tristique</p>
                    <a class="btn btn_small" href="javascript:void(0);">LEARN MORE</a>
                </section>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end advantages -->

    <section class="section bg bg_2 bg_transparent text-center">

        <div class="icon-tabs-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="ui-title-block color_white">Our <strong>Advantages</strong></h2>
                        <div class="ui-subtitle-block no-spacing">You have a number of reasons to choose us!</div>
                    </div>
                    <div class="icon-tabs">
                        <div class="col-md-6 wow bounceInLeft">
                            <ul class="list-icons ">
                                <li class="active ">
                                    <a href="#icontab1" aria-controls="icontab1" role="tab" data-toggle="tab"><span
                                            class="icon-round bg-color_second helper "><i
                                                class="icon fa fa-ambulance"></i></span></a>
                                </li>
                                <li> <a href="#icontab2" aria-controls="icontab2" role="tab" data-toggle="tab"><span
                                            class="icon-round bg-color_second helper"><i
                                                class="icon fa fa-heartbeat"></i></span></a></li>
                                <li> <a href="#icontab3" aria-controls="icontab3" role="tab" data-toggle="tab"><span
                                            class="icon-round bg-color_second helper"><i
                                                class="icon fa fa-hospital-o"></i></span></a></li>
                                <li> <a href="#icontab4" aria-controls="icontab4" role="tab" data-toggle="tab"><span
                                            class="icon-round bg-color_second helper"><i
                                                class="icon fa fa-user-md"></i></span></a></li>
                                <li> <a href="#icontab5" aria-controls="icontab5" role="tab" data-toggle="tab"><span
                                            class="icon-round bg-color_second helper"><i
                                                class="icon fa fa-shield"></i></span></a></li>
                            </ul>

                        </div>
                        <div class="col-md-6 text-right wow bounceInRight">

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="icontab1"><img
                                        src="media/530x270/1.jpg" height="270" width="530" alt="Foto">

                                    <div class="tab-info">

                                        <p class="title-small">COMMITMENT – We fulfill our promises!</p>
                                        <p class="ui-text text-center color_light-grey">Sed posuere nunc libero
                                            pellentesque vitae
                                            ultrices posuere. Praesent justo laoreet dignissim lectus etiam ipsum habitant
                                            tristique cras
                                            augue ipsum pharetra scelerisq ueac mollis vel metus sed ipsum donec.</p>

                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="icontab2"><img src="media/530x270/2.jpg"
                                        alt="Foto">

                                    <div class="tab-info">

                                        <p class="title-small">Nunc mollis ligula aliquet!</p>
                                        <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus
                                            duic etiamd ipsum
                                            habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc
                                            placerat cursus In
                                            sodales purus non nisi. Suspendisse justo elit vulputate vel sodales sit amet
                                            convallis vel
                                            dolor.</p>

                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="icontab3"><img src="media/530x270/3.jpg"
                                        alt="Foto">


                                    <div class="tab-info">

                                        <p class="title-small">Pellentesque sem class aptent</p>
                                        <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus
                                            duic etiamd ipsum
                                            habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc
                                            placerat cursus In
                                            sodales purus non nisi. Aliquam orci lacus, mattis nec ornare sed</p>

                                    </div>


                                </div>
                                <div role="tabpanel" class="tab-pane" id="icontab4"><img src="media/530x270/4.jpg"
                                        alt="Foto">

                                    <div class="tab-info">

                                        <p class="title-small">Donec id sapien sed ipsum</p>
                                        <p class="ui-text text-center color_light-grey">Justo laoreet dignis sim lectus
                                            duic etiamd ipsum
                                            habitant tristique nam est. Donec venenatis leo eu varius curus da metus nuc
                                            placerat cursus In
                                            sodales purus non nisi. </p>

                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="icontab5"><img src="media/530x270/5.jpg"
                                        alt="Foto">

                                    <div class="tab-info">

                                        <p class="title-small">Why Primary Health Care</p>
                                        <p class="ui-text text-center color_light-grey">Aliquam orci lacus, mattis nec
                                            ornare sed, varius
                                            eget, turpis. Donec eget massa velit interdum interdum. Cras vehicula, pede a
                                            viverra varius
                                            pede sapien commodo turpis et blandit ut nisi. Eonec pede</p>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->

    <div class="banner mod-1 bg bg_3 bg_transparent wow zoomIn" data-wow-delay="1s">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-1">
                    <div class="banner__wrap pull-left">
                        <p class="banner__title">Are you ready to buy this template?</p>
                        <p class="banner__text">Egestas dolor erat vamus suscipit sed ipsum estduin vitae nised volutpat
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1"> <a class="btn btn pull-right" href="javascript:void(0);">PURCHASE
                        NOW
                        <span class="btn-plus">+</span></a> </div>
            </div>
        </div>
    </div>
    <!-- end banner -->

    <div class="section-large bg bg_4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-2 col-sm-6">
                    <h2 class="ui-title-block ui-title-block_small">Services <span>We offer</span></h2>
                    <p class="ui-text">Pellentesque vitae ultrice posuere. Praesent justo laoret dignis lectus etiam ipsum
                        habitant tristique nam est. Donec venentse eu varius cursus masa metus adipiscing ante.</p>
                    <ul class="list-mark list-mark_big">
                        <li><a class="icon icon-login" href="javascript:void(0);">Eye Care Solutions</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">Dental Surgery</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">Blood Tests And X-Rays</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">Health Care Problems</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">Medicies And Drug Store</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">General Prescriptions</a></li>
                        <li><a class="icon icon-login" href="javascript:void(0);">Pregnancy and Births</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 wow bounceInRight" data-wow-delay="1s">
                    <div class="padd_left_20">
                        <h2 class="ui-title-block ui-title-block_small">Hospital <span>Departments</span></h2>
                        <div class="panel-group accordion" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-1"><i class="icon fa"></i></a>
                                    <h3 class="panel-title">Emergancy / Critical Care</h3>
                                </div>
                                <div id="collapse-1" class="panel-collapse collapse in">
                                    <div class="panel-body"> <img src="media/120x125/1.jpg" height="125"
                                            width="120" alt="Foto">
                                        <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan
                                            tristique nam est.
                                            Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat
                                            volutpat diam
                                            uspendise vel sed ipsum justo mattis.</p>
                                        <a href="javascript:void(0);" class="link">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-2"><i class="icon fa"></i></a>
                                    <h3 class="panel-title">Dental Clinic</h3>
                                </div>
                                <div id="collapse-2" class="panel-collapse collapse">
                                    <div class="panel-body"> <img src="media/120x125/1.jpg" height="125"
                                            width="120" alt="Foto">
                                        <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan
                                            tristique nam est.
                                            Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat
                                            volutpat diam
                                            uspendise vel sed ipsum justo mattis.</p>
                                        <a href="javascript:void(0);" class="link">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-3"><i class="icon fa"></i></a>
                                    <h3 class="panel-title">Allergic Diseases</h3>
                                </div>
                                <div id="collapse-3" class="panel-collapse collapse">
                                    <div class="panel-body"> <img src="media/120x125/1.jpg" height="125"
                                            width="120" alt="Foto">
                                        <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan
                                            tristique nam est.
                                            Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat
                                            volutpat diam
                                            uspendise vel sed ipsum justo mattis.</p>
                                        <a href="javascript:void(0);" class="link">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-4"><i class="icon fa"></i></a>
                                    <h3 class="panel-title">Neurology</h3>
                                </div>
                                <div id="collapse-4" class="panel-collapse collapse">
                                    <div class="panel-body"> <img src="media/120x125/1.jpg" height="125"
                                            width="120" alt="Foto">
                                        <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan
                                            tristique nam est.
                                            Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat
                                            volutpat diam
                                            uspendise vel sed ipsum justo mattis.</p>
                                        <a href="javascript:void(0);" class="link">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading"> <a class="btn-collapse" data-toggle="collapse"
                                        data-parent="#accordion" href="#collapse-5"><i class="icon fa"></i></a>
                                    <h3 class="panel-title">Primary Health Care</h3>
                                </div>
                                <div id="collapse-5" class="panel-collapse collapse">
                                    <div class="panel-body"> <img src="media/120x125/1.jpg" height="125"
                                            width="120" alt="Foto">
                                        <p class="ui-text">Craesent justo laoreet dignissim lectus etiam ipsum habitan
                                            tristique nam est.
                                            Donec venenatis leo eu varius cursus ma metus adipiscing ante orb placerat
                                            volutpat diam
                                            uspendise vel sed ipsum justo mattis.</p>
                                        <a href="javascript:void(0);" class="link">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end section -->

    <section class="section bg bg_5 bg_transparent">
        <div class="container">
            <div class="row">
                <div class="col-md-6 color_white wow bounceInleft">
                    <h2 class="ui-title-block color_white font-weight_700">We Diagnose & Treat</h2>
                    <div class="subtitle_mod-1">Unique Problems in Our Research Center</div>
                    <p class="ui-text color_white">Nulla tristique ipsum in quam. Integer ac elit. Duis turpis faucibus
                        non,
                        mollis quis fringilla eros. Praesent tempor molestie metus. Aliquam massa sapien. Aenean cursus
                        mattis
                        sapien. Integer elementum nisi ac volutpat vestibulum enim.</p>
                    <a class="btn btn_transparent" href="javascript:void(0);">WATCH THE VIDEO</a>
                </div>
                <div class="col-md-5 col-md-offset-1"> <a class="link_on-youtube wow bounceInRight"
                        href="https://www.youtube.com/watch?v=NnuaHGW1cwU&rel=0" rel="prettyPhoto" title="YouTube"><i
                            class="icon_video-player icon-camcorder bg-color_primary"></i><img src="media/450x270/1.jpg"
                            height="270" width="450" alt="Link on youtube"></a> </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->

    <section class="section-large">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="ui-title-block text-center">Latest Health<strong> & Medical News</strong></h2>
                    <div class="ui-subtitle-block">Purus sapien consequat vitae sagittis ut facilisis arcu</div>
                    <i class="decor-brand"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <article class="article-short wow bounceInLeft">
                        <ul class="info-post">
                            <li class="date color_primary">30</li>
                            <li class="month">APR</li>
                            <li class="comments"><a href="javascript:void(0);"><i
                                        class="icon icon-bubbles color_second"></i>20</a>
                            </li>
                        </ul>
                        <img src="media/290x250/1.jpg" height="250" width="290" alt="Foto"> <a
                            href="javascript:void(0);" class="category color_primary">Health & Care</a> <a
                            href="javascript:void(0);" class="autor">By Dr.
                            Smith</a>
                        <h3 class="title">Why Primary Health Care is very important in life?</h3>
                        <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est.
                            Donec
                            venenatis leo eu varius cursus mas metus [...]</p>
                        <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="article-short wow bounceInUp" data-wow-delay=".5s">
                        <ul class="info-post">
                            <li class="date color_primary">21</li>
                            <li class="month">MAY</li>
                            <li class="comments"><a href="javascript:void(0);"><i
                                        class="icon icon-bubbles color_second"></i>20</a>
                            </li>
                        </ul>
                        <img src="media/290x250/2.jpg" height="250" width="290" alt="Foto"> <a
                            href="javascript:void(0);" class="category color_primary">Dental Surgery</a> <a
                            href="javascript:void(0);" class="autor">By Dr.
                            Smith</a>
                        <h3 class="title">Proin tortor elit rutrum amet sodales feugiat in diam.</h3>
                        <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est.
                            Donec
                            venenatis leo eu varius cursus mas metus [...]</p>
                        <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                    </article>
                </div>
                <div class="col-sm-4">
                    <article class="article-short wow bounceInRight">
                        <ul class="info-post">
                            <li class="date color_primary">25</li>
                            <li class="month">JUN</li>
                            <li class="comments"><a href="javascript:void(0);"><i
                                        class="icon icon-bubbles color_second"></i>20</a>
                            </li>
                        </ul>
                        <img src="media/290x250/3.jpg" height="250" width="290" alt="Foto"> <a
                            href="javascript:void(0);" class="category color_primary">Eye Disease</a> <a
                            href="javascript:void(0);" class="autor">By Dr.
                            Smith</a>
                        <h3 class="title">Ornare dui vel euismod ultrices rcil libero pulvinar justo.</h3>
                        <p class="ui-text">Justo laoreet dignissim lectus duic etiam ipsum habitant tristique nam est.
                            Donec
                            venenatis leo eu varius cursus mas metus [...]</p>
                        <a class="btn btn_small" href="javascript:void(0);">READ MORE</a>
                    </article>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->

    <ul class="bxslider slider_gallery" data-max-slides="7" data-min-slides="3" data-width-slides="400"
        data-margin-slides="0" data-auto-slides="true" data-move-slides="1" data-infinite-slides="true"
        data-pager="false">
        <li class="slide"><a href="media/carusel/fullscreen/1.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/1.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/2.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/2.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/3.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/3.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/4.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/4.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/1.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/1.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/2.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/2.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/3.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/3.jpg" height="350" width="400"></a>
        </li>
        <li class="slide"><a href="media/carusel/fullscreen/4.jpg" rel="prettyPhoto[gallery1]"><span
                    class="slide_bg"></span><img src="media/carusel/thumbnails/4.jpg" height="350" width="400"></a>
        </li>
    </ul>
    <!-- end slider_gallery -->

    <section class="subscribe bg bg_6 bg_transparent color_white wow zoomIn" data-wow-delay="1s">
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
    </section>
    <!-- end subscribe -->

    <section class="slider-reviews section-large slider-reviews_1-col bg bg_7 bg_transparent">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="ui-title-block text-center">What Our <strong>Patients Are Saying</strong></h2>
                    <div class="ui-subtitle-block text-center">Purus sapien consequat vitae sagittis ut facilisis arcu
                    </div>
                    <i class="decor-brand"></i>
                </div>
                <div class="col-md-11 col-xs-12">
                    <ul class="bxslider" data-max-slides="1" data-min-slides="1" data-width-slides="1000"
                        data-margin-slides="0" data-auto-slides="false" data-move-slides="1"
                        data-infinite-slides="false" data-controls="false">
                        <li class="slide">
                            <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130"
                                    width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span
                                    class="categories">Kidney Patient</span>
                                <span class="categories">Australia</span>
                            </div>
                            <div class="quote">
                                <blockquote> Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem
                                    ipsum
                                    pulvinar leo sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris
                                    metus turpis
                                    iaculis hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut
                                    volutpat eget
                                    nisi. Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa
                                    tristique iaculis.
                                    Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat
                                    orci sed ipsum
                                    mollis quis. </blockquote>
                            </div>
                        </li>
                        <li class="slide">
                            <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130"
                                    width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span
                                    class="categories">Kidney Patient</span>
                                <span class="categories">Australia</span>
                            </div>
                            <div class="quote">
                                <blockquote>
                                    <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum
                                        pulvinar leo
                                        sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus
                                        turpis iaculis
                                        hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat
                                        eget nisi.
                                        Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa
                                        tristique iaculis.
                                        Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat
                                        orci sed
                                        ipsum mollis quis.</p>
                                </blockquote>
                            </div>
                        </li>
                        <li class="slide">
                            <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130"
                                    width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span
                                    class="categories">Kidney Patient</span>
                                <span class="categories">Australia</span>
                            </div>
                            <div class="quote">
                                <blockquote>
                                    <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum
                                        pulvinar leo
                                        sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus
                                        turpis iaculis
                                        hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat
                                        eget nisi.
                                        Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa
                                        tristique iaculis.
                                        Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat
                                        orci sed
                                        ipsum mollis quis.</p>
                                </blockquote>
                            </div>
                        </li>
                        <li class="slide">
                            <div class="info"> <img class="avatar" src="media/avatar_reviews/1.jpg" height="130"
                                    width="130" alt="Avatar"> <span class="name">Vettle Smith</span> <span
                                    class="categories">Kidney Patient</span>
                                <span class="categories">Australia</span>
                            </div>
                            <div class="quote">
                                <blockquote>
                                    <p>Etiam feugiat libero et sapien. Donec rutrum neque ac congue venenatis lorem ipsum
                                        pulvinar leo
                                        sollicitudin metus massa non velit. Maecenas elementum. In a nulla. Mauris metus
                                        turpis iaculis
                                        hendrerit vel pretium non, magna. Morbi elit ipsum mattis vitae placerat ut volutpat
                                        eget nisi.
                                        Aenean vel lectus alc orci elementum tincidunt. Quisque vel ante quis massa
                                        tristique iaculis.
                                        Aenean auctor lorem a felis. Nunc tempus mauris et lectus. Sed at tortor aenean erat
                                        orci sed
                                        ipsum mollis quis.</p>
                                </blockquote>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- end slider-reviews -->

    <div class="banner bg bg_3 bg_transparent wow zoomIn" data-wow-delay="1s">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <ul class="list-progress">
                        <li> <span class="icon-round icon-round_small bg-color_second helper"><i
                                    class="icon fa fa-user-md"></i></span>
                            <div class="info"> <span class="chart" data-percent="126"> <span class="percent"></span>
                                </span> <span class="label-chart">Hospital Rooms</span> </div>
                        </li>
                        <li> <span class="icon-round icon-round_small bg-color_second helper"><i
                                    class="icon fa fa-hospital-o"></i></span>
                            <div class="info"> <span class="chart" data-percent="510"> <span class="percent"></span>
                                </span> <span class="label-chart">Qualified Staff</span> </div>
                        </li>
                        <li> <span class="icon-round icon-round_small bg-color_second helper"><i
                                    class="icon fa fa-heartbeat"></i></span>
                            <div class="info"> <span class="chart" data-percent="6200"> <span class="percent"></span>
                                </span> <span class="label-chart">Satisfied Patients</span> </div>
                        </li>
                        <li> <span class="icon-round icon-round_small bg-color_second helper"><i
                                    class="icon fa fa-shield"></i></span>
                            <div class="info"> <span class="chart" data-percent="513"> <span class="percent"></span>
                                </span> <span class="label-chart">Doctors Medals</span> </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end banner -->
@endsection

@section('scripts')
@endsection
