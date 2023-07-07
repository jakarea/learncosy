@extends('layouts/instructor')
@section('title') Message Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/student.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="message-page-wrap">
    <div class="col-12">
        <div class="main-chat-wrapper">
            <div class="d-flex">
                <h5>Messages to: {{$reciver_info->user->name}}</h5>
                <div class="instructor-avatar">
                    <div class="media">
                        <img src="{{asset('assets/images/avatar.png')}}" alt="a" class="img-fluid">
                        <div class="media-body">
                            <h5>{{$sender_info->name}}</h5>
                            <p>{{$reciver_info->title}}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- chat area @S --}}
            <div class="chat-box-wrap">
                
                <form action="{{route('post.message',$courseId)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                   

                    <div class="form-group form-error">
                        <textarea name="message" placeholder="Write a message" id="" cols="30" rows="4" class="form-control"></textarea> 
                        <span class="invalid-feedback">@error('message'){{ $message }}
                                                @enderror</span>
                    </div>
                    <small style="color: #8C8FAE">You will get replay within 24 hours</small>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                   
                </form>
            </div>
            {{-- chat area @E --}}
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}