@extends('layouts/instructor')
@section('title') Lesson List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Lesson list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Lesson filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Lesson List</h5>
        <form action="" method="GET">
            <div class="product-filter-box">  
                <div class="form-grp">
                    <label for="">Title</label>
                    <select name="categories" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
 
                <div class="form-grp">
                    <label for="">Keyword</label>
                    <select name="sell" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div> 
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>
 
                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructor/lessons/create') }}" class="btn me-3"><i class="fas fa-pen text-white me-2"></i> Create Lesson</a> 
                </div>

            </div>
        </form>

    </div>
    {{-- Lesson filter area @E --}}

    {{-- Lesson listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box">
                @if(count($lessons) > 0)
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Thumbnail
                        </th>
                        <th>
                            Title
                        </th> 
                        <th>
                            URL
                        </th>
                        <th>
                            Keyword
                        </th>  
                        <th>
                            Action 
                        </th>

                    </tr>
                    {{-- lesson item @S --}}
                    @foreach($lessons as $key => $lesson) 
                    @php 
                        $text = $lesson->title;
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
                        <td>
                            <img src="{{asset('assets/images/lessons/'. $lesson->thumbnail)}}" alt="{{ $lesson->thumbnail }}" class="img-fluid" width="60">
                        </td>
                        <td>{{ $text }}</td> 
                        <td>{{$lesson->video_link}}</td> 
                        <td>
                            @if($lesson->meta_keyword)
                                @php $mkeywords = explode(",",$lesson->meta_keyword)  @endphp
                                @foreach($mkeywords as $key => $keyword)
                                <span class="badge text-bg-primary">{{$keyword}}</span>
                                @endforeach 
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
                                            <a class="dropdown-item" href="{{url('instructor/lessons/'.$lesson->slug.'/edit')}}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="post" class="d-inline btn btn-danger" action="{{ url('instructor/lessons/'.$lesson->slug.'/destroy') }}">
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
                    {{-- Lesson item @E --}}
                </table>
                @else 
                <p class="p-4 text-center">No Lesson Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Lesson listing @E --}}

    {{-- Lesson pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{ $lessons->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- Lesson pagginate @E --}}
</main>
{{-- ==== Lesson list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}