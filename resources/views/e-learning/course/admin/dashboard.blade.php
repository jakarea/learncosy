@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading-title">Welcome to Dashboard</h1>
            </div>
            <div class="col-md-4">
                <div class="card my-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h6>Total Instructors</h6>
                                <h4>{{$instructors}}</h4>
                            </div>
                            <i class="fas fa-user-group"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card my-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h6>Total Courses</h6>
                                <h4>{{$courses}}</h4>
                            </div>
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card my-card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h6>Total Students</h6>
                                <h4>{{$students}}</h4>
                            </div>
                            <i class="fas fa-users"></i>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection