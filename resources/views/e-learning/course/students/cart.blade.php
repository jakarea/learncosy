@extends('layouts/latest/students')
@section('title') My Courses @endsection

{{-- page style @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/student-dash.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/elearning.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css?v='.time() ) }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>

    @if (!$cart)
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->courses->title }}</td>
                        <td>${{ $item->courses->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <p>Total: ${{ $total }}</p> --}}
        <a href="{{ route('students.checkout.cart') }}" class="btn btn-primary">Proceed to Checkout</a>
    @endif
</div>
@endsection
