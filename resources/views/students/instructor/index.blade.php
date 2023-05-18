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
                    <a href="{{ url('instructor/students/create') }}" class="btn me-3"><i
                            class="fas fa-pen text-white me-2"></i>Add Student</a>
                </div>

            </div>
        </form>

    </div>
    {{-- Student filter area @E --}}

    {{-- Student listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box">
                @if(count($students) > 0)
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Avatar
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th> 
                        <th>
                            Phone
                        </th>
                        <th>
                            Message
                        </th>
                        <th width="22%">
                            Action
                        </th>

                    </tr>
                    {{-- Student person @S --}}
                    @foreach($students as $key => $student) 
                    @php 
                        $text = $student->name;
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
                            <div class="table-avatar"> 
                                @if($student->avatar)
                                    <img src="{{asset('assets/images/user/'. $student->avatar)}}" alt="{{ $student->name }}" class="img-fluid" width="60">
                                @else
                                    <span>{!! strtoupper($student->name[0]) !!}</span>  
                                @endif 
                            </div>
                        </td>
                        <td>
                            {{ $text }}
                        </td>
                        <td>
                            {{ $student->email }}
                        </td>
                        <td>
                            {{ $student->phone ? $student->phone : '--' }}
                        </td> 
                        <td>
                            @if($student->recivingMessage == 1)
                            <span class="badge text-bg-success"> Enabled </span>
                            @else
                            <span class="badge text-bg-danger"> Disabled </span>
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
                                            <a class="dropdown-item" href="{{url('instructor/students/profile/'.$student->id)}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="dropdown-item" href="{{url('instructor/students/'.$student->id.'/edit')}}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="post" class="d-inline btn btn-danger" action="{{ url('instructor/students/'.$student->id.'/destroy') }}">
                                                @csrf 
                                                @method("DELETE")
                                                <button type="submit" class="btn p-0"><i class="fas fa-trash text-white"></i></button>
                                            </form> 
                                            <a class="dropdown-item txt-item" href="{{url('review')}}">
                                                <span>Review</span>
                                            </a>     
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </td> 
                    </tr>
                    @endforeach
                    {{-- Student person @E --}}
                </table>
                @else 
                <p class="p-4 text-center">No Student Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Student listing @E --}}

    {{-- Student pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{ $students->links('pagination::bootstrap-5') }}
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