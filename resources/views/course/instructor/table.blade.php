@extends('layouts/instructor')
@section('title') Course List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== course list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- course filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Course List</h5>
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
                    <a href="{{ url('instructor/courses/create') }}" class="btn me-3"><i
                            class="fas fa-pen text-white me-2"></i>Create Course</a>
                </div>

            </div>
        </form>

    </div>
    {{-- course filter area @E --}}

    {{-- course listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box">
                @if(count($courses) > 0)
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Title
                        </th>
                        <th>
                            Thumbnail
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Total Module
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Status
                        </th>
                        <th width="22%">
                            Action
                        </th>

                    </tr>
                    {{-- course item @S --}}
                    @foreach($courses as $key => $course) 
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
                            <img src="{{asset('assets/images/courses/'. $course->thumbnail)}}" alt="{{ $course->thumbnail }}" class="img-fluid" width="60">
                        </td>
                        <td>
                            @if($course->categories)
                                @php $cateogires = explode(",",$course->categories)  @endphp
                                @foreach($cateogires as $key => $category)
                                <span class="badge text-bg-primary">{{$category}}</span>
                                @endforeach 
                            @endif 
                        </td>
                        <td>{{ $course->number_of_module }}</td>
                        <td>${{ $course->price }}</td>
                        <td>
                            @if($course->status == 'draft')
                            <span class="badge text-bg-info">Draft</span>
                            @elseif($course->status == 'published')
                            <span class="badge text-bg-success">Published</span>
                            @else
                            <span class="badge text-bg-danger">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-dropdown">
                                <div class="dropdown">
                                    <a class="btn btn-drp" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="bttns-wrap">
                                            <a class="dropdown-item" href="{{ url('instructor/courses/'.$course->slug) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="dropdown-item" href="{{ url('instructor/courses/'.$course->slug.'/edit') }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="post" class="d-inline btn btn-danger" action="{{ url('instructor/courses/'.$course->slug.'/destroy') }}">
                                                @csrf 
                                                @method("DELETE")
                                                <button type="submit" class="btn p-0"><i class="fas fa-trash text-white"></i></button>
                                            </form>    
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </td> 
                    </tr>
                    @endforeach
                    {{-- course item @E --}}
                </table>
                @else 
                <p class="p-4 text-center">No Course Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- course listing @E --}}

    {{-- course pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{ $courses->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- course pagginate @E --}}
</main>
{{-- ==== course list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}