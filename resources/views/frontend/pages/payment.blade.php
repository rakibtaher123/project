@extends('frontend.master')

@section('content')
    <!-- Order Details -->
    <div class="col-md-4"></div>
    <div class="col-md-4 order-details" style="margin-top: 70px">
        <div class="section-title text-center">
            <h3 class="title">Your Order</h3>
        </div>
        <div class="order-summary">
            @php
                $cart_array = cardArray();
            @endphp
            <div class="order-col">
                <div><strong>PRODUCT</strong></div>
                <div><strong>TOTAL</strong></div>
            </div>
            <div class="order-products">
                @foreach ($cart_array as $item)
                    <div class="order-col">
                        <div>{{ $item['quantity'] }}x {{ $item['name'] }}</div>
                        <div>&#2547;{{ $item['price'] }}</div>
                    </div>
                @endforeach
            </div>
            <div class="order-col">
                <div>Shiping</div>
                <div><strong>FREE</strong></div>
            </div>
            <div class="order-col">
                <div><strong>TOTAL</strong></div>
                <div><strong class="order-total">&#2547;{{ Cart::getTotal() }}</strong></div>
            </div>
        </div>
        <div class="payment-method">
            <form action="{{ url('order-place') }}" method="post">
                @csrf
                <div class="section-title text-center">
                    <h3 class="title">Please select a Payment Method</h3>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-1" value="cash">
                    <label for="payment-1">
                        <span></span>
                        Cash on Delivery
                    </label>
                    <div class="caption">
                        <p>You can select Cash on Delivery!</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-2" value="bkash">
                    <label for="payment-2">
                        <span></span>
                        Bkash
                    </label>
                    <div class="caption">
                        <p>Bkash No : 019.....</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-3" value="nogod">
                    <label for="payment-3">
                        <span></span>
                        Nogod
                    </label>
                    <div class="caption">
                        <p>Nogod No : 019.....</p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment" id="payment-4" value="rocket">
                    <label for="payment-4">
                        <span></span>
                        Rocket
                    </label>
                    <div class="caption">
                        <p>Rocket No : 019.....</p>
                    </div>
                </div>
        </div>
        <div class="input-checkbox">
            <input type="checkbox" id="terms">
            <label for="terms">
                <span></span>
                I've read and accept the <a href="#">terms & conditions</a>
            </label>
        </div>
        <input type="submit" class="primary-btn" style="float: right" value="Place order">

        </form>

    </div>
    <div class="col-md-4"></div>
    <!-- /Order Details -->
@endsection
