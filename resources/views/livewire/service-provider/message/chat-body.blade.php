<div class="col call-chat-body">
    <div class="card">
        <div class="card-body p-0">
            <div class="row chat-box">
                <!-- Chat right side start-->
                <div class="col pe-0 chat-right-aside">
                    @if ($selectInquiry)
                        <!-- chat start-->
                        <div class="chat">
                            <!-- chat-header start-->
                            <div class="chat-header clearfix"><img class="rounded-circle"
                                    src="{{ asset($selectInquiry->user->profile_photo_url) }}" alt="">
                                <div class="about">
                                    <div class="name">{{ $selectInquiry->user->name }}  <span
                                            class="font-primary f-12"></span>
                                    </div>
                                    <div class="status digits">Last Seen {{ $lastSeen }}</div>
                                </div>

                            </div>
                            <!-- chat-header end-->
                            <div class="chat-history chat-msg-box custom-scrollbar">
                                <ul>

                                    @foreach ($messages as $message)
                                        <li class="{{ $message->sender_id == auth()->id() ? '' : 'clearfix' }}">
                                            <div
                                                class="message {{ $message->sender_id == auth()->id() ? 'my-message' : 'other-message pull-right' }}">
                                                <img class="rounded-circle {{ $message->sender_id == auth()->id() ? 'float-start' : 'float-end' }} chat-user-img img-30"
                                                    src="{{ asset($selectInquiry->user->profile_photo_url) }}"
                                                    alt="">
                                                <div class="message-data text-end"><span
                                                        class="message-data-time">{{ $message->created_at->format('h:i A') }}</span>
                                                </div>
                                                @php
                                                    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
                                                    $pdfExtensions = ['pdf'];
                                                    $explodeImage = explode('.', $message->attachment_name);
                                                    $extension = strtolower(end($explodeImage));
                                                @endphp
                                                @if (in_array($extension, $imageExtensions, true))
                                                    <img src="{{ asset('uploads/conversations/' . $message->attachment_name) }}"
                                                        alt="Image">
                                                @elseif (in_array($extension, $pdfExtensions, true))
                                                    <a href="{{ asset('uploads/conversations/' . $message->attachment_name) }}"
                                                        target="_blank">
                                                        <i class="icon-clip"></i>
                                                        Open PDF
                                                    </a>
                                                @endif
                                                {{ $message->text }}
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <!-- end chat-history-->
                            <div class="chat-message clearfix">
                                <div class="row">
                                    <div class="col-xl-12 d-flex">
                                        <div class="smiley-box bg-primary">
                                            <div class="picker">
                                                <label class="file-upload">
                                                    <input wire:model="attachment" type="file" name="attachment"
                                                        accept="image/*, application/pdf">
                                                    <i class="icon-clip"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="input-group text-box">
                                            <input wire:model="message" class="form-control input-txt-bx"
                                                id="message-to-send" type="text" name="message-to-send"
                                                placeholder="Type a message......">
                                            @error('text')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                            <button wire:click="sendMessage" wire:loading.attr="disabled"
                                                class="btn btn-primary input-group-text" type="button">SEND</button>
                                        </div>
                                    </div>
                                    @if ($attachment)
                                        <p class="mt-1"><strong>Selected File :</strong> {{ $attachment->getClientOriginalName() }}</p>
                                    @endif
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
