@extends('layouts.latest.instructor')
@section('title')
    Messsages Page
@endsection

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

                                {{-- create group box start --}}
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                    aria-expanded="false" aria-controls="collapseExample">
                                    <img src="{{ asset('latest/assets/images/icons/m-user.svg') }}" alt="ic"
                                        class="img-fluid"> Create Group
                                </a>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="create-group-form">
                                    <h4>Create Group</h4>

                                    @include('e-learning.course.instructor.group-admin.admin-info')
                                    <form method="post" class="createGroup" action="{{ route('course.messages.group') }}">
                                        <div class="form-group">
                                            <label for="">Group Name</label>
                                            <input type="text" placeholder="Group Name" class="form-control" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Add People</label>
                                            <input type="text" placeholder="Name"
                                                class="form-control search-group-chat-user">
                                            <input class="addUserId" type="hidden" name="user_id">
                                            <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="a"
                                                class="img-fluid">
                                        </div>
                                        {{-- suggested name box --}}
                                        <div class="suggested-name-box load-suggested-people"></div>
                                        {{-- suggested name box --}}

                                        {{-- person list box start --}}
                                        <div class="person-box-list person-tab-body load-chat-user-for-group"
                                            id="load-chat-user-for-group"></div>
                                        {{-- person list box end --}}

                                        {{-- form submit --}}
                                        <div class="form-submit">
                                            <button type="reset" class="btn btn-cancel">Cancel</button>
                                            <button type="submit" class="btn btn-create">Create</button>
                                        </div>
                                        {{-- form submit --}}
                                    </form>
                                </div>
                            </div>
                            {{-- create group box end --}}

                            {{-- title --}}
                            {{-- chat filter --}}
                            <div class="header-filter">
                                <div class="search">
                                    <img src="{{ asset('latest/assets/images/icons/search-m.svg') }}" alt="ic"
                                        class="img-fluid">
                                    <input type="text" placeholder="Search" class="form-control search-chat-user">
                                </div>
                                <div class="chat-filter">
                                    <div class="dropdown">
                                        <button class="btn" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <img src="{{ asset('latest/assets/images/icons/filter-2.svg') }}" alt="ic"
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
                            <div class="person-tab-body chat-user-load" id="chat-user-load">
                                {{-- single person start --}}
                                {{-- @include('e-learning.course.instructor.message-group.group-list') --}}
                                @include('e-learning.course.instructor.chat-user.search-users')
                                {{-- single person end --}}

                            </div>
                            {{-- leftbar person list end --}}
                        </div>
                        {{-- leftbar side end --}}

                        {{-- chat body right side start --}}
                        <div class="chat-main-body-box">
                            
                            {{-- view profile box start --}}
                            {{-- <div class="view-profile-box" id="profileBox">
                                <div class="profile-box">
                                    <a href="#" id="closeProfile">
                                        <i class="fas fa-close"></i>
                                    </a>
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/big-avatar.png') }}"
                                            alt="a" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <h5>sajib</h5>
                                    <p>Student</p>

                                    <button type="button" class="btn btn-remove">Remove from group</button>
                                </div>

                                <hr>

                                <h5>Contact</h5>

                                <div class="media">
                                    <i class="fa-regular fa-envelope"></i>
                                    <div class="media-body">
                                        <h6>Email</h6>
                                        <a href="#">kellyleannon@gemail.com</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="fa-solid fa-mobile-screen"></i>
                                    <div class="media-body">
                                        <h6>Phone</h6>
                                        <a href="#">+11 1234 567 890</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <i class="fa-brands fa-instagram"></i>
                                    <div class="media-body">
                                        <h6>Instagram</h6>
                                        <a href="#">instagram.com/kellyleannon</a>
                                    </div>
                                </div>
                                <hr class="my-3">

                                <div class="media">
                                    <div class="media-body">
                                        <h6>Date of birth</h6>
                                        <a href="#">21 Jan, 2002</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-body">
                                        <h6>Gender</h6>
                                        <a href="#">Female</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-body">
                                        <h6>Country</h6>
                                        <a href="#">United State</a>
                                    </div>
                                </div>

                            </div> --}}
                            {{-- view profile box end --}}

                            {{-- chat body list start --}}
                            <div class="main-chat-room" style="min-height: auto" id=chat-message>
                                {{-- message item start --}}
                                {{-- <div class="message-item sender-item">
                                <div class="media main-media">
                                    <div class="avatar">
                                        <img src="{{ asset('latest/assets/images/icons/messages/avatar.png') }}"
                                            alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex">
                                            <h6 class="open-profile">Katherine Moss</h6>
                                            <span>Thursday 10:16am</span>
                                        </div>
                                        <div class="text">
                                            <p>Thanks Olivia! Almost there. I’ll work on making those changes
                                                you suggested and will shoot it over.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                {{-- message item end --}}
                                {{-- message item start --}}

                                {{-- message item start --}}
                                {{-- <div class="message-item sender-item">
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
                            </div> --}}
                                {{-- message item end --}}

                                {{-- time block --}}
                                {{-- <div class="date-status">
                                <hr>
                                <span>Today</span>
                            </div> --}}
                                {{-- time block --}}

                                {{-- message item start --}}
                                {{-- <div class="message-item">
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
                            </div> --}}
                                {{-- message item end --}}

                            </div>
                            {{-- chat body list end --}}

                            {{-- message send actions start --}}
                            {{-- <form method="POST" class="send-actions" id="chatMessage" autocomplete="off">
                                <div class="message-send-box">
                                    <div class="form-group">
                                        <input type="text" class="form-control chat-message-input"
                                            placeholder="Send a message" name="message">
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
                            </form> --}}
                            {{-- message send actions end --}}

                        </div>
                        {{-- chat body right side end --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- ==== message list page @E ==== --}}

    {{-- add people to group modal start --}}
    <div class="custom-modal-box">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="create-group-form">

                        <form action="">
                            <div class="form-group mt-0">
                                <label for="" style="font-size: 1.25rem">Add People</label>
                                <input type="text" placeholder="Name" class="form-control">
                                <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="a"
                                    class="img-fluid">
                            </div>
                            {{-- suggested name box --}}
                            <div class="suggested-name-box">
                                {{-- suggested person --}}
                                <div>
                                    <img src="{{ asset('latest/assets/images/m-avatar.png') }}" alt=""
                                        class="img-fluid">
                                    <span>Mollie Hall</span>
                                    <a href="#">
                                        <i class="fas fa-close"></i>
                                    </a>
                                </div>
                                {{-- suggested person --}}
                                {{-- suggested person --}}
                                <div>
                                    <img src="{{ asset('latest/assets/images/avatar.png') }}" alt=""
                                        class="img-fluid">
                                    <span>Mollie Hall</span>
                                    <a href="#">
                                        <i class="fas fa-close"></i>
                                    </a>
                                </div>
                                {{-- suggested person --}}
                                {{-- suggested person --}}
                                <div>
                                    <img src="{{ asset('latest/assets/images/update-5.png') }}" alt=""
                                        class="img-fluid">
                                    <span>Mollie Hall</span>
                                    <a href="#">
                                        <i class="fas fa-close"></i>
                                    </a>
                                </div>
                                {{-- suggested person --}}
                            </div>
                            {{-- suggested name box --}}

                            {{-- person list box start --}}
                            <div class="person-box-list person-tab-body">

                                {{-- person --}}
                                <div class="single-person border-0">
                                    <div class="media p-0 border-0">
                                        <div class="avatar">
                                            <img src="{{ asset('latest/assets/images/update-5.png') }}" alt="Avatar"
                                                class="img-fluid me-0">
                                            <i class="fas fa-circle"></i>
                                        </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <a href="#" class="name">Katherine Moss</a>
                                            </div>
                                            <p>I’ve just published the site again. Looks like...</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-person border-0">
                                    <div class="media p-0 border-0">
                                        <div class="avatar">
                                            <img src="{{ asset('latest/assets/images/update-4.png') }}" alt="Avatar"
                                                class="img-fluid me-0">
                                            <i class="fas fa-circle"></i>
                                        </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <a href="#" class="name">Katherine Moss</a>
                                            </div>
                                            <p>I’ve just published the site again. Looks like...</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-person border-0">
                                    <div class="media p-0 border-0">
                                        <div class="avatar">
                                            <img src="{{ asset('latest/assets/images/update-3.png') }}" alt="Avatar"
                                                class="img-fluid me-0">
                                            <i class="fas fa-circle"></i>
                                        </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <a href="#" class="name">Katherine Moss</a>
                                            </div>
                                            <p>I’ve just published the site again. Looks like...</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-person border-0">
                                    <div class="media p-0 border-0">
                                        <div class="avatar">
                                            <img src="{{ asset('latest/assets/images/update-2.png') }}" alt="Avatar"
                                                class="img-fluid me-0">
                                            <i class="fas fa-circle"></i>
                                        </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <a href="#" class="name">Katherine Moss</a>
                                            </div>
                                            <p>I’ve just published the site again. Looks like...</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-person border-0">
                                    <div class="media p-0 border-0">
                                        <div class="avatar">
                                            <img src="{{ asset('latest/assets/images/update-5.png') }}" alt="Avatar"
                                                class="img-fluid me-0">
                                            <i class="fas fa-circle"></i>
                                        </div>

                                        <div class="media-body">
                                            <div class="name">
                                                <a href="#" class="name">Katherine Moss</a>
                                            </div>
                                            <p>I’ve just published the site again. Looks like...</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- person --}}

                            </div>
                            {{-- person list box end --}}

                            {{-- form submit --}}
                            <div class="form-submit">
                                <button class="btn btn-cancel" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-create" type="submit">Add</button>
                            </div>
                            {{-- form submit --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add people to group modal end --}}

    {{-- add specific person to group modal start --}}
    <div class="custom-modal-box">
        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModal4Label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="create-group-form">
                        <h4>Create Group</h4>
                        @include('e-learning.course.instructor.group-admin.admin-info')
                        <form method="post" class="createGroupModal" action="{{ route('course.messages.group') }}">
                            <div class="form-group">
                                <label for="">Group Name</label>
                                <input type="text" placeholder="Group Name" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Add People</label>
                                <input type="text" placeholder="Name" class="form-control search-group-chat-user">
                                <input class="addUserId" type="hidden" name="user_id">
                                <img src="{{ asset('latest/assets/images/icons/search.svg') }}" alt="a" class="img-fluid">
                            </div>
                            {{-- suggested name box --}}
                            <div class="suggested-name-box load-suggested-people"></div>
                            {{-- suggested name box --}}

                            {{-- person list box start --}}
                            <div class="person-box-list person-tab-body load-chat-user-for-group" id="load-chat-user-for-group"></div>
                            {{-- person list box end --}}

                            {{-- form submit --}}
                            <div class="form-submit">
                                <button type="reset" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-create">Create</button>
                            </div>
                            {{-- form submit --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- add specific person to group modal end --}}

    {{-- rename group modal start --}}
    <div class="custom-modal-box">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="create-group-form">
                        <h4>Rename Group</h4>

                        <div class="chat-room-head group-room-header pt-0 ps-0" style="box-shadow: none">
                            <div class="media">
                                <img src="{{ asset('latest/assets/images/group-img.png') }}" alt="Avatar"
                                    class="img-fluid">

                                <div class="media-body">
                                    <h5 class="name">Math Education </h5>

                                    <ul class="peoples">
                                        <li><img src="{{ asset('latest/assets/images/update-2.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-3.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-4.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-5.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-3.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-4.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><img src="{{ asset('latest/assets/images/update-5.png') }}" alt="a"
                                                class="img-fluid"></li>
                                        <li><span>+5</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <form action="">
                            <div class="form-group mt-0">
                                <label for="">Group Name</label>
                                <input type="text" placeholder="Group Name" class="form-control">
                            </div>

                            {{-- form submit --}}
                            <div class="form-submit">
                                <button class="btn btn-cancel" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-create" type="submit">Save</button>
                            </div>
                            {{-- form submit --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- rename group modal end --}}

    {{-- delete group modal start --}}
    <div class="custom-modal-box">
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModal3Label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="create-group-form text-center">
                        <img src="{{ asset('latest/assets/images/icons/messages/err.svg') }}" alt="a"
                            class="img-fluid">
                        <h4 class="border-0 pb-0 mt-4">Delete This Group</h4>
                        <p>Are you sure you want to delete this group?</p>

                        <form action="">
                            {{-- form submit --}}
                            <div class="form-submit mt-5 error-bttn">
                                <button class="btn btn-cancel" data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-create" type="submit">Delete</button>
                            </div>
                            {{-- form submit --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- delete group modal end --}}
@endsection
{{-- page content @E --}}

@section('script')
    <script>
        // Search single chat user
        $(document).ready(function() {
            $(".search-group-chat-user").on("keyup click paste", function(e) {
                e.preventDefault();
                searchUser($.trim(this.value), ".load-chat-user-for-group", "layout1");
            });
        });

        // Search group chat user
        $(document).ready(function() {
            $(".search-chat-user").on("keyup click paste", function(e) {
                e.preventDefault();
                searchUser($.trim(this.value), ".chat-user-load", "layout2");
            });
        });

        // Search User
        function searchUser(searchTerm, resultContainer, layout) {
            searchTerm = $.trim(searchTerm);
            console.log(searchTerm);
            if (searchTerm !== "") {
                $.ajax({
                    url: "{{ route('course.messages.search') }}",
                    type: 'GET',
                    data: {
                        term: searchTerm,
                        layout: layout
                    },
                    success: function(data) {
                        console.log( data)
                        $(resultContainer).html(data);
                    }
                });
            }else{
                $(".load-chat-user-for-group").empty();
            }
        }


        // Load suggested user
        var existsUsers = [];
        $(document).on('click', '.suggest-people', function() {
            var userId = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{ route('course.messages.suggested.people') }}",
                data: {
                    userId: userId
                },
                success: function(data) {
                    if ($.inArray(userId, existsUsers) === -1) {
                        existsUsers.push(userId);
                        $('.load-suggested-people').append(data);
                        $(".addUserId").val(function(_, currentValues) {
                            return currentValues ? currentValues + ',' + userId : userId;
                        });
                    } else {
                        toastr.error('User already exits!!', 'Error');
                    }
                }
            });
        });

        // Remove suggested people
        $(document).on('click', '.remove-suggested-people', function() {
            var userId = $(this).closest(".suggest-user").attr('id');

            userId = parseInt(userId, 10);
            var indexToRemove = existsUsers.indexOf(userId.toString());
            if (indexToRemove !== -1) {
                existsUsers.splice(indexToRemove, 1);

                $(".addUserId").val(existsUsers.join(','));
            }
            $('#' + userId).remove();
        });

        // Delete single chat history
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteChatMsg')) {
                event.stopPropagation();
                var userId = event.target.getAttribute('data-chat-user-id');

                $.ajax({
                    type: 'get',
                    url: "{{ route('course.messages.delete.singlechat') }}",
                    data: {
                        userId: userId
                    },
                    success: function(data) {
                        toastr.success(data.success, 'Success');
                        $('#single-chat-message-wrap').empty();
                        $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>

    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function() {
            // ajax setup form csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            // Set pusher key
            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: 'ap2',
                forceTLS: true
            });


            // <<<<<========== User Online Activity ===============>>>>>

            // var channel = pusher.subscribe('my-channel');

            // // Presence channel events
            // channel.bind('pusher:subscription_succeeded', function(members) {
            //     members.each(function(member) {
            //         console.log('User online:', member.id);
            //         // Update your UI to show online users
            //     });
            // });

            // channel.bind('pusher:member_added', function(member) {
            //     console.log('User online:', member.id);
            //     // Update your UI to show online users
            // });

            // channel.bind('pusher:member_removed', function(member) {
            //     console.log('User offline:', member.id);
            //     // Update your UI to show offline users
            // });

            // // Your existing code for handling other events
            // channel.bind('my-event', function(data) {
            //     // Handle your existing messaging events
            // });


            // <<<<<========== User Online Activity ===============>>>>>


            var channel = pusher.subscribe('my-channel');

            channel.bind('my-event', function(data) {
                if (my_id == data.from) {
                    $('#user_' + data.to).click();
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // If the receiver is selected, reload the selected user...
                        $('#user_' + data.from).click();
                    } else {
                        // If the receiver is not selected, add a notification for that user
                        var pending = parseInt($('#user_' + data.from).find('.pending').html());

                        if (pending) {
                            $('#user_' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#user_' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

        });

        $(document).on('click', '.user', function() {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            var user_receive_id = $(this).attr('id');
            receiver_id =  user_receive_id.split('_')[1];
            $.ajax({
                type: "get",
                url: '/course/messages/chat/' + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function(data) {
                    $('#chat-message').html(data);
                    // $('#chat-message-input').emojioneArea();
                    scrollToBottomFunc();

                }
            });
        });


        // $(document).on('click', '.group', function() {
        //     $('.user').removeClass('active');
        //     $(this).addClass('active');
        //     $(this).find('.pending').remove();

        //     var group_id = $(this).attr('id');
        //     receiver_id =  group_id.split('_')[1];

        //     $.ajax({
        //         type: "get",
        //         url: '/course/messages/chat/' + receiver_id, // need to create this route
        //         data: "",
        //         cache: false,
        //         success: function(data) {
        //             $('#chat-message').html(data);
        //             // $('#chat-message-input').emojioneArea();
        //             scrollToBottomFunc();

        //         }
        //     });
        // });


        $(document).on('submit', '#chatMessage', function(e) {
            e.preventDefault();
            sendMessage();
        });

        // $(".chat-message-input .emojionearea-editor").on('keypress', function (event) {
        //     alert("hi")
        //     if (event.which === 13) {
        //         event.preventDefault();
        //         sendMessage();
        //     }
        // });


        $(document).on('submit', '.createGroup', function(e) {
            e.preventDefault();
            createGroup(".createGroup");
        });

        $(document).on('submit', '.createGroupModal', function(e) {
            e.preventDefault();
            createGroup(".createGroupModal");
        });

        // Send one to on chat message
        function sendMessage() {
            // var messageText = $('.chat-message-input').emojioneArea().getText();
            var formData = new FormData($('#chatMessage')[0]);
            formData.append("receiver_id", receiver_id);

            var messageText = $('.chat-message-input').val();

            if (receiver_id !== '') {
                $.ajax({
                    type: "post",
                    url: "messages/chat",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        $('.chat-message-input').val('');
                        $('.chat-message-input').emojioneArea().val('');
                        $('#chatMessage')[0].reset();

                    },
                    error: function(jqXHR, status, err) {
                        // Handle error if needed
                    },
                    complete: function() {
                        $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                        scrollToBottomFunc();
                    }
                });
            }
        }

        // Create Group
        function createGroup(formSelector) {
            var formData = new FormData($(formSelector)[0]);
            $.ajax({
                type: "post",
                url: "{{ route('course.messages.group') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    toastr.success(data.success, 'Success');
                    if (data.success) {
                        $(formSelector)[0].reset();
                    }
                    $(".load-suggested-people").empty();
                    $(".load-chat-user-for-group-user").empty();
                    $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                },
                error: function(jqXHR, status, err) {
                    toastr.error('Something went wrong!', 'Error');
                },
                complete: function() {
                    scrollToBottomFunc();
                }
            });
        }

        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.main-chat-room').animate({
                scrollTop: $('.main-chat-room').get(0).scrollHeight
            }, 50);
        }
    </script>





    {{-- tooltip active js --}}
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    {{-- close profile box --}}
    <script>
        // const openPorifles = document.querySelectorAll('.open-profile');
        // const closeIcon = document.getElementById('closeProfile');
        // const profileBox = document.getElementById('profileBox');

        // openPorifles.forEach(openPorifle => {
        //     openPorifle.addEventListener('click', function() {
        //         profileBox.classList.add('active');
        //     });
        // });

        // function closeProfileBox(e) {
        //     e.preventDefault();
        //     this.parentNode.parentNode.classList.remove('active');
        // }
        // closeIcon.addEventListener('click', closeProfileBox);
    </script>

    <script></script>

    <script>
        function displayFileName() {
            var input = document.getElementById('attached');

            var fileName = input.files[0].name;

            // Display the file name in a paragraph element
            var fileNameElement = document.getElementById('chat-message-input');
            fileNameElement.placeholder = fileName;
        }
    </script>

@endsection
