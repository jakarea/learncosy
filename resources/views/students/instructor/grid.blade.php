@extends('layouts/instructor')
@section('title') Students List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/user-grid.css') }}" rel="stylesheet" type="text/css">

<style>
    .user-grid-box .header-action ul li .btn:hover i{
        color: #fff!important
    }
    .user-grid-box .header-action ul li .btn:hover,
    .user-grid-box .header-action ul li a:hover,
    .user-grid-box .ftr a{
        background: {{ modulesetting('secondary_color') }}
    }
    .user-grid-box .ftr a:hover,
    .user-grid-box .avatar span{
        background: {{ modulesetting('primary_color') }}
    }
</style>

@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Students list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    <div class="product-filter-wrapper mt-0"> 
        <div class="product-filter-box mt-0">
            <h5>Students List</h5> 
            <div class="form-grp-btn mt-4 ms-auto">
                <a href="{{ url('instructor/students/create') }}" class="btn me-3"><i
                        class="fas fa-user-plus text-white me-2"></i>Add Student</a>
            </div> 
        </div> 
    </div>

    {{-- user grid view @s --}}
    <div class="row"> 
        @foreach ($users as $user) 
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <div class="user-grid-box">
                <div class="header-action">
                    <ul>
                        <li><a href="{{ url('instructor/students/'.$user->id.'/edit') }}"><i class="fas fa-pen"></i></a></li>
                        <li>
                            <form method="post" class="d-inline" action="{{ url('instructor/students/'.$user->id.'/destroy') }}">
                                @csrf 
                                @method("DELETE")
                                <button type="submit" class="btn p-0"><i class="fas fa-trash text-danger"></i></button>
                            </form> 
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
    {{-- user grid view @e --}}

</main>
{{-- ==== Students list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}