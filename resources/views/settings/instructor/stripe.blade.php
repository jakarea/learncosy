@extends('layouts/instructor')
@section('title') Stripe Settings Page @endsection

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
                <h1 class="mb-1">Stripe Settings</h1>
            </div>
        </div>
    </div>
    {{-- user profile header area @E --}}

    {{-- profile information @S --}}
    <div class="row">
        <div class="col-lg-12">
            <form action="">
                <div class="stripe-settings-form-wrap">
                    <div class="form-group">
                        <label for="">YOUR STRIPE SECRET KEY</label>
                        <input type="text" class="form-control" placeholder="Enter Secret Key" value="1234_ghjk_2345_sdfgh">
                    </div>
                    <div class="form-submit">
                        <div class="go-to-stripe">
                            <a href="#" target="_blank"><i class="fa-brands fa-cc-stripe me-2"></i>Go to stripe account <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="submit-form">
                            <button class="btn btn-submit" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="productss-list-box payment-history-table mt-4">
                <h5 class="p-3 pb-0">Your Stripe Information :</h5>
                <table>
                    <tr>
                        <th width="5%">No</th>
                        <th>Payment ID</th>
                        <th>Card No</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-success">Success</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    {{-- item @E --}}

                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-warning">Pending</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    {{-- item @E --}}

                    {{-- item @S --}}
                    <tr>
                        <td>1</td>
                        <td>23456</td>
                        <td>12345674321</td>
                        <td>
                            <span class="badge text-bg-danger">Cancel</span>
                        </td>
                        <td>
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>
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