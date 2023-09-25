@extends('layouts.latest.students')
@section('title') Course Certificate @endsection

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
<main class="course-activity-list-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- session message @S --}}
                @include('partials/session-message')
                {{-- session message @E --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="package-list-header" style="grid-template-columns: 100%">
                    @if (!$cart)
                    <h5>Your cart is empty.</h5>
                    @else
                    <h5>Shopping Cart</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="subscription-table-wrap activity-table">
                    <table>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Price</th>
                        </tr>
                        @foreach ($cart as $item)
                        <tr>
                            <td>
                                <p>{{ $item->id }}</p>
                            </td>
                            <td>
                                <p>{{ $item->courses->title }}</p>
                            </td>
                            <td>
                                <p>€ {{ $item->courses->price }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
             <div class="col-12">
                <div class="text-end">
                    <a href="{{ route('students.checkout.cart') }}" class="common-bttn">Proceed to Checkout</a>
                </div>
             </div>
        </div>
    </div>
</main>
{{-- ==== course activity list page @E ==== --}}
@endsection
{{-- page content @E --}}