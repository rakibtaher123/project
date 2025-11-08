@extends('frontend.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ url('customer/update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" value="{{ $customer->mobile }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" class="form-control" required>
            </div>

            {{-- যদি পাসওয়ার্ড আপডেট দিতে চাও --}}
            {{-- 
            <div class="mb-3">
                <label class="form-label">Password (optional)</label>
                <input type="password" name="password" class="form-control">
            </div>
            --}}

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ url('customer') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
