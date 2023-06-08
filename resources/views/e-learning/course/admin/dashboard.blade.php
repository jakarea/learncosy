@extends('layouts/instructor')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<style type="text/css">
    .my-card
    {
        position:absolute;
        left:40%;
        top:-20px;
        border-radius:50%;
    }
    </style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="d-flex justify-content-center">
    <div class="jumbotron">
        <div class="row" style="margin-top: 50px">
        
            <div class="col-md-3">
                <div class="card border-info mx-sm-1 p-3">
                    <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-car" aria-hidden="true"></span></div>
                    <div class="text-info text-center mt-3"><h4>Instructors</h4></div>
                    <div class="text-info text-center mt-2"><h1>{{ $instructors }}</h1></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success mx-sm-1 p-3">
                    <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                    <div class="text-success text-center mt-3"><h4>Courses</h4></div>
                    <div class="text-success text-center mt-2"><h1>{{ $courses }}</h1></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger mx-sm-1 p-3">
                    <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                    <div class="text-danger text-center mt-3"><h4>Students</h4></div>
                    <div class="text-danger text-center mt-2"><h1>{{ $students }}</h1></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
