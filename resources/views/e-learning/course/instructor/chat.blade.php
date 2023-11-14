@isset($friend)
    <div class="chat-room-head w-100">
        <div class="media">
            <img src="{{ asset($friend->avatar) }}" alt="Avatar" class="img-fluid">

            <div class="media-body">
                <h5 class="name">{{ $friend->name }} <span><i class="fas fa-circle"></i>
                        Online</span>
                </h5>
                @php
                    $emailParts = explode("@", $friend->email);
                    $username = $emailParts[0];
                @endphp
                <p>{{ $username }}</p>
            </div>
            <a href="javascript:;" class="view-bttn open-profile">View Profile</a>
        </div>
    </div>
@endisset


@forelse ($messages as $message)
    <div class="message-item {{ $message->from == Auth::id() ? 'sender-item' : '' }}">
        <div class="media main-media">
            <div class="avatar">
                <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}" alt="Avatar"
                    class="img-fluid">
                <i class="fas fa-circle"></i>
            </div>
            <div class="media-body">
                <div class="d-flex">
                    <h6 class="open-profile">{{ $message->user->name }} &nbsp; </h6>
                    <span> {{ $message->created_at->format('F j, Y') }}
                    </span>
                </div>
                <div class="text">
                    <p>{{ $message->message }}</p>
                </div>
            </div>
        </div>
    </div>

@empty
@endforelse


<form method="POST" class="send-actions w-100" id="chatMessage" autocomplete="off">
    <div class="message-send-box">
        <div class="form-group">
            <input type="text" class="form-control chat-message-input" placeholder="Send a message" name="message">
        </div>
        <div class="file-attach-bttns">
            {{-- <button type="button" class="btn btn-emoji">
                <img src="{{ asset('latest/assets/images/icons/messages/wmoji.svg') }}" alt="Avatar"
                    class="img-fluid">
            </button> --}}
            {{-- <button type="button" class="btn btn-emoji">
                <img src="{{ asset('latest/assets/images/icons/messages/line.svg') }}" alt="Avatar" class="img-fluid">
            </button> --}}
            <button class="btn btn-submit" type="submit">
                Send
            </button>
        </div>
    </div>
</form>
