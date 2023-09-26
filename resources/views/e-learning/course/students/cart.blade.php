@extends('layouts.latest.students')
@section('title') Cart Page @endsection

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
        <div class="row">
            @if(count($cart))
            <div class="col-lg-7">
                <div class="add-experience-form cart-info-from">
                    <h2>Contact Information</h2>

                    <form action=" " method="POST">
                        @csrf
                        <div class="content-settings-form-wrap profile-text-box-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="" required>
                                        <label for="first_name">First Name</label>
                                        <span class="invalid-feedback">@error('first_name'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="" required>
                                        <label for="last_name">Last Name</label>
                                        <span class="invalid-feedback">@error('last_name'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder=""
                                            required>
                                        <label for="phone">+880 Phone</label>
                                        <span class="invalid-feedback">@error('phone'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder=""
                                            required>
                                        <label for="email">Email</label>
                                        <span class="invalid-feedback">@error('email'){{
                                            $message }}
                                            @enderror</span>
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
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="card_name" name="card_name"
                                            placeholder="" required>
                                        <label for="card_name">Name On Card </label>
                                        <span class="invalid-feedback">@error('card_name'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="card_number" name="card_number"
                                            placeholder="" required>
                                        <label for="card_number">Card Number </label>
                                        <span class="invalid-feedback">@error('card_number'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="card_cvv" name="card_cvv"
                                            placeholder="" required>
                                        <label for="card_cvv">CVV </label>
                                        <span class="invalid-feedback">@error('card_cvv'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="card_month" id="card_month" class="form-control">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">Augest</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <span class="invalid-feedback">@error('card_month'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="card_year" id="card_year" class="form-control">
                                            <option value="">Year</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                        </select>
                                        <span class="invalid-feedback">@error('card_year'){{
                                            $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
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
                                <img src="{{asset($item->courses->thumbnail)}}"
                                    alt="Course Thumbnail" class="img-fluid">
                                <div class="media-body">
                                    <h6>{{ Str::limit($item->courses->title, $limit = 30, $end = '...') }}</h6>
                                    <p>{{ $item->instructor }}</p>

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
                    </div>
                </div>
            </div>
            @else
            <div class="col-12">
                @include('partials/no-data');
            </div>
            @endif
        </div>
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

@endsection