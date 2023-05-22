@extends('layouts/instructor')
@section('title') Module List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Module list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Module filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Module List</h5>
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
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>
 
                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('instructor/modules/create') }}" class="btn me-3"><i class="fas fa-pen text-white me-2"></i> Create Module</a> 
                </div>

            </div>
        </form>

    </div>
    {{-- Module filter area @E --}}

    {{-- Module listing @S --}}
    <div class="row">
        <div class="col-12">
            <div class="productss-list-box">
                @if(count($modules) > 0)
                <table>
                    <tr>
                        <th width="5%">
                            No
                        </th>
                        <th>
                            Title
                        </th> 
                        <th>
                            Number of files
                        </th>
                        <th>
                            Total Duration
                        </th>
                        <th>
                            Total videos
                        </th> 
                        <th>
                            Action 
                        </th>

                    </tr>
                    {{-- Module item @S --}}
                    @foreach($modules as $key => $module)
                    @php 
                        $text = $module->title;
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
                            {{ $text }}
                        </td>
                        <td>
                            {{ $module->number_of_attachment }}
                        </td>
                        <td>
                            {{ $module->duration }}
                        </td>
                        <td>
                            {{ $module->number_of_video }} 
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
                                            <a class="dropdown-item" href="{{ url('instructor/modules/'.$module->slug.'/edit') }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="post" class="d-inline btn btn-danger" action="{{ url('instructor/modules/'.$module->slug.'/destroy') }}">
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
                    {{-- Module item @E --}}
                </table>
                @else 
                <p class="p-4 text-center">No Module Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Module listing @E --}}

    {{-- Module pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{ $modules->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- Module pagginate @E --}}
</main>
{{-- ==== Module list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}