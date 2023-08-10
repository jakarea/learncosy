@extends('layouts.latest.students')
@section('title') Course Certificate @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== course activity list page @S ==== --}}
<main class="course-activity-list-page">
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
                <div class="package-list-header" style="grid-template-columns: 100%">
                    <h5>Certificate</h5>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap activity-table">
                    <table>
                        <tr> 
                            <th>Course Title</th>
                            <th>Duration</th> 
                            <th>Quiz</th>
                            <th>Total Point</th>
                            <th>Your Point</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Progress</th>
                        </tr>  
                        <tr> 
                            <td>
                                <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body"> 
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                                
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                        <tr> 
                            <td>
                               <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                        <tr> 
                            <td>
                               <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                        <tr> 
                            <td>
                               <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                        <tr> 
                            <td>
                               <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                        <tr> 
                            <td>
                               <div class="media">
                                    <img src="{{ asset('latest/assets/images/small-logo.png') }}" alt="a" class="img-fluid">
                                    <div class="media-body">
                                        <h5>Figma Course Part 1</h5>
                                        <h6>UI/UX Design</h6>
                                    </div>
                                </div>
                            </td>  
                            <td>
                                <p>6h</p>
                            </td>  
                            <td>
                                <p>1</p>
                            </td>  
                            <td>
                                <p>1000</p>
                            </td>  
                            <td>
                                <p>600</p>
                            </td>  
                            <td>
                                <p>Complete</p>
                            </td>  
                            <td>
                                <img src="{{asset('latest/assets/images/stack.svg')}}" alt="a" class="img-fluid">
                            </td>  
                            <td>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/download-2.svg')}}" alt="a" class="img-fluid">
                                </a>
                                <a href="#">
                                    <img src="{{asset('latest/assets/images/icons/eye.svg')}}" alt="a" class="img-fluid">
                                </a>
                            </td>   
                        </tr> 
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- pagginate --}}
            <div class="paggination-wrap mt-4">
                {{-- {{ $courseActivities->links('pagination::bootstrap-5') }} --}}
            </div>
            {{-- pagginate --}}
        </div>
    </div>
</main>
{{-- ==== course activity list page @E ==== --}}
@endsection
{{-- page content @E --}}