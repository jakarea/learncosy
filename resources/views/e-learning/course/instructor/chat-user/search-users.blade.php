
@if( count( $users ) > 0)
    @foreach ($users as $user)
        <div class="single-person user" id="user_{{ $user->id }}">
            <div class="media">
                @if($user)
                    <div class="avatar">
                        @isset( $user->avatar )
                            <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" class="img-fluid">
                        @else
                            <span class="user-name-avatar">{!! strtoupper($user->name[0]) !!}</span>
                        @endisset

                        @if(Cache::has('user-is-online-' . $user->id))
                            <i class="fas fa-circle"></i>
                        @else
                            <i class="fa-solid fa-circle" style="color: #a1a1a5;"></i>
                        @endif
                    </div>

                @endif

                <div class="media-body">
                    <div class="name">
                        <a href="javascript:;" class="name">{{ $user->name }}</a>
                    </div>
                    @if (!empty($user->last_message))
                        {{-- <p>{{ Str::limit($user->last_message, 20, '...') }} <span>{{ $user->last_message_timestamp->diffForHumans() }}</span></p> --}}
                        <p>{{ Str::limit($user->last_message, 20, '...') }} </p>
                    @else
                        {{-- @if ($user->received_file)
                            {{ __("You have received a file")}}
                        @elseif($user->sent_file)
                        {{ __("You have sent a file ") }}
                        @endif --}}
                    @endif

                </div>
                {{-- action --}}
                <div class="dropdown">
                    <a class="btn" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a data-chat-user-id="{{ $user->id }}" class="dropdown-item deleteChatMsg" href="javascript:;">
                                <img src="{{ asset('latest/assets/images/icons/messages/trash.svg') }}"
                                    alt="ic" class="img-fluid"> Delete chat
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal4">
                                <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}"
                                    alt="ic" class="img-fluid"> Create group with
                                Katherine
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <img src="{{ asset('latest/assets/images/icons/messages/mail-open.svg') }}"
                                    alt="ic" class="img-fluid"> Mark as unread
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- action --}}
            </div>
        </div>
    @endforeach
@endif
