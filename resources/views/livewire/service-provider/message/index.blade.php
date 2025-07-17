<div class="col call-chat-sidebar col-sm-12">
    <div class="card">
        <div class="card-body chat-body">
            <div class="chat-box">
                <!-- Chat left side Start-->
                <div class="chat-left-aside">
                    <div class="media"><img class="rounded-circle user-image"
                            src="{{ asset(Auth::user()->profile_photo_url) }}" alt="">
                        <div class="about">
                            <div class="name f-w-600">{{ Auth::user()->name }}</div>
                            <div class="status">{{ Auth::user()->getRoleNames()->first() }}</div>
                        </div>
                    </div>
                    <div class="people-list" id="people-list">
                        <div class="search">
                            <form class="theme-form">
                                <div class="mb-3">
                                    <input class="form-control" type="text" placeholder="search"><i
                                        class="fa fa-search"></i>
                                </div>
                            </form>
                        </div>
                        <ul class="list">
                            @foreach ($inquiries as $inquiry)
                                <li class="clearfix">
                                    <a href="javascript:void(0)" wire:click="selectInquiry({{ $inquiry->id }})">
                                        <img class="rounded-circle user-image"
                                            src="{{ asset($inquiry->user->profile_photo_url) }}" alt="">
                                        <div class="status-circle away"></div>
                                        <div class="about">
                                            <div class="name">{{ $inquiry->user->name }} - #{{ $inquiry->id }} </div>
                                            <div class="status">{{ $inquiry->serviceCategory->name }}</div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Chat left side Ends-->
            </div>
        </div>
    </div>
</div>


