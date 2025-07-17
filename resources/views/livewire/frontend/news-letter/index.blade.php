<div class="col-lg-6 col-md-12 col-sm-12 right-column">
    <div class="content_block_4">
        <div class="content-box">
            <h3>Sign up for Email</h3>
            <form wire:submit.prevent="subscribe" class="subscribe-form">
                <div class="form-group">
                    <input type="email" wire:model.lazy="email" name="email" placeholder="Your Email" required="">
                    @error('email') <span class="text-white ml-1">{{ $message }}</span> @enderror
                    <button type="submit" class="theme-btn-one">Submit now<i class="icon-Arrow-Right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>