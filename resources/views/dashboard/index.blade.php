@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <h1 class="mt-5 fw-bold">Welcome Back!</h1>
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Total Cards</h4>
            </div>
            <div class="card-body text-center">
                <!-- Display the total number of cards -->
                <h5 class="fw-bold">Total Cards: {{ $totalCards }}</h5>
            </div>
        </div>
    </div>
@endsection
