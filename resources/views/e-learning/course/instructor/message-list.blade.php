@extends('layouts.latest.instructor')
@section('title')
Messsages Page - a
@endsection

{{-- page style @S --}}
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
{{-- <link href="{{ asset('latest/assets/admin-css/message.css') }}" rel="stylesheet" type="text/css"> --}}
<link href="{{ asset('latest/assets/admin-css/test.css') }}" rel="stylesheet" type="text/css">
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
                            <h1>Messages <span>{{ count($users) + count($groups) }}</span></h1>

                            {{-- create group box start --}}
                            @if( $adminInfo->user_role !== 'student')
                                <a class="btn btn-primary create-toggle" data-bs-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <img src="{{ asset('latest/assets/images/icons/m-user.svg') }}" alt="ic"
                                        class="img-fluid"> Create Group
                                </a>
                            @endif
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div class="create-group-form">
                                <h4>Create Group</h4>

                                @include('e-learning.course.instructor.group-admin.admin-info')

                                <form method="post" class="createGroup" action="{{ route('messages.group') }}">
                                    <div class="form-group">
                                        <label for="">Group Name</label>
                                        <input type="text" placeholder="Group Name" class="form-control" name="name"
                                            value="{{ old('name') }}">
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
                                    <div class="form-submit form-group-submit">
                                        <button type="reset" class="btn btn-cancel" id="btn-cancel-group">Cancel</button>
                                        <button type="submit" class="btn btn-create" id="btn-create-group">Create</button>
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
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <div class="person-tab-body">
                            {{-- single person start --}}
                            <div class="chat-user-load" id="chat-user-load">
                                @include('e-learning.course.instructor.message-group.group-list')
                                @include('e-learning.course.instructor.chat-user.search-users')
                            </div>
                            {{-- single person end --}}
                        </div>
                        {{-- leftbar person list end --}}
                    </div>
                    {{-- leftbar side end --}}

                    {{-- chat body right side start --}}
                    <div class="chat-main-body-box">
                        {{-- chat body list start --}}
                        <div class="main-chat-room">
                            <div id="chat-message" class="main-chat-inner-room">
                                <div class="blank-chat-page">
                                    <i class="fa-regular fa-circle-user"></i>
                                    <h3>Select a person or group to start a chat</h3>
                                </div>
                            </div>

                            {{-- typing status --}}
                            <div class="typing-status-area" id="indicator-append"></div>

                        </div>

                        <form method="POST" class="send-actions w-100 d-none" id="chatMessage" autocomplete="off">
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

                        <form method="POST" class="send-actions w-100 d-none" id="groupChatMessage" autocomplete="off">
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

                    </div>
                    {{-- chat body right side end --}}
                </div>
            </div>
        </div>
    </div>
</main>
{{-- ==== message list page @E ==== --}}

{{-- add specific person to group modal start --}}
<div class="custom-modal-box">
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModal4Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="create-group-form">
                    <h4>Create Group</h4>
                    @include('e-learning.course.instructor.group-admin.admin-info')
                    <form method="post" class="createGroupModal" action="{{ route('messages.group') }}">
                        <div class="form-group">
                            <label for="">Group Name</label>
                            <input type="text" placeholder="Group Name" class="form-control" name="name"
                                value="{{ old('name') }}">
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
                        <div class="person-box-list person-tab-body load-chat-user-for-group"
                            id="load-chat-user-for-group"></div>
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


@endsection
{{-- page content @E --}}

@section('script')
<script>
// Search single chat user

$(document).on("input",".search-group-chat-user", function (e) {
    searchUser($.trim(this.value), ".load-chat-user-for-group", "layout1");
});

// Search people for specific group on modal
$(document).on("input", ".search-people-specific-group", function (e) {
    searchUser($.trim(this.value), ".fetch-people-for-specificgroup", "layout1");
});


// Search group chat user
$(document).on("input",".search-chat-user", function (e) {
    searchUser($.trim(this.value), ".chat-user-load", "layout2");
});



$(document).ready(function () {
    $(".create-group-by-user").on("click", function (e) {
        var userId = $(this).closest('.single-person').attr('id').split('_')[1];
        loadSuggestedPeople(userId, '.load-suggested-people', '.addUserId');
    });
});



// Search User
function searchUser(searchTerm, resultContainer, layout) {

    searchTerm = $.trim(searchTerm);
    if (searchTerm !== "") {
        $.ajax({
            url: "{{ route('messages.search') }}",
            type: 'GET',
            data: {
                term: searchTerm,
                layout: layout
            },
            success: function (data) {
                $(resultContainer).html(data);
            }
        });
    } else {
        $(".load-chat-user-for-group").empty();
    }
}

// Load suggested user
var existsUsers = [];
$(document).on('click', '.suggest-people', function () {
    var userId = $(this).attr('id');
    loadSuggestedPeople(userId, '.load-suggested-people', '.addUserId');
});


function loadSuggestedPeople(userId, container, input) {
    $.ajax({
        type: "get",
        url: "{{ route('messages.suggested.people') }}",
        data: { userId: userId },
        success: function (data) {
            console.log( data )
            if ($.inArray(userId, existsUsers) === -1) {
                existsUsers.push(userId);
                $(container).append(data);
                $(input).val(function (_, currentValues) {
                    return currentValues ? currentValues + ',' + userId : userId;
                });
            } else {
                toastr.error('User already exists!!', 'Error');
            }
        }
    });
}

// Remove suggested people
$(document).on('click', '.remove-suggested-people', function () {
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
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('deleteChatMsg')) {
        event.stopPropagation();
        var userId = event.target.getAttribute('data-chat-user-id');

        $.ajax({
            type: 'get',
            url: "{{ route('messages.delete.singlechat') }}",
            data: {
                userId: userId
            },
            success: function (data) {
                toastr.success(data.success, 'Success');
                $('#single-chat-message-wrap').empty();
                $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
});


// Delete group chat history
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('deleteGroupChatMsg')) {
        event.stopPropagation();
        var groupId = event.target.getAttribute('data-group-id');

        $.ajax({
            type: 'get',
            url: "{{ route('messages.delete.groupchat') }}",
            data: { groupId: groupId },
            success: function (data) {
                $('#group-chat-message-wrap').empty();
                $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                toastr.success(data.success, 'Success');
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
});


// Add People to Groupe
$(document).on('submit', '#addPeopleToGroup', function () {
    event.preventDefault();
    var formData = new FormData($('#addPeopleToGroup')[0]);
    var groupId = formData.get('groupId');
    $.ajax({
        type: "post",
        url: "{{ route('messages.group.add.people') }}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('#addPeopleToGroup')[0].reset();
            $('#exampleModal').modal('hide');
            $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
            $(".load-suggested-people").empty();
        },
        error: function (jqXHR, status, err) {
            // Handle error if needed
        }
    });
});


// Update group
$(document).on('submit', '#updateGroup', function () {
    event.preventDefault();
    var formData = new FormData($('#updateGroup')[0]);
    var groupId = formData.get('groupId');
    $.ajax({
        type: "post",
        url: "{{ route('messages.update.group') }}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('#updateGroup')[0].reset();
            $('#exampleModal2').modal('hide');
            $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
            fetchGroupData(groupId)
        },
        error: function (jqXHR, status, err) {
            // Handle error if needed
        }
    });
});

// Delete group
$(document).on('submit', '#deleteGroup', function () {
    event.preventDefault();
    var formData = new FormData($('#deleteGroup')[0]);
    var groupId = formData.get('groupId');
    $.ajax({
        type: "post",
        url: "{{ route('messages.delete.group') }}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $('#group-chat-message-wrap').empty();
            $('#exampleModal3').modal('hide');
            $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
            $("#chat-message").load(location.href + " #chat-message>*", "");



            toastr.success(data.success, 'Success');
        },
        error: function (jqXHR, status, err) {
            // Handle error if needed
        }
    });
});


$(document).on('click', '.user', function () {

    $('.user').removeClass('active');
    $('.group').removeClass('active');
    $(this).addClass('active');
    $(this).find('.pending').remove();

    var user_receive_id = $(this).attr('id');
    receiver_id = user_receive_id.split('_')[1];
    $.ajax({
        type: "get",
        url: "{{ route('messages.chat') }}",
        data: {
            receiver_id: receiver_id
        },
        cache: false,
        success: function (data) {
            $('#chat-message').html(data);
            // $('#chat-message-input').emojioneArea();
            scrollToBottomFunc();

        },
        complete: function () {
            $("#groupChatMessage").addClass("d-none");
            $("#chatMessage").removeClass("d-none").fadeIn("slow");
        }
    });
});

// Show group message
$(document).on('click', '.group', function () {
    $('.group').removeClass('active');
    $('.user').removeClass('active');
    $(this).addClass('active');
    $(this).find('.pending').remove();

    var group_id = $(this).attr('id');
    receiver_id = group_id.split('_')[1];
    fetchGroupData(receiver_id);
});

function fetchGroupData(receiver_id){
    $.ajax({
        type: "get",
        url: "{{ route('messages.group.chat') }}",
        data: {
            receiver_id: receiver_id
        },
        cache: false,
        success: function (data) {
            $('#chat-message').html(data);
            // $('#chat-message-input').emojioneArea();
            scrollToBottomFunc();
        },
        complete: function () {
            $("#chatMessage").addClass("d-none");
            $("#groupChatMessage").removeClass("d-none").fadeIn("slow");
        }
    });
}

</script>

<script>
var receiver_id = '';
var my_id = "{{ Auth::id() }}";

$(document).ready(function () {
    // ajax setup form csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // Set pusher key
    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
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



    // Typing indicator

    const indicatorAppendElement = document.getElementById('indicator-append');

    const startTyping = (user) => {

        console.log(user.id, receiver_id )

        if(user.id == receiver_id){
            const newUserMessageItem = document.createElement('div');
            newUserMessageItem.classList.add('message-item-wrap');

            const assetUrl = "{{ asset('') }}";
            const avatarUrl = user.avatar ? `${assetUrl}/${user.avatar}` : '';
            const avatarContent = user.avatar ? `<img src="${avatarUrl}" alt="${user.name} Avatar" class="img-fluid">` : `<span class="user-name-avatar">${user.name[0].toUpperCase()}</span>`;

            newUserMessageItem.innerHTML = `
                <div class="message-item">
                    <div class="media main-media">
                        <div class="avatar">
                            ${avatarContent}
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="media-body">
                            <div class="d-flex">
                                <h6>${user.name}</h6>
                            </div>
                            <div class="typing">
                                <i class="fa-solid fa-ellipsis fa-fade"></i>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Append the new message item to the designated container
            indicatorAppendElement.innerHTML = newUserMessageItem.outerHTML;
        }

    };

    const stopTyping = (user) => {
        const assetUrl = "{{ asset('') }}";
        const avatarUrl = user.avatar ? `${assetUrl}/${user.avatar}` : '';
        const existingUserMessageItem = indicatorAppendElement.querySelector(`.avatar img[src="${avatarUrl}/${user.avatar}"], .avatar span.user-name-avatar`);
        if (existingUserMessageItem) {
            existingUserMessageItem.parentNode.parentNode.parentNode.remove();
        }
    };

    const indicator = pusher.subscribe('typing-channel');

    indicator.bind('typing-started', (data) => {
        startTyping(data.user_info);
    });

    indicator.bind('typing-stopped', (data) => {
        stopTyping(data.user_info);
    });

    // Trigger start and stop typing event


    const routeStart = "{{ route('messages.typing.start') }}";
    const routeStop = "{{ route('messages.typing.stop') }}";

    $(document).on("input","#chat-message-input", () => sendTypingEvent('start'));
    $(document).on("blur","#chat-message-input", () => sendTypingEvent('stop'));

    const sendTypingEvent = (action) => {

        const route = action === 'start' ? routeStart : routeStop;
        $.ajax({
            method: 'POST',
            url: route,
            data: { receiver_id: receiver_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: (response) => {
                // Handle success if needed
            },
            error: (error) => {
                // Handle error if needed
            },
        });
    };

    // Close typing indicator


    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        if (my_id == data.from) {
            $('#user_' + data.to).click();
        } else if (my_id == data.to) {
            if (receiver_id == data.from) {

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


    var channelGroup = pusher.subscribe(my_id);
    channelGroup.bind('App\\Events\\Notify', function (data) {
        console.log( JSON.stringify(data) )
        if (my_id == data.from) {
            $('#group_' + data.to).click();
        } else if (my_id == data.to) {
            receiver_id = data.from;
            if (receiver_id == data.from) {
                $('#group_' + data.from).click();
            } else {
                var pending = parseInt($('#group_' + data.from).find('.pending').html());
                if (pending) {
                    $('#group_' + data.from).find('.pending').html(pending + 1);
                } else {
                    $('#group_' + data.from).append('<span class="pending">1</span>');
                }
            }
        }
    });

});


// Send one to one chate
$(document).on('submit', '#chatMessage', function (e) {
    e.preventDefault();
    sendMessage();
});

// Send group message
$(document).on('submit', '#groupChatMessage', function (e) {
    e.preventDefault();
    sendGroupMessage();
});


// $(".chat-message-input .emojionearea-editor").on('keypress', function (event) {
//     alert("hi")
//     if (event.which === 13) {
//         event.preventDefault();
//         sendMessage();
//     }
// });


$(document).on('submit', '.createGroup', function (e) {
    e.preventDefault();
    createGroup(".createGroup");
});

$(document).on('submit', '.createGroupModal', function (e) {
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
            url: "{{ route('messages.chat') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                // $('.chat-message-input').val('');
                // $('.chat-message-input').emojioneArea().val('');
                $('#chatMessage')[0].reset();
                $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                scrollToBottomFunc();

            },
            error: function (jqXHR, status, err) {
                // Handle error if needed
            }
        });
    }
}

function sendGroupMessage() {
    // var messageText = $('.chat-message-input').emojioneArea().getText();
    var formData = new FormData($('#groupChatMessage')[0]);
    formData.append("receiver_id", receiver_id);
    var messageText = $('.chat-message-input').val();
    if (receiver_id !== '') {
        $.ajax({
            type: "post",
            url: "{{ route('messages.group.chat') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                // $('.chat-message-input').val('');
                // $('.chat-message-input').emojioneArea().val('');
                $('#groupChatMessage')[0].reset();
                $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
                scrollToBottomFunc();
            },
            error: function (jqXHR, status, err) {
                // Handle error if needed
            }
        });
    }
}

// Create Group
function createGroup(formSelector) {
    var formData = new FormData($(formSelector)[0]);
    $.ajax({
        type: "post",
        url: "{{ route('messages.group') }}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            toastr.success(data.success, 'Success');
            if (data.success) {
                $(formSelector)[0].reset();
            }
            $(".load-suggested-people").empty();
            $(".load-chat-user-for-group-user").empty();
            $("#chat-user-load").load(location.href + " #chat-user-load>*", "");
        },
        error: function (jqXHR, status, err) {
            toastr.error('Something went wrong!', 'Error');
        },
        complete: function () {
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

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>

{{-- toggle of group create form shwo hide --}}
<script>
    const toggleBttn = document.querySelector('.create-toggle');
    const headerFilter = document.querySelector('.header-filter');
    const userList = document.querySelector('.person-tab-body.chat-user-load');

    toggleBttn.addEventListener('click', function (e) {
        userList.classList.toggle('active');
        headerFilter.classList.toggle('active');
    });


    const collapseExamples = document.querySelector('#collapseExample');
    const groupCancelBttn = document.querySelector('#btn-cancel-group');
    const groupCreateBttn = document.querySelector('#btn-create-group');

    function groupShowHide(){
        userList.classList.remove('active');
        headerFilter.classList.remove('active');
        collapseExamples.classList.remove('show');
    }

    groupCancelBttn.addEventListener('click', function (e) {
        groupShowHide();
    });

    groupCreateBttn.addEventListener('click', function (e) {
        setTimeout(function () {
            groupShowHide();
        }, 1000);
    });

</script>

{{--close profile box--}}
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

{{-- show upload image preview --}}
<script>
    function displayFileName() {
        var input = document.getElementById('attached');
        var fileName = input.files[0].name;

        var fileNameElement = document.getElementById('chat-message-input');
        fileNameElement.placeholder = fileName;

        var filePreview = document.getElementById('file-preview');
        filePreview.style.display = 'flex';

        document.getElementById('close-icon').style.display = 'inline-block';

        var fileTypeIcon = document.getElementById('file-type-icon');
        if (fileName.endsWith('.pdf')) {
            fileTypeIcon.innerHTML = '<img src="pdf-icon.png" alt="PDF">';
        } else {
            var previewImage = document.getElementById('preview-image');
            previewImage.src = URL.createObjectURL(input.files[0]);
        }
    }

function removeFile() {
    var input = document.getElementById('attached');
    input.value = '';
    var filePreview = document.getElementById('file-preview');
    filePreview.style.display = 'none';

    var fileNameElement = document.getElementById('chat-message-input');
    fileNameElement.placeholder = 'Send a message';

    document.getElementById('close-icon').style.display = 'none';
}

</script>

@endsection
