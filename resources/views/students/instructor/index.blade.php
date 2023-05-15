@extends('layouts/instructor')
@section('title') Student List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Student list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Student filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Student List</h5>
        <form action="" method="GET">
            <div class="product-filter-box">
                <div class="form-grp">
                    <label for="">Categories</label>
                    <select name="categories" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>

                <div class="form-grp">
                    <label for="">Price</label>

                    <select name="price" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="form-grp">
                    <label for="">Sell</label>
                    <select name="sell" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="form-grp">
                    <label for="">Students</label>
                    <input type="text" placeholder="Name" class="form-control" style="height: 2.8rem">
                </div>
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>

                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('course/create') }}" class="btn me-3"><i
                            class="fas fa-pen text-white me-2"></i>Create Course</a>
                </div>

            </div>
        </form>

    </div>
    {{-- Student filter area @E --}}

    {{-- Student listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box">

                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Avatar
                        </th>
                        <th>
                            Student Name
                        </th>
                        <th>
                            Course
                        </th> 
                        <th>
                            Progress
                        </th>
                        <th>
                            Status
                        </th>
                        <th width="22%">
                            Action
                        </th>

                    </tr>
                    {{-- Student person @S --}}

                    <tr>
                        <td>
                            01
                        </td>
                        <td>
                            <div class="table-avatar"> 
                                <span>A</span>  
                            </div>
                        </td>
                        <td>Akram Hossain</td>
                        <td>React Redux</td>
                        <td>60%</td> 
                        <td><span class="badge text-bg-success">Active</span></td>
                        <td>
                            <div class="action-dropdown">
                                <div class="dropdown">
                                    <a class="btn btn-drp" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="bttns-wrap">
                                            <a class="dropdown-item" href="{{url('instructors/profile/nayan-akram')}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-trash"></i>
                                            </a> 
                                            <a class="dropdown-item txt-item" href="{{url('review')}}">
                                                <span>Review</span>
                                            </a>     
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </td> 
                    </tr>
                    {{-- Student person @E --}}
                </table>

                <p class="p-4 text-center">No Student Found!</p>

            </div>
        </div>
    </div>
    {{-- Student listing @E --}}

    {{-- Student pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{-- Student Paggination Link here --}}
            </div>
        </div>
    </div>
    {{-- Student pagginate @E --}}
</main>
{{-- ==== Student list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}