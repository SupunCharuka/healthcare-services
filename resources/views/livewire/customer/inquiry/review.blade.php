<div class="review-box">
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="content-box">
        <div class="title-inner">
            <h3>Write a Review for {{ $inquiryreviews->service->user->name ?? '' }}</h3>
            <p>Don’t hesitate to review me</p>
        </div>

        <div class="content-inner">
            <div class="rating-box">
                <h4>Overall Rating</h4>
                <ul class="rating clearfix">
                    <li wire:click="ratingSelected(1)"
                        class="{{ $ratingValue >= 1 ? 'selected' : '' }}{{ $ratingValue == null ? 'hover' : '' }}"><i
                            class="icon-Star-2"></i></li>
                    <li wire:click="ratingSelected(2)"
                        class="{{ $ratingValue >= 2 ? 'selected' : '' }}{{ $ratingValue == null ? 'hover' : '' }}"><i
                            class="icon-Star-2"></i></li>
                    <li wire:click="ratingSelected(3)"
                        class="{{ $ratingValue >= 3 ? 'selected' : '' }}{{ $ratingValue == null ? 'hover' : '' }}"><i
                            class="icon-Star-2"></i></li>
                    <li wire:click="ratingSelected(4)"
                        class="{{ $ratingValue >= 4 ? 'selected' : '' }}{{ $ratingValue == null ? 'hover' : '' }}"><i
                            class="icon-Star-2"></i></li>
                    <li wire:click="ratingSelected(5)"
                        class="{{ $ratingValue >= 5 ? 'selected' : '' }}{{ $ratingValue == null ? 'hover' : '' }}"><i
                            class="icon-Star-2"></i></li>
                </ul>
            </div>
            <div class="form-inner">
                <form wire:submit.prevent="submitReview">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label>Title of your review</label>
                            <input wire:model="title" type="text" name="title"
                                placeholder="If you could say it in one sentance, what would you say?" required="">
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label>Your review</label>
                            <textarea wire:model="message" name="message" placeholder="Write your review here..."></textarea>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                            <button type="submit" class="theme-btn-one">Send Message<i
                                    class="icon-Arrow-Right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
