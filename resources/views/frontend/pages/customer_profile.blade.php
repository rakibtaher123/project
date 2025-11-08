@extends('frontend.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Customer Profile</h2>

    <div class="card shadow p-4">
        <h4>Name: {{ $customer->name }}</h4>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Mobile:</strong> {{ $customer->mobile }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ url('customer/edit') }}" class="btn btn-info">Edit Profile</a>
        <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
        <a href="{{ url('/') }}" class="btn btn-secondary">Home</a>
    </div>

</div>
@endsection
