@extends('layouts/instructor')
@section('title') Bundle Course Show Page @endsection

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

    {{-- Bundle course listing @S --}}
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9 col-sm-11">
            <div class="productss-list-box mt-5"> 
                @if($bundleCourse)
                <table>
                    <tr> 
                        <th>
                            Name
                        </th>
                        <th>
                            :
                        </th>
                        <th>
                            {{$bundleCourse->title}}
                        </th>  
                    </tr>
                    <tr>
                        <th>
                            Thumbnail
                        </th> 
                        <th>
                            :
                        </th>
                        <th>
                            <img src="{{asset('assets/images/bundle-courses/'. $bundleCourse->thumbnail)}}" alt="{{ $bundleCourse->thumbnail }}" class="img-fluid" width="120">
                        </th>  
                    </tr>
                    <tr>
                        <th>
                            Price
                        </th>  
                        <th>
                            :
                        </th>
                        <th>
                            {{$bundleCourse->price}}
                        </th>  
                    </tr>
                    <tr> 
                        <th>
                            Number of sells
                        </th>
                        <th>
                            :
                        </th>
                        <th>
                            1234
                        </th>  
                    </tr> 
                </table>
                @else 
                <p class="p-4 text-center">No Bundle Course Found!</p>
                @endif
            </div>
        </div>
    </div>
    {{-- Bundle course listing @E --}}
</main>
{{-- ==== Bundle course list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}