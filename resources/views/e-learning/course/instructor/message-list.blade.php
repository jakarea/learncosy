@extends('layouts.latest.students')
@section('title') Messsages List @endsection

{{-- page style @S --}}
@section('style')
    <link href="{{ asset('latest/assets/admin-css/message.css?v=' . time()) }}" rel="stylesheet" type="text/css" />
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
                        <div class="chat-person-list-box">
                            <div class="title">
                                <h1>Messages <span>({{ count($highLightMessages) }})</span></h1>
                            </div>
                            <div class="search">

                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search" class="form-control">
                            </div>

                            <div class="person-tab-body">
                                @if (count($highLightMessages) > 0)
                                    @foreach ($highLightMessages as $message)
                                        <a href="{{ route('message') }}?sender={{ $message[0]->user->id }}">
                                            <div class="media">
                                                <div class="avatar">
                                                    <img src="{{ asset( $message[0]->user->avatar) }}"
                                                        alt="Avatar" class="img-fluid">
                                                    <i class="fas fa-circle"></i>
                                                </div>

                                                <div class="media-body">
                                                    <div class="name">
                                                        <h5>{{ $message[count($message) - 1]->user->name }}</h5>
                                                        <span>{{ $message[count($message) - 1]->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p>{{ $message[count($message) - 1]->message }}.</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div>
                                        @include('partials/no-data')
                                    </div>
                                @endif
                            </div>
                        </div> 
                            <div class="chat-main-body-box">
                                @if (count($messages) > 0)
                                    <div class="chat-room-head"> 
                                        <div class="media">
                                            @if ($senderInfo)
                                                <img src="{{ asset($senderInfo->avatar) }}"
                                                    alt="Avatar" class="img-fluid">
                                            @else
                                                <img src="{{ asset('dashboard-assets/images/avatar.png') }}" alt="Avatar"
                                                    class="img-fluid">
                                            @endif

                                            <div class="media-body">
                                                <h5>{{ $senderInfo ? $senderInfo->name : '' }}</h5>
                                                <p>@ {{ $senderInfo ? $senderInfo->subdomain : '' }}</p>
                                            </div>
                                            <a href="#" class="common-bttn">View Profile</a>
                                        </div> 
                                    </div>

                                    <div class="main-chat-room">
                                        <div class="chat-messages-box">
                                            @foreach ($messages as $message)
                                                <div
                                                    class="{{ $message->user_id == Auth::user()->id ? 'sender' : 'reciver' }} message-item">
                                                    <p>{{ $message->message }}</p>
                                                    <span>{{ $message->created_at->diffForHumans() }}</span>
                                                </div>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>

                                    <form id="send" method="POST"
                                        action="{{ route('message-send', ['sender' => isset($senderInfo) ? $senderInfo->id : '']) }}">
                                        @csrf

                                        <div class="message-send-box">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Send a message"
                                                    name="message">
                                            </div>
                                            <div class="file-attach-bttns">
                                                <button type="submit" style="display: none;"></button>
                                                <button class="btn btn-prm">
                                                    <i class="bi bi-envelope"></i> Send
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div>
                                        @include('partials/no-data')
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        {{-- ==== message list page @E ==== --}}
    @endsection
    {{-- page content @E --}}
