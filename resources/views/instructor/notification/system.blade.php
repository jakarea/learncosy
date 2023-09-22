@extends('layouts.latest.instructor')

@section('title') All Courses @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="courses-lists-pages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-9">
                <div class="user-title-box">
                    <h1>Notification </h1>
                </div>
            </div> 
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-3">
                <div class="user-search-box-wrap">
                    <div class="form-filter">
                        <!-- <select class="form-control" id="day-wise-notification">
                            <option value="">Please select</option>
                            <option value="1" onclick="return getNotificationDayWise();">Today</option>
                            <option value="7" onclick="return getNotificationDayWise();">Last 7 days</option>
                            <option value="30" onclick="return getNotificationDayWise();">Last 30 days</option>
                            <option value="365" onclick="return getNotificationDayWise();">Last 1 year</option>
                        </select> -->

                        <select class="form-control" id="day-wise-notification">
                          <option value="">Please select</option>
                          <option value="1">Today</option>
                          <option value="7">Last 7 days</option>
                          <option value="30">Last 30 days</option>
                          <option value="365">Last 1 year</option>
                        </select>


                        <i class="fas fa-angle-down"></i>
                    </div>
                </div>
            </div> 
        </div> 
         <div class="row">
            <div class="col-lg-12">
                <hr class="line">
                <div class="notification-box-wrapper">

                    <div class="show-notification-item">
                        <div class="single" data-value="1">
                            {{-- day --}}
                            <h5>Today</h5>
                            {{-- day --}}

                            {{-- notify item start --}}
                            @foreach($todays as $today)
                                <div class="notify-item-box">
                                    <div class="media">
                                        <div class="icon">
                                            <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5>{{$today['type']}}</h5>
                                            <p>{{$today['message']}}</p>
                                        </div>
                                    </div>

                                    <div class="delete-item">
                                        <a href="#"> 
                                            <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            {{-- notify item end --}}
                        </div> 

                        <div class="single" data-value="2">
                            {{-- day --}}
                            <h5 class="mt-5">Yesterday</h5>
                            {{-- day --}}

                            {{-- notify item start --}}
                             @foreach($yestardays as $yestarday)
                            <div class="notify-item-box">
                                <div class="media">
                                    <div class="icon">
                                        <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{$yestarday['type']}}</h5>
                                        <p>{{$yestarday['message']}}</p>
                                    </div>
                                </div>

                                <div class="delete-item">
                                    <a href="#"> 
                                        <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{-- notify item end --}}
                        </div>

                        <div class="single" data-value="7">
                             {{-- day --}}
                            <h5 class="mt-5">Seven Days</h5>
                            {{-- day --}}

                            {{-- notify item start --}}
                             @foreach($sevenDays as $sevenDay)
                            <div class="notify-item-box">
                                <div class="media">
                                    <div class="icon">
                                        <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{$sevenDay['type']}}</h5>
                                        <p>{{$sevenDay['message']}}</p>
                                    </div>
                                </div>

                                <div class="delete-item">
                                    <a href="#"> 
                                        <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{-- notify item end --}}
                        </div>

                        <div class="single" data-value="30">
                             {{-- day --}}
                            <h5 class="mt-5">Thirty Days</h5>
                            {{-- day --}}

                            {{-- notify item start --}}
                             @foreach($thirtyDays as $thirtyDay)
                            <div class="notify-item-box">
                                <div class="media">
                                    <div class="icon">
                                        <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{$thirtyDay['type']}}</h5>
                                        <p>{{$thirtyDay['message']}}</p>
                                    </div>
                                </div>

                                <div class="delete-item">
                                    <a href="#"> 
                                        <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{-- notify item end --}}
                        </div>

                        <div class="single" data-value="365">
                             {{-- day --}}
                            <h5 class="mt-5">Last One Year</h5>
                            {{-- day --}}

                            {{-- notify item start --}}
                             @foreach($lastOneYears as $lastOneYear)
                            <div class="notify-item-box">
                                <div class="media">
                                    <div class="icon">
                                        <img src="{{asset('latest/assets/images/icons/gallery.svg')}}" alt="icon" class="img-fluid">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5>{{$lastOneYear['type']}}</h5>
                                        <p>{{$lastOneYear['message']}}</p>
                                    </div>
                                </div>

                                <div class="delete-item">
                                    <a href="#"> 
                                        <img src="{{asset('latest/assets/images/icons/trash-bin.svg')}}" alt="icon" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            {{-- notify item end --}}
                        </div>

                    </div>

                </div>
            </div>
         </div>
        <div class="row">
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{-- {{ $courses->links('pagination::bootstrap-5') }} --}}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
      var selectBox = document.getElementById("day-wise-notification");
      var contentDivs = document.querySelectorAll(
        ".show-notification-item .single"
      );
      function showDefaultContent() {
        contentDivs.forEach(function (div) {
          div.style.display = "none";
        });
        var todayContent = document.querySelector(
          ".show-notification-item .single[data-value='1']"
        );
        var yestardayDaysContent = document.querySelector(
          ".show-notification-item .single[data-value='2']"
        );

        if (todayContent && yestardayDaysContent) {
          todayContent.style.display = "block";
          yestardayDaysContent.style.display = "block";
        }
      }
      showDefaultContent();
      selectBox.addEventListener("change", function () {
        var selectedValue = selectBox.value;
        contentDivs.forEach(function (div) {
          div.style.display = "none";
        });
        var selectedContentDiv = document.querySelector(
          ".show-notification-item .single[data-value='" + selectedValue + "']"
        );
        if (selectedContentDiv) {
          selectedContentDiv.style.display = "block";
        }
      });
        
</script>
@endsection
