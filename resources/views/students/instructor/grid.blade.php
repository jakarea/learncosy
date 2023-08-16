@extends('layouts.latest.instructor')
@section('title')Students List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Students list page @S ==== --}}
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
                    <h1>Total: <span>{{ count($users) }} Students</span></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="user-search-box-wrap">
                    <div class="form-group">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search Students" class="form-control">
                    </div>
                    <div class="form-filter">
                        <select class="form-control">
                            <option value="">All Students</option>
                            <option value="">Active Students</option>
                            <option value="">Inactive Students</option>
                        </select>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="user-title-box">
                        <a href="{{ url('instructor/students/create') }}"><img
                                src="{{asset('latest/assets/images/user-plus.svg')}}" alt="User" class="img-fluid"> Add
                            Students</a>
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
                                        href="{{ url('instructor/students/'.$user->id.'/edit') }}">Edit</a></li>
                                <li>
                                    <form method="post" class="d-inline"
                                        action="{{ url('instructor/students/'.$user->id.'/destroy') }}">
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
                        <img src="{{asset('assets/images/students/'.$user->avatar)}}" alt="Avatar" class="img-fluid">
                        @else
                        <span>{!! strtoupper($user->name[0]) !!}</span>
                        @endif

                    </div>
                    <div class="txt">
                        <h4>{{ $user->name }}</h4>
                        <h5>{{ $user->email }}</h5>
                    </div>
                    <div class="ftr">
                        <a href="{{ url('instructor/students/profile/'.$user->id)}}">View Details</a>
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
{{-- ==== Students list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}