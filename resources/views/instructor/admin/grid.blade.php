@extends('layouts.latest.admin')
@section('title') Instructor List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time()) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== user list page @S ==== --}}
<main class="user-list-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-title-box">
                    <h1>Total: <span>{{ count($users) }} Instructor</span></h1> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-search-box-wrap">
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search Instructor" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All Instructor</option>
                            <option value="">Active Instructor</option>
                            <option value="">Inactive Instructor</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="user-title-box"> 
                        <a href="{{ url('admin/instructor/create') }}"><img src="{{asset('latest/assets/images/user-plus.svg')}}" alt="User" class="img-fluid"> Add Instructor</a>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            @foreach ($users as $user)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="user-grid-box">
                    <div class="header-action">
                        <div class="dropdown">
                            <button class="btn btn-ellipse" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ url('admin/instructor/'.$user->id.'/edit') }}">Edit</a></li>
                                <li>
                                    <form method="post" class="d-inline"
                                        action="{{ url('admin/instructor/'.$user->id.'/destroy') }}">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <ul>
                            <li>

                            </li>
                        </ul>
                    </div>
                    <div class="avatar">
                        @if ($user->avatar)
                        <img src="{{asset('assets/images/instructor/'.$user->avatar)}}" alt="Avatar" class="img-fluid">
                        @else
                        <span>{!! strtoupper($user->name[0]) !!}</span>
                        @endif

                    </div>
                    <div class="txt">
                        <h4>{{ $user->name }}</h4>
                        <h5>{{ $user->email }}</h5>
                    </div>
                    <div class="ftr">
                        <a href="{{ url('admin/instructor/profile/'.$user->id)}}">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach 
        </div> 
        <div class="row">
           <div class="col-12">
             {{-- pagginate --}}
             <div class="paggination-wrap">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
           </div>
        </div>
    </div>
</main>
{{-- ==== user list page @E ==== --}}
@endsection
{{-- page content @E --}}