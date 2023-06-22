@extends('layouts/student')
@section('title') Home Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="d-flex">
    <div class="col-12">
        <div class="row">
            <div class="productss-list-box payment-history-table mt-4 coursse-list-table ps-0">
                <h5 class="p-3 pb-0 my-course">My Courses</h5>
                <table class="my-tabl">
                    <tr>
                        <th width="5%"><i class="fa-solid fa-bars-staggered"></i> No</th>
                        <th><i class="fa-solid fa-book-open"></i> Course Name</th>
                        <th><i class="fa-solid fa-money-bill"></i> Paid</th>
                        <th><i class="fa-solid fa-calendar-day"></i> Start Date</th>
                        <th><i class="fa-solid fa-headset"></i> Support</a></th>
                       

                    </tr>
                    {{-- item @S --}}
                    @php 
                    $i = 0;
                    @endphp
                    @foreach($enrolments as $enrolment)
                    @php 
                    $i++
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td> <a href="{{url('students/courses/'.$enrolment->course->slug )}}">{{ $enrolment->course->title}} </a> </td>
                        <td>{{ $enrolment->amount}}</td>
                        <td>{{ $enrolment->created_at->format('F j, Y')}}</td>
                        <td><a class="contact_bttn" href="{{ url('course/messages/send',$enrolment->course->id)}}" target="_blank" rel="noopener noreferrer"> Contact </td>
                    </tr>
                    @endforeach
                    
                </table>
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="payment-method-info-item">
                            <span class="text-mute">Card Brand</span>
                            <h6 class="text-success">No Payment Method</h6>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}