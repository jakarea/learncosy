@extends('layouts/instructor')
@section('title') Payment to Admin Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/settings.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
<main class="profile-page-wrap">
    {{-- user profile header area @S --}}
    <div class="product-filter-wrapper my-0">
        <div class="product-filter-box mt-0 mb-4">
            <div class="password-change-txt">
                <h1 class="mb-1">Payment to Admin</h1>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row"> 
        <div class="col-lg-12">
            <div class="productss-list-box payment-history-table">
                <h5 class="p-3 pb-0">Payment Information :</h5>
                <table>
                    <tr>
                        <th width="5%">No</th>
                        <th>Payment ID</th>
                        <th>Admin Email</th> 
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>jhon@mailcom</td> 
                        <td>
                            <span class="badge text-bg-success">Success</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-eye me-2"></i></a>
                            
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- item @E --}}  
                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>jhon@mailcom</td> 
                        <td>
                            <span class="badge text-bg-success">Success</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-eye me-2"></i></a>
                            
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- item @E --}}  
                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>jhon@mailcom</td> 
                        <td>
                            <span class="badge text-bg-danger">Failed</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-eye me-2"></i></a>
                            
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- item @E --}}  

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
    {{-- profile information @E --}}

</main>
@endsection
{{-- page content @E --}}

{{-- page script @S --}}
@section('script')

@endsection
{{-- page script @E --}}