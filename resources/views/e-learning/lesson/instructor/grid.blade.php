@extends('layouts.latest.instructor')
@section('title') Lesson List @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== module list page @S ==== --}}
<main class="module-list-page">
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
                <form action="" method="GET" id="myForm">
                    <div class="package-list-header"> 
                        <h5>Lesson List</h5>
                        <div class="form-group">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Lesson" class="form-control" name="title"
                                value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                        </div>
                        <input type="hidden" name="status" id="inputField"> 

                        <div class="filter-dropdown-box">
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="dropdownBttn">
                                    All
                                </button> 
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item filterItem" href="#">All</a></li>
                                    <li><a class="dropdown-item filterItem" href="#" data-value="pending">Pending</a></li>
                                    <li><a class="dropdown-item filterItem" href="#" data-value="published">Published</a></li>
                                </ul>
                            </div>
                            <i class="fas fa-angle-down"></i>
                        </div>

                        <div class="bttn">
                            <a href="{{ url('instructor/lessons/create') }}" class="common-bttn"><i class="fas fa-plus"></i> Add Lesson</a>
                        </div>
                    </div>
                </form> 
            </div> 
        </div>
        <div class="row">
            <div class="col-12">
                @if (count($lessons) > 0)
                <div class="subscription-table-wrap module-list-table">
                    <table>
                        <tr>
                            <th>Title</th> 
                            <th>Short Desc</th> 
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                         @foreach ($lessons as $lesson) 
                        <tr>
                            <td>
                                <h5>{{$lesson->title}}</h5>
                            </td>
                            <td>
                                <p>{{$lesson->short_description}}</p>
                            </td> 
                            <td class="module-status">
                                @if ($lesson->status == 'pending')
                                <span class="badge text-bg-danger">Pending</span> 
                                @elseif ($lesson->status == 'published')
                                    <span class="badge text-bg-primary">Published</span>
                                @endif 
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ url('instructor/lessons/'.$lesson->slug.'/edit') }}" class="me-r"><img src="{{ asset('latest/assets/images/icons/edit.svg') }}" alt="Icon" class="img-fluid"></a>

                                    <form method="post" class="d-inline" action="{{ url('instructor/lessons/'.$lesson->slug.'/destroy') }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item btn text-danger d-inline"><img src="{{ asset('latest/assets/images/icons/trash.svg') }}" alt="Icon" class="img-fluid"> </button>
                                    </form> 
                                </div>
                               
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @else
                <div>
                    @include('partials/no-data');
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{ $lessons->links('pagination::bootstrap-5') }}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== module list page @E ==== --}}
@endsection
{{-- page content @E --}}


@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let inputField = document.getElementById("inputField");
        let dropbtn = document.getElementById("dropdownBttn");
        let form = document.getElementById("myForm");
        let queryString = window.location.search;
        let urlParams = new URLSearchParams(queryString);
        let name = urlParams.get('title');
        let status = urlParams.get('status');
        let dropdownItems = document.querySelectorAll(".filterItem");

        if(status == "pending"){
            dropbtn.innerText = 'Pending';
        }
        if(status == "published"){
            dropbtn.innerText = 'Published';
        }
        inputField.value = status;
    
        dropdownItems.forEach(item => {
            item.addEventListener("click", function(e) {
                e.preventDefault();
                inputField.value = this.getAttribute("data-value");
                dropbtn.innerText = item.innerText;
                form.submit(); 
            });
        });
    });
</script>

@endsection