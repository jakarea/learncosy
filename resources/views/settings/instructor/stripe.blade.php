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
            @include('partials.session-message')
            <form action="{{ route('instructor.stripe.update') }}" method="post">
                @csrf
                <div class="stripe-settings-form-wrap">
                    <div class="form-group mb-3">
                        <label for="stripe_public_key">STRIPE KEY 
                            <sup><small class="badge badge-success bg-success">{{ isConnectedWithStripe()[1] }}</small></sup>
                        </label>
                        <input type="text" class="form-control" name="stripe_public_key" placeholder="Enter Secret Key" value="{{ $user->stripe_public_key }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stripe_secret_key">STRIPE SECRET KEY</label>
                        <input type="text" class="form-control" name="stripe_secret_key" placeholder="Enter Secret Key" value="{{ $user->stripe_secret_key }}">
                    </div>
                    <div class="form-submit">
                        <div class="go-to-stripe">
                            <a href="https://stripe.com" target="_blank"><i class="fa-brands fa-cc-stripe me-2"></i>Go to stripe account <i class="fas fa-arrow-right"></i></a>
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
                        <th>Account ID</th>
                        <th>Account Type</th>
                        <th>Account Status</th>
                    </tr>
                    @if (isConnectedWithStripe()[0])
                        <tr>
                            <td>1</td>
                            <td>{{ isConnectedWithStripe()[0]->id }}</td>
                            <td>{{ isConnectedWithStripe()[0]->type }}</td>
                            <td>{{ isConnectedWithStripe()[0]->charges_enabled ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4">No Stripe Account Connected</td>
                        </tr>
                    @endif

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