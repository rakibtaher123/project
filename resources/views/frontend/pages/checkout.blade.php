<?php
use App\Models\Shipping;
?>
@extends('frontend.master')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <!-- Billing Details -->
                    @php
                        $customer = App\Models\Shipping::find(Session::get('sid'));
                    @endphp
                    @if ($customer != null)
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">SHIPING address {{ Session()->get('sid') }}</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="name" placeholder="Full Name"
                                    value="{{ $customer->name }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email"
                                    value="{{ $customer->email }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Address"
                                    value="{{ $customer->address }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="city" placeholder="City"
                                    value="{{ $customer->city }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="country" placeholder="Country"
                                    value="{{ $customer->country }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="zip_code" placeholder="ZIP Code"
                                    value="{{ $customer->zip_code }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="mobile" placeholder="Mobile No."
                                    value="{{ $customer->mobile }}">
                            </div>
                            <a href="{{ url('/payment') }}" class="primary-btn" style="float: right">next</a>
                        </div>
                    @else
                        <form action="{{ url('/shiping-address') }}" method="post">
                            @csrf


                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">SHIPING address{{ Session()->get('sid') }}</h3>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="name" placeholder="Full Name"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="email" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="country" placeholder="Country">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="zip_code" placeholder="ZIP Code">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="tel" name="mobile" placeholder="Mobile No."
                                        value="">
                                </div>
                                <button type="submit" class="primary-btn" style="float: right">next</button>

                            </div>
                    @endif
                    </form>

                    <!-- /Billing Details -->

                    <!-- Shiping Details -->
                    {{-- <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Shiping address</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address">
                            <label for="shiping-address">
                                <span></span>
                                Ship to a diffrent address?
                            </label>
                            <div class="caption">
                                <div class="form-group">
                                    <input class="input" type="text" name="first-name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="last-name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="country" placeholder="Country">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="tel" name="tel" placeholder="Telephone">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Shiping Details -->

                    <!-- Order notes -->
                    {{-- <div class="order-notes">
                        <textarea class="input" placeholder="Order Notes"></textarea>
                    </div> --}}
                    <!-- /Order notes -->
                </div>
                <div class="col-md-2"></div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
