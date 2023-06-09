@extends('layouts/instructor')
@section('title') Review List Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/product-researchs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/review.css') }}" rel="stylesheet" type="text/css">
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== Review list page @S ==== --}}
<main class="product-research-page-wrap">

    {{-- session message @S --}}
    @include('partials/session-message')
    {{-- session message @E --}}

    {{-- Review filter area @S --}}
    <div class="product-filter-wrapper">
        <h5>Review List</h5>
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
                    <label for="">Course</label>

                    <select name="price" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="form-grp">
                    <label for="">Student</label>
                    <select name="sell" class="form-custom">
                        <option value="">All</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="form-grp-btn mt-4 ms-3">
                    <button type="submit" class="btn">Filter</button>
                </div>

                <div class="form-grp-btn mt-4 ms-auto">
                    <a href="{{ url('/') }}" class="btn me-3"><i class="fas fa-list text-white me-2"></i> Dashboard</a>
                </div>

            </div>
        </form>

    </div>
    {{-- Review filter area @E --}}

    {{-- Review Listing @S --}}
    <div class="row">
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
        {{-- item @S --}}
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="review-item-box">
                <h5>Giopio.com</h5> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo in voluptatibus quibusdam sit aliquam dolore modi unde dolores atque fuga? </p> 
                <div class="d-flex">
                    <h6>Jakarea Parvez</h6>
                    <ul>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- item @E --}}
    </div>
    {{-- Review Listing @E --}}

    {{-- Review pagginate @S --}}
    <div class="row">
        <div class="col-12">
            <div class="pagginate-wrap">
                {{-- Review Paggination Link here --}}
            </div>
        </div>
    </div>
    {{-- Review pagginate @E --}}
</main>
{{-- ==== Review list page @E ==== --}}
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}