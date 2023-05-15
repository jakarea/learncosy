@extends('layouts/instructor')
@section('title') Instructors List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Instructors list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Instructors filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Instructors List</h5>
        <form action="" method="GET">
            <div class="product-filter-box">  
                <div class="form-grp">
                    <label for="">Subject</label>
                    <select name="categories" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>  
                <div class="form-grp">
                    <label for="">Name</label>
                    <select name="categories" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>  
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>
 
                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructors/create') }}" class="btn me-3"><i class="fas fa-pen text-white me-2"></i>Add Instructor</a> 
                </div>

            </div>
        </form>

    </div>
    {{-- Instructors filter area @E --}}

    {{-- Instructors listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box"> 
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Name
                        </th> 
                        <th>
                           Subject
                        </th>
                        <th>
                            Short Bio
                        </th> 
                        <th>
                            Status
                        </th>
                        <th>
                            Action 
                        </th>

                    </tr>
                    {{-- Instructor person @S --}}
 
                    <tr>
                        <td>
                            01
                        </td>
                        <td>Jhon Doe</td>
                        <td>All</td>
                        <td>Lorem ipsum dolor sit amet, </td> 
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
                                            <a class="dropdown-item txt-item" href="#">
                                                <span>Test</span>
                                            </a>     
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        </td>
                    </tr> 
                    {{-- Instructor person @E --}}
                </table>
                
                <p class="p-4 text-center">No Instructors Found!</p>
                
            </div>
        </div>
    </div>
    {{-- Instructors listing @E --}}

    {{-- Instructors pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{-- Instructors Paggination Link here --}}
            </div>
        </div>
    </div>
    {{-- Instructors pagginate @E --}}
</main>
{{-- ==== Instructors list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}