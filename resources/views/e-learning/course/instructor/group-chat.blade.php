@isset($currentGroup)
    <div class="chat-room-head group-room-header">
        <div class="media">
            @isset( $currentGroup->avatar )
                <img src="{{ asset($currentGroup->avatar) }}" alt="{{ $currentGroup->name }}" class="img-fluid">
            @else
                <img src="{{ asset('latest/assets/images/icons/messages/no-image.jpg') }}" alt="{{ $currentGroup->name }}" class="img-fluid">
            @endisset

            <div class="media-body">
                <h5 class="name">{{ $currentGroup->name }}</h5>

                <ul class="peoples">
                    {{-- @if( $currentGroup->participants )
                        @foreach ($currentGroup->participants as $participant)
                            <li>
                                <img src="{{ asset( $participant->user->avatar ) }}" alt="{{ $participant->user->name }}" class="img-fluid">
                            </li>
                        @endforeach
                    @endif --}}
                </ul>

            </div>
            {{-- action --}}
            <div class="dropdown">
                <a class="btn" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item active" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="{{ asset('latest/assets/images/icons/messages/add.svg') }}"
                                alt="ic" class="img-fluid"> Add People
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <img src="{{ asset('latest/assets/images/icons/messages/pencil.svg') }}"
                                alt="ic" class="img-fluid"> Rename Group
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            <img src="{{ asset('latest/assets/images/icons/messages/delete.svg') }}"
                                alt="ic" class="img-fluid"> Delete Group
                        </a>
                    </li>
                </ul>
            </div>
            {{-- action --}}
        </div>
    </div>
@endisset

@forelse ($messages as $message)
    <div class="message-item {{ $message->sender_id == Auth::id() ? 'sender-item' : '' }}">
        <div class="media main-media">
            <div class="avatar">
                <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}" alt="Avatar"
                    class="img-fluid">
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


<form method="POST" class="send-actions w-100" id="groupChatMessage" autocomplete="off">
    <div class="dock-bottom">
        <div class="message-send-box">
            <div class="form-group">
                <input type="text" class="form-control" id="chat-message-input" placeholder="Send a message" name="message">
            </div>
            <div class="file-attach-bttns">
                {{-- <button type="button" class="btn btn-emoji">
                    <img src="{{ asset('latest/assets/images/icons/messages/wmoji.svg') }}" alt="Avatar"
                        class="img-fluid">
                </button> --}}
                {{-- <button type="button" class="btn btn-emoji">

                </button> --}}

                <label for="attached">
                    <img src="{{ asset('latest/assets/images/icons/messages/line.svg') }}" alt="Avatar" class="img-fluid">
                </label>
                <input type="file" name="file" class="d-none" id="attached" onchange="displayFileName()">
                <button class="btn btn-submit" type="submit">
                    Send
                </button>
            </div>
        </div>
    </div>
</form>


