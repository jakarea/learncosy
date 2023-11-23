@isset($friend)
    <div class="chat-room-head w-100">
        <div class="media">
            @isset( $friend->avatar )
                <img src="{{ asset($friend->avatar) }}" alt="{{ $friend->name }}" class="img-fluid">
            @else
                <img src="{{ asset('latest/assets/images/icons/messages/no-image.jpg') }}" alt="{{ $friend->name }}" class="img-fluid">
            @endisset

            <div class="media-body">
                <h5 class="name">{{ $friend->name }}
                    @if(Cache::has('user-is-online-' . $friend->id))
                        <span class="online">
                            <i class="fas fa-circle"></i>
                            Online
                        </span>
                    @else
                        <span class="offline">
                            <i class="fas fa-circle"></i>
                            Offline
                        </span>
                    @endif
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

    <div class="message-item {{ $message->sender_id == Auth::id() ? 'sender-item' : '' }}">
        <div class="media main-media">
            <div class="avatar">

                @isset( $message->user->avatar )
                    <img src="{{ asset($message->user->avatar) }}" alt="{{ $message->user->name }}" class="img-fluid">
                @else
                    <span class="user-name-avatar">{!! strtoupper($message->user->name[0]) !!}</span>
                @endisset

                <i class="fas fa-circle"></i>

            </div>
            <div class="media-body">
                <div class="d-flex">
                    <h6 class="open-profile">{{ $message->user->name ?? "" }} &nbsp; </h6>
                    <span> {{ $message->created_at->format('F j, Y') }}
                    </span>
                </div>

                <div class="text">
                    @if ($message->file)
                        @php
                            $allowedImageExtensions = ['jpg', 'png', 'jpeg', 'gif'];
                            $allowedVideoExtensions = ['webm','mkv','avi','wmv','amv','mp4','mpg','mpeg','m4v','3gp','flv'];
                            $allowedDocumentExtensions = ['pdf', 'zip', 'doc','docx'];
                            $extension = pathinfo($message->file, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array(strtolower($extension), $allowedImageExtensions))
                            <div class="single-chat-image">
                                <a href="{{ asset('storage/chat/'.$message->file) }}" data-lightbox="image-1" data-title="{{ $message->message }}">
                                    <img src="{{ asset('storage/chat/'.$message->file) }}" alt="Image" class="img-fluid">
                                </a>
                            </div>
                        @elseif( in_array(strtolower($extension), $allowedVideoExtensions) )
                            <video src="{{ asset('storage/chat/'.$message->file) }}"></video>
                        @elseif (in_array(strtolower($extension), $allowedDocumentExtensions))
                            @if (strtolower($extension) === 'zip')
                                <a href="{{ route('course.messages.file.download', ['filename' => $message->file]) }}">
                                    <img src="{{ asset('latest/assets/images/icons/messages/zip.png') }}" alt="Avatar" class="img-fluid">
                                </a>
                            @elseif (strtolower($extension) === 'pdf')
                                <a href="{{ route('course.messages.file.download', ['filename' => $message->file]) }}">
                                    <img src="{{ asset('latest/assets/images/icons/messages/pdf.svg') }}" alt="Avatar" class="img-fluid">
                                </a>
                            @elseif (strtolower($extension) === 'docx')
                                <a href="{{ route('course.messages.file.download', ['filename' => $message->file]) }}">
                                    <img src="{{ asset('latest/assets/images/icons/messages/docx.png') }}" alt="Avatar" class="img-fluid">
                                </a>
                            @else
                            @endif
                        @endif
                    @endif

                    @if ($message->message)
                        <p>{{ $message->message }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@empty
@endforelse


<form method="POST" class="send-actions w-100" id="chatMessage" autocomplete="off">

    <div class="dock-bottom">
        <div id="file-preview" class="file-preview">
            <img src="" alt="" class="preview-image img-fluid" id="preview-image">
            <div class="preview-actions">
                <span id="file-type-icon"></span>
                <span class="close-icon" id="close-icon" onclick="removeFile()">✖</span>
            </div>
        </div>

        <div class="message-send-box">
            <div class="form-group">
                <input type="text" class="form-control" id="chat-message-input" placeholder="Send a message"
                    name="message">
            </div>
            <div class="file-attach-bttns">
                <label for="attached" class="message-attached">
                    <i class="fa-solid fa-paperclip"></i>
                </label>
                <input type="file" name="file" class="d-none" id="attached" onchange="displayFileName()">
                <button class="btn btn-submit" type="submit">
                    Send
                </button>
            </div>
        </div>
    </div>

</form>

