@extends('layouts.latest.students')
@section('title') Messsages Page @endsection

{{-- page style @S --}}
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('latest/assets/admin-css/message.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
<style>
    .message-list-page-wrap {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== message list page @S ==== --}}
<main class="message-list-page-wrap student-messages-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="messages-box">
                    {{-- leftbar side start --}}
                    <div class="chat-person-list-box">
                        {{-- title --}}
                        <div class="title">
                            <h1>Messages <span>40</span></h1>
                            <a href="#"><img src="{{asset('latest/assets/images/icons/m-user.svg')}}" alt="ic"
                                    class="img-fluid"> Create Group</a>
                        </div>
                        {{-- title --}}
                        {{-- chat filter --}}
                        <div class="header-filter">
                            <div class="search">
                                <img src="{{asset('latest/assets/images/icons/search-m.svg')}}" alt="ic"
                                    class="img-fluid">
                                <input type="text" placeholder="Search" class="form-control">
                            </div>
                            <div class="chat-filter">
                                <div class="dropdown">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{asset('latest/assets/images/icons/filter-2.svg')}}" alt="ic"
                                            class="img-fluid"> All Chat
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item active" href="#">All Chat</a></li>
                                        <li><a class="dropdown-item" href="#">Groups</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- chat filter --}}

                        {{-- leftbar person list start --}}
                        <div class="person-tab-body">
                            {{-- single person start --}}
                            <div class="single-person">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/update-5.png') }}" alt="Avatar"
                                            class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="name">
                                            <a href="#" class="name">Katherine Moss</a>
                                        </div>
                                        <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
                                    </div>
                                    {{-- action --}}
                                    <div class="dropdown">
                                        <a class="btn" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
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
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}"
                                                        alt="ic" class="img-fluid"> Create group with Katherine
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
                            {{-- single person end --}}
                            {{-- single person start --}}
                            <div class="single-person">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/update-2.png') }}" alt="Avatar"
                                            class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="name">
                                            <a href="#" class="name">Katherine Moss</a>
                                        </div>
                                        <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
                                    </div>
                                    {{-- action --}}
                                    <div class="dropdown">
                                        <a class="btn" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
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
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}"
                                                        alt="ic" class="img-fluid"> Create group with Katherine
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
                            {{-- single person end --}}
                            {{-- single person start --}}
                            <div class="single-person">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/update-3.png') }}" alt="Avatar"
                                            class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="name">
                                            <a href="#" class="name">Katherine Moss</a>
                                        </div>
                                        <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
                                    </div>
                                    {{-- action --}}
                                    <div class="dropdown">
                                        <a class="btn" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
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
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}"
                                                        alt="ic" class="img-fluid"> Create group with Katherine
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
                            {{-- single person end --}}
                            {{-- single person start --}}
                            <div class="single-person">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/update-4.png') }}" alt="Avatar"
                                            class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>

                                    <div class="media-body">
                                        <div class="name">
                                            <a href="#" class="name">Katherine Moss</a>
                                        </div>
                                        <p>You: Sure thing, I’ll have a l.. <span>12m</span></p>
                                    </div>
                                    {{-- action --}}
                                    <div class="dropdown">
                                        <a class="btn" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
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
                                                <a class="dropdown-item" href="#">
                                                    <img src="{{ asset('latest/assets/images/icons/messages/users.svg') }}"
                                                        alt="ic" class="img-fluid"> Create group with Katherine
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
                            {{-- single person end --}}
                        </div>
                        {{-- leftbar person list end --}}
                    </div>
                    {{-- leftbar side end --}}

                    {{-- chat body right side start --}}
                    <div class="chat-main-body-box">
                        {{-- room header start --}}
                        <div class="chat-room-head">
                            <div class="media">
                                <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}" alt="Avatar"
                                    class="img-fluid">

                                <div class="media-body">
                                    <h5 class="name">Katherine Moss <span><i class="fas fa-circle"></i> Online</span>
                                    </h5>
                                    <p>@kathy</p>
                                </div>
                                <a href="#" class="view-bttn">View Profile</a>
                            </div>
                        </div>
                        {{-- room header end --}}

                        {{-- chat body list start --}}
                        <div class="main-chat-room">
                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="text">
                                            <p>Thanks Olivia! Almost there. I’ll work on making those changes
                                                you suggested and will shoot it over.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}
                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="text">
                                            <p>Hey Olivia, I’ve finished with the requirements doc! I made some notes in
                                                the gdoc as well for Phoenix to look over.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}
                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="file">
                                            <div class="media">
                                                <img src="{{ asset('latest/assets/images/icons/messages/pdf.svg') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <div class="media-body">
                                                    <h5><a href="#">Tech requirements.pdf</a></h5>
                                                    <span>1.2 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}

                            {{-- message item start --}}
                            <div class="message-item sender-item">
                                <div class="media main-media"> 
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>You</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="file">
                                            <div class="media">
                                                <img src="{{ asset('latest/assets/images/icons/messages/pdf.svg') }}"
                                                    alt="Avatar" class="img-fluid">
                                                <div class="media-body">
                                                    <h5><a href="#">Tech requirements.pdf</a></h5>
                                                    <span>1.2 MB</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}

                            {{-- message item sender start --}}
                            <div class="message-item sender-item">
                                <div class="media main-media">
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>You</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="text">
                                            <p>Awesome! Thanks. I’ll look at this <br> today.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item sender end --}}

                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="text">
                                            <p>No rush though — we still have to wait for Lana’s designs.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}

                            {{-- time block --}}
                            <div class="date-status">
                                <hr>
                                <span>Today</span>
                            </div>
                            {{-- time block --}}

                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6>
                                            <span>Today 2:20pm</span>
                                        </div>
                                        <div class="text">
                                            <p>Hey Olivia, can you please review the latest design when you can?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}

                            {{-- message item sender start --}}
                            <div class="message-item sender-item">
                                <div class="media main-media">
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>You</h6>
                                            <span>Just now</span>
                                        </div>
                                        <div class="text">
                                            <p>Sure thing, I’ll have a look today. They’re looking great!</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- message react --}}
                                <div class="react-box">
                                    <ul>
                                        <li><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="Katherine Moss">&#x2764;</span></li>
                                    </ul>
                                </div>
                                {{-- message react --}}
                            </div>
                            {{-- message item sender end --}} 

                            {{-- message item start --}}
                            <div class="message-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6>Katherine Moss</h6> 
                                        </div>
                                        <div class="typing">
                                            <i class="fa-solid fa-ellipsis fa-fade"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- message item end --}}

                        </div>
                        {{-- chat body list end --}}

                        {{-- message send actions start --}}
                        <form method="POST" action="" class="send-actions">
                            <div class="message-send-box">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Send a message" name="message">
                                </div>
                                <div class="file-attach-bttns"> 
                                    <button type="button" class="btn btn-emoji">
                                        <img src="{{ asset('latest/assets/images/icons/messages/wmoji.svg') }}"
                                            alt="Avatar" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-emoji">
                                        <img src="{{ asset('latest/assets/images/icons/messages/line.svg') }}"
                                            alt="Avatar" class="img-fluid">
                                    </button>
                                    <button class="btn btn-submit" type="submit">
                                       Send
                                    </button>
                                </div>
                            </div>
                        </form>
                        {{-- message send actions end --}}
                        
                    </div>
                    {{-- chat body right side end --}}
                </div>
            </div>
        </div>
    </div>
</main>
{{-- ==== message list page @E ==== --}}
@endsection
{{-- page content @E --}}

@section('script')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection 