@extends('layouts.latest.students')
@section('title') Cart Page @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/subscription.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />

<style>
    .hide {
        display: none;
    }
</style>
@endsection
{{-- page style @S --}}

{{-- page content @S --}}
@section('content')
{{-- ==== course activity list page @S ==== --}}


@php
$subTotalPrice = 0;
$totalPrice = 0;
@endphp
@foreach ($cart as $item)
@php
$subTotalPrice += $item->courses->price;
$totalPrice += $item->courses->offer_price;
@endphp
@endforeach

<main class="course-activity-list-page">
    <div class="container-fluid">
        <form
            role="form"
            action="{{ route('process-payment') }}"
            method="post"
            class="require-validation needs-validation"
            data-cc-on-file="false"
            data-stripe-publishable-key="{{ $cart[0]->stripe_public_key }}"
            id="payment-form">
            @csrf
            <div class="row">

                @if(count($cart))

                    <div class="col-lg-7">
                        <div class="add-experience-form cart-info-from">
                            <h2>Contact Information</h2>
                            <div class="content-settings-form-wrap profile-text-box-2">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                placeholder="" value="{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : '' }}">
                                            <label for="first_name">First Name</label>
                                            {{-- <span class="invalid-feedback">@error('first_name'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                placeholder="" value="{{ Auth::check() ? explode(' ', Auth::user()->name)[1] : '' }}">
                                            <label for="last_name">Last Name</label>
                                            {{-- <span class="invalid-feedback">@error('last_name'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                            <label for="phone">+880 Phone</label>
                                            {{-- <span class="invalid-feedback">@error('phone'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                            <label for="email">Email</label>
                                            {{-- <span class="invalid-feedback">@error('email'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <h2 class="mt-3">Payment Method</h2>
                                    <div class="payment-method-wrapper">
                                        <a href="#" class="active">
                                            <img src="{{asset('latest/assets/images/master.svg')}}" alt="Master"
                                                class="img-fluid">
                                        </a>
                                        <a href="#" class="mx-4">
                                            <img src="{{asset('latest/assets/images/visa.svg')}}" alt="Visa"
                                                class="img-fluid">
                                        </a>
                                        <a href="#">
                                            <img src="{{asset('latest/assets/images/mb.svg')}}" alt="MB" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group required">
                                            <input type="text" class="form-control" id="card_name" name="card_name"
                                                placeholder="">
                                            <label for="card_name">Name On Card </label>
                                            {{-- <span class="invalid-feedback">@error('card_name'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group required">
                                            <input type="text" class="form-control card-number" id="card_number" name="card_number"
                                                placeholder="">
                                            <label for="card_number">Card Number </label>
                                            {{-- <span class="invalid-feedback">@error('card_number'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group required">
                                            <input type="text" class="form-control card-cvc" id="card_cvv" name="card_cvv"
                                                placeholder="">
                                            <label for="card_cvv">CVV </label>
                                            {{-- <span class="invalid-feedback">@error('card_cvv'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group required">
                                            <select name="card_month" id="card_month" class="form-control card-expiry-month">
                                                <option value="">Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">Augest</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option selected value="12">December</option>
                                            </select>
                                            {{-- <span class="invalid-feedback">@error('card_month'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group required">
                                        <select name="card_year" id="card_year" class="form-control card-expiry-year">
                                            @php
                                            $currentYear = date("Y");
                                            for ($i = 0; $i < 6; $i++) {
                                                $year = $currentYear + $i;
                                                echo '<option value="' . $year . '">' . $year . '</option>';
                                            }
                                           @endphp
                                        </select>

                                            {{-- <span class="invalid-feedback">@error('card_year'){{
                                                $message }}
                                                @enderror</span> --}}
                                        </div>
                                    </div>

                                    <div class='col-lg-12'>
                                        <div class='form-group error hide'>
                                            <div class='alert-danger alert'>Please correct the errors and try
                                                again.
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class='col-lg-12'>
                                        <div class="form-group">
                                            <button id="stripe-pay-now" class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="cart-right-wrap">

                            @foreach ($cart as $item)

                            @php
                            $review_sum = 0;
                            $review_avg = 0;
                            $total = 0;
                            foreach($item->courses->reviews as $review){
                            $total++;
                            $review_sum += $review->star;
                            }
                            if($total)
                            $review_avg = $review_sum / $total;
                            @endphp

                            {{-- cart item start here --}}

                            <div class="cart-items-wrap">
                                <div class="d-flex">
                                    <div class="media">
                                        <img src="{{asset($item->courses->thumbnail)}}" alt="Course Thumbnail"
                                            class="img-fluid">
                                        <div class="media-body">
                                            <h6>{{ Str::limit($item->courses->title, $limit = 30, $end = '...') }}</h6>
                                            <p>{{ $item->name }}</p>

                                            <ul>
                                                <li><span>{{ $review_avg }}</span></li>
                                                @for ($i = 0; $i<$review_avg; $i++) <li><i class="fas fa-star"></i></li>
                                                    @endfor
                                                    <li><span>({{ $total }})</span></li>
                                            </ul>

                                            <h5>€{{ $item->courses->offer_price }} <s>€{{ $item->courses->price }}</s></h5>
                                        </div>
                                    </div>
                                    <div class="cart-close">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn"><i class="fas fa-close"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- cart item end here --}}
                            @endforeach
                            <div class="subtotal-wrap">
                                <table>
                                    <tr>
                                        <td>Subtotal :</td>
                                        <td>€{{ $subTotalPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount :</td>
                                        <td>€{{ $subTotalPrice - $totalPrice }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="subtotal-wrap subtotal-wrap-2">
                                <table>
                                    <tr>
                                        <td>Total :</td>
                                        <td>€{{ $totalPrice }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="cart-checkout-bttn-wrap">
                                <a href="{{ route('students.checkout.cart') }}" class="common-bttn">Pay €{{ $totalPrice }} with
                                    <span class="stripe-bg">
                                        <i class="fa-brands fa-stripe"></i>
                                    </span>
                                </a>


                                <button class="text-white" type="submit" id="stripe-pay-now">Pay €{{ $totalPrice }} with
                                    <span class="stripe-bg">
                                        <i class="fa-brands fa-stripe"></i>
                                    </span></button>
                            </div>
                        </div>
                    </div>
                @else
                <div class="col-12">
                    @include('partials/no-data')
                </div>
                @endif
            </div>
        </form>
    </div>
</main>


{{-- ==== course activity list page @E ==== --}}
@endsection
{{-- page content @E --}}

@section('script')
<script>
    let methods = document.querySelectorAll('.payment-method-wrapper a');

    methods.forEach(item => {
        item.addEventListener("click", function(e) {
            methods.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://js.stripe.com/v2/"></script>

    <script>
        // $(function() {
        $(document).ready(function() {
            var $form = $(".require-validation");

            $("#stripe-pay-now").on('click', function(e) {
                e.preventDefault();
                $form.submit();
            });

            $form.on('submit', function(e) {
                e.preventDefault();

                document.getElementById('stripe-pay-now').disabled = true;

                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();

                var inputSelector = 'input[type=email], input[type=password], input[type=text], input[type=file], textarea,select',
                    $inputs = $form.find('.required').find(inputSelector),


                $errorMessage = $form.find('div.error');

                $errorMessage.addClass('hide');

                $errorMessage.removeClass('hide');

                $('.invalid-feedback').removeClass('invalid-feedback');

                $inputs.each(function(i, el) {
                var $input = $(el);
                    if ($input.val() === '') {
                        $input.closest('.required').addClass('invalid-feedback');

                    }
                });


                if (!$form.data('cc-on-file')) {
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));

                    // Prepare card data
                    var cardData = {
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    };

                    // Use Stripe.js to create a token
                    Stripe.createToken(cardData, function(status, response) {
                        if (response.error) {
                            $errorMessage.removeClass('hide');
                            $errorMessage.find('.alert').text(response.error.message);
                            document.getElementById('stripe-pay-now').disabled = true;
                        } else {
                            var token = response.id;
                            $form.find('input[type=text]').val(''); // Clear sensitive data
                            $form.append("<input type='hidden' name='first_name' value='" + first_name + "'/>");
                            $form.append("<input type='hidden' name='last_name' value='" + last_name + "'/>");
                            $form.append("<input type='hidden' name='email' value='" + email + "'/>");
                            $form.append("<input type='hidden' name='phone' value='" + phone + "'/>");
                            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                            $form.append('<input type="hidden" name="amount" value="{{ $totalPrice }}"/>');
                            $form.append('<input type="hidden" name="instructorId" value="{{ $cart[0]->id }}"/>');
                            $form.get(0).submit(); // Submit the form with the token
                        }
                    });
                }
            });
        });
    </script>


@endsection


