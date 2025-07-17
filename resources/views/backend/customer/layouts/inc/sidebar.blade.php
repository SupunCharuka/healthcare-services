<div class="profile-box patient-profile">
    <div class="upper-box mb-4">
        <div class="cover-image">
            <img src="{{ asset('img/logo3.png') }}" alt="Cover Image">
        </div>
        <figure class="profile-image mb-4">
            @if (Auth::user()->provider_name === 'facebook')
                <img src="{{ Auth::user()->facebook_avatar }}" alt="Facebook Profile Photo">
            @elseif (Auth::user()->provider_name === 'google')
                <img src="{{ Auth::user()->google_avatar }}" alt="Google Profile Photo">
            @else
                <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="Default Profile Photo">
            @endif
        </figure>
        <div class="title-box centred m-0">
            <div class="inner p-0">
                <h3>{{ Auth::user()->name }}</h3>
                <p><i class="fas fa-mail-bulk"></i>{{ Auth::user()->email }}
                </p>
            </div>
        </div>
    </div>
    <div class="profile-info">
        <ul class="list clearfix">
            <li><a href="{{ route('customer.dashboard') }}"
                    class="{{ Route::currentRouteName() === 'customer.dashboard' ? 'current' : '' }}"><i
                        class="fas fa-tv"></i>Dashboard</a></li>

            <li><a href="{{ route('customer.myOrders') }}"
                    class="{{ Route::currentRouteName() === 'customer.myOrders' ? 'current' : '' }}"><i
                        class="fas fa-comments"></i>My Orders</a></li>

            <li><a href="{{ route('customer.invoice.list') }}"
                    class="{{ Route::currentRouteName() === 'customer.invoice.list' ? 'current' : '' }}"><i
                        class="fas fa-file ml-1"></i>My Invoice</a></li>

            <li><a href="{{ route('customer.myInquiry') }}"
                    class="{{ Route::currentRouteName() === 'customer.myInquiry' ? 'current' : '' }}"><i
                        class="fas fa-folder"></i>My Inquiries</a></li>

            <li><a href="{{ route('customer.myReviews') }}"
                    class="{{ Route::currentRouteName() === 'customer.myReviews' ? 'current' : '' }}"><i
                        class="fas fa-comments"></i>My Reviews</a></li>

            <li><a href="{{ route('customer.healthProfile') }}"
                    class="{{ Route::currentRouteName() === 'customer.healthProfile' ? 'current' : '' }}"><i
                        class="fas fa-folder"></i>My Health Profile</a></li>

            <li><a href="{{ route('profile.show') }}"
                    class="{{ Route::currentRouteName() === 'profile.show' ? 'current' : '' }}"><i
                        class="fas fa-user"></i>My Profile</a></li>

            <li><a href="{{ route('customer.messages') }}"
                    class="{{ Route::currentRouteName() === 'customer.messages' ? 'current' : '' }}"><i
                        class="fas fa-comments"></i>Messages</a></li>

            <li><a href="{{ route('customer.supportTicket') }}"
                    class="{{ Route::currentRouteName() === 'customer.supportTicket' ? 'current' : '' }}"><i
                        class="fas fa-question-circle"></i>Suppot Ticket</a></li>

            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                       this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>

        </ul>
    </div>
</div>
