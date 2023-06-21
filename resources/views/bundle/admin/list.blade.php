@extends('layouts/instructor')
@section('title') Bundle Course List Page @endsection

{{-- style section @S --}}
@section('style')
<link href="{{ asset('assets/css/course.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/course-list.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content') 
<main class="course-lists-pages">
    {{-- course list page start --}}
    <div class="create-client-wrap page-height-wrapper">
        <div class="create-client-head table-filter-sort-wrap mb-4">
            <!-- table layout chnage bttn start -->
            <div class="table-layout-bttn ms-3">
                <ul>
                    <li><a href="javascript:void(0)" onclick="elementHide()" class="active">L</a></li>
                    <li><a href="javascript:void(0)" onclick="elementShow()">M</a></li>
                    <li><a href="javascript:void(0)" onclick="elementShowS()">S</a></li>
                </ul>
            </div>
            <!-- table layout chnage bttn end -->


            <!-- course create bttn start -->
            <div class="create-bttn-wraps ms-auto">
                <a href="{{url('admin/bundle/courses/create')}}"><i class="fa-regular fa-square-plus"></i> Create New Bundle Course</a>
            </div>
            <!-- course create bttn end -->

            <!-- course list table header end -->
        </div>
        <div class="row">
            @foreach ($bundleCourses as $course)
            {{-- course single box start --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                <div class="client-single-box-wrap">
                    @if ($course->status == 'pending')
                        <span class="badge text-bg-danger">Pending</span>
                    @elseif ($course->status == 'draft')
                        <span class="badge text-bg-warning">Draft</span>
                    @elseif ($course->status == 'published')
                        <span class="badge text-bg-info">Published</span>
                    @endif 

                    <div class="client-thumb-box">
                        <img src="{{asset('assets/images/bundle-courses/'.$course->thumbnail)}}"
                            alt="Avatar" class="img-fluid">
                        <div class="client-name-box">
                           <a href="{{url('admin/bundle/courses/'.$course->slug)}}"><h4>{{ Str::limit($course->title, $limit = 45, $end = '..') }}</h4></a>
                            <h6>{{ Str::limit($course->short_description, $limit = 55, $end = '...') }}</h6>
                        </div>
                    </div> 
                    <div class="client-txt-box">
                        <hr>
                        <div class="d-flex"> 
                            <a href="{{url('admin/bundle/courses/'.$course->slug)}}">View <i class="fas fa-eye text-primary"></i></a>
                            <a href="{{url('admin/bundle/courses/'.$course->slug.'/edit')}}">Edit <i class="fas fa-pen text-info"></i></a> 

                            <form method="post" class="d-inline" action="{{ url('admin/bundle/courses/'.$course->slug.'/destroy') }}">
                                @csrf 
                                @method("DELETE")
                                <button type="submit" class="btn p-0">Delete <i class="fas fa-trash text-danger"></i></button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            {{-- course single box end --}}
            @endforeach

        </div>
    </div>
    {{-- course list page end --}}

    {{-- paggination start --}}
    <div class="table-paggination">
        <div class="pagination">
            {{ $bundleCourses->links('pagination::bootstrap-5') }}
        </div> 
    </div>
    {{-- paggination end --}}
</main>
@endsection

{{-- script section @S --}}
@section('script')
<!-- client view changes script start -->
<script>
    function elementShow() {
      var elements = [...document.querySelectorAll(".client-single-box-wrap")];

      elements.forEach(items => {
        items.classList.add("single-client-medium-view");
        items.classList.remove("single-client-small-view");
      });
    }

    function elementHide() {
      var elements = [...document.querySelectorAll(".client-single-box-wrap")];

      elements.forEach(items => {
        items.classList.remove("single-client-medium-view","single-client-small-view");
      });
    }

    function elementShowS() {
      var elements = [...document.querySelectorAll(".client-single-box-wrap")];

      elements.forEach(items => {
        items.classList.add("single-client-small-view"); 
      });
    }

</script>

<!-- client view changes script end -->

<!-- view button toggle script start -->
<script>
    let boxs = [...document.querySelectorAll(".table-layout-bttn ul li a")];

  boxs.forEach(box => {
    box.addEventListener("click", function () {
      boxs.forEach(c => c.classList.remove("active"));
      this.classList.add("active")
    })
  });
</script>
<!-- view button toggle script end -->
@endsection
{{-- script section @E --}}