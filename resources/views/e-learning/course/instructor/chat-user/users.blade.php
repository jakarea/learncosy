@forelse ($users as $user)
    <div class="single-person user" id="{{ $user->id }}">
        <div class="media">
            @isset($user)
                <div class="avatar">
                    <img src="{{ asset($user->avatar) }}" alt="Avatar" class="img-fluid">
                    <i class="fas fa-circle"></i>
                </div>
            @else
                <div class="avatar">
                    <img src="{{ asset('latest/assets/images/update-5.png') }}"
                        alt="Avatar" class="img-fluid">
                    <i class="fas fa-circle"></i>
                </div>
            @endisset

            <div class="media-body">
                <div class="name">
                    <a href="javascript:;" class="name">{{ $user->name }}</a>
                </div>
                <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
            </div>
            {{-- action --}}
            <div class="dropdown">
                <a class="btn" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#">
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
@empty
    <div class="single-persion">
        <h5>User not found</h5>
    </div>
@endforelse
