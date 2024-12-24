@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <h1 class="mt-5 fw-bold">Welcome Back!</h1>
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title">Total Cards: ({{ $totalCards }})</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($cards as $card)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Card Number: {{ $card->card_number }}</h5>
                                    <p class="card-text">Quantity: {{ $card->qty }}</p>
                                    <p class="card-text">Price: Rs {{ number_format($card->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No cards available.</p>
                    @endforelse
                </div>
                {{ $cards->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
