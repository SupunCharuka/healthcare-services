@extends('backend.customer.layouts.master')

@section('title', 'My Reviews')

@section('link', 'My Reviews')

@section('content')
    <div class="content-container">
        <div class="outer-container">

            <div class="review-list">
                <div class="title-box clearfix">
                    <div class="text pull-left">
                        <h3>My Reviews</h3>
                    </div>
                </div>
                <div class="comment-inner">
                    @foreach ($myReviews as $review)
                        <div class="single-comment-box">
                            <div class="comment">
                                <h4>{{ $review->inquiry->serviceCategory->name }} - {{$review->inquiry->service->user->name}}</h4>
                                <span class="comment-time"><i
                                        class="fas fa-calendar-alt"></i>{{ $review->created_at->format('d M Y, h:iA') }}</span>
                                @php
                                    $ratingValue = $review->rating;
                                @endphp
                                <ul class="rating clearfix">
                                    <li><i class="icon-Star{{ $ratingValue >= 1 ? ' active' : '' }}"></i></li>
                                    <li><i class="icon-Star{{ $ratingValue >= 2 ? ' active' : '' }}"></i></li>
                                    <li><i class="icon-Star{{ $ratingValue >= 3 ? ' active' : '' }}"></i></li>
                                    <li><i class="icon-Star{{ $ratingValue >= 4 ? ' active' : '' }}"></i></li>
                                    <li><i class="icon-Star{{ $ratingValue >= 5 ? ' active' : '' }}"></i></li>
                                </ul>
                                <h6>{{ $review->title }}</h6>
                                <p>{{ $review->message }}</p>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
@endsection
