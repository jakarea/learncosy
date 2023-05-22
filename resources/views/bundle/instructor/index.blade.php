@extends('layouts/instructor')
@section('title') Bundle Course List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Bundle course list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Bundle course filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Bundle Course List</h5>
        <form action="" method="GET">
            <div class="product-filter-box">  
                <div class="form-grp">
                    <label for="">Name</label>
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
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>
 
                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructor/bundle/courses/create') }}" class="btn me-3"> <i class="fas fa-pen text-white me-2"></i>Create Bundle Course</a> 
                </div>

            </div>
        </form>

    </div>
    {{-- Bundle course filter area @E --}}

    {{-- Bundle course listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box"> 
                @if(count($bundleCourses) > 0)
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Thumbnail
                        </th> 
                        <th>
                            Price
                        </th>
                        <th>
                            Number of sells
                        </th> 
                        <th>
                            Action 
                        </th>

                    </tr>
                    {{-- Bundle course item @S --}}
                    @foreach($bundleCourses as $key => $course) 
                    @php 
                        $text = $course->title;
                        $maxLength = 60;
                        if (strlen($text) > $maxLength) {
                            $lastSpace = strpos($text, ' ', $maxLength);
                            $text = $lastSpace !== false ? substr($text, 0, $lastSpace) . '...' : $text;
                        }
                    @endphp
 
                    <tr>
                        <td>
                            {{ $key +1 }}
                        </td>
                        <td>{{ $text }}</td> 
                        <td>
                            <img src="{{asset('assets/images/bundle-courses/'. $course->thumbnail)}}" alt="{{ $course->thumbnail }}" class="img-fluid" width="60">
                        </td>
                        <td>
                            {{ $course->price }}    
                        </td> 
                        <td>324</td>  
                        <td>
                            <div class="action-dropdown">
                                <div class="dropdown">
                                    <a class="btn btn-drp" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="bttns-wrap">
                                            <a class="dropdown-item" href="{{url('instructor/bundle/courses/'.$course->slug)}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="dropdown-item" href="{{url('instructor/bundle/courses/'.$course->slug.'/edit')}}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="post" class="d-inline btn btn-danger" action="{{ url('instructor/bundle/courses/'.$course->slug.'/destroy') }}">
                                                @csrf 
                                                @method("DELETE")
                                                <button type="submit" class="btn p-0"><i class="fas fa-trash text-white"></i></button>
                                            </form>
                                            <a class="dropdown-item txt-item" href="#">
                                                <span>Test</span>
                                            </a>     
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                        </td>
                    </tr> 
                    @endforeach
                    {{-- Bundle course item @E --}}
                </table>
                @else 
                <p class="p-4 text-center">No Bundle Course Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Bundle course listing @E --}}

    {{-- Bundle course pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{ $bundleCourses->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- Bundle course pagginate @E --}}
</main>
{{-- ==== Bundle course list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}