@extends('layouts.latest.students')
@section('title') Messsages List @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/message.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== message list page @S ==== --}}
<main class="message-list-page-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="messages-box"> 
                    <div class="chat-person-list-box">
                        <div class="title">
                            <h1>Messages <span>({{ count($highLightMessages) }})</span></h1>  
                            {{ Auth::user()->email }}
                        </div>
                        <div class="search">

                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search" class="form-control">
                        </div> 
                        
                        <div class="person-tab-body">  
                            @foreach ($highLightMessages as $message)
                            
                            <a href="{{ route('message') }}?sender={{ $message[0]->user->id}}">
                                <div class="media">
                                    <div class="avatar">
                                        <img src="{{asset('assets/images/instructor/'.$message[0]->user->avatar)}}" alt="Avatar" class="img-fluid">
                                        <i class="fas fa-circle"></i>
                                    </div> 
                                   
                                    <div class="media-body">
                                        <div class="name">
                                            <h5>{{$message[0]->user->name}}</h5>
                                            <span>{{$message[count($message) - 1]->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p>{{$message[0]->message}}.</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach 
                        </div> 
                    </div>
                    <!-- person list @e -->
                    <!-- chat-main-body box @s -->
                    <div class="chat-main-body-box">
                        <div class="chat-room-head">
                            <!-- chat person -->
                            <div class="media">
                                @if ($senderInfo) 
                                <img src="{{asset('assets/images/instructor/'.$senderInfo->avatar)}}" alt="Avatar" class="img-fluid">
                                @else 
                                <img src="{{asset('dashboard-assets/images/avatar.png')}}" alt="Avatar" class="img-fluid">
                                @endif
                                
                                <div class="media-body">
                                    <h5>{{$senderInfo? $senderInfo->name : '' }}</h5>
                                    <p>@ {{$senderInfo? $senderInfo->username : '' }}</p>
                                </div>
                                <a href="#" class="common-bttn">View Profile</a>
                            </div>
                            <!-- chat person --> 
                        </div>
                        <!-- main chart room @s -->
                        <div class="main-chat-room"> 
                            <div class="chat-messages-box"> 
                                @foreach ($messages as $message)
                                <div class="{{ $message->user_id == Auth::user()->id ? 'sender' : 'reciver'}} message-item">
                                    <p>{{$message->message}}</p>
                                    <span>{{$message->created_at->diffForHumans()}}</span>
                                </div>
                                <br>
                                @endforeach
                            </div> 
                        </div>
                        <!-- main chart room @e -->

                        <!-- message send box @s -->
                        <form id="send" method="POST"
                            action="{{ route('message-send',['sender' => isset($senderInfo)?$senderInfo->id :'']) }}">
                            @csrf

                            <div class="message-send-box">
                                <div class="form-group">  
                                    <input type="text" class="form-control"  placeholder="Send a message"  name="message">
                                </div>
                                <div class="file-attach-bttns">
                                    <button type="submit" style="display: none;"></button>
                                    <button class="btn btn-prm">
                                        <i class="bi bi-envelope"></i> Send
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- <a href="" onclick="document.getElementById('send').submit();" class="bttn"><i class="fas fa-paper-plane"></i> SEND</a> -->

                        <!-- message send box @e -->
                    </div>
                    <!-- chat-main-body box @e -->
                </div>
            </div>
        </div>
    </div>
</main>
{{-- ==== message list page @E ==== --}}
@endsection
{{-- page content @E --}}