@extends('layouts.app')
@section('content')
    <div class="col-md-9 p-4">
        <div class="d-flex justify-content-between mt-3">
            <h3 class=" fw-bold">Card Details</h3>
            <a href="{{ route('card.create') }}" class="btn btn-primary  me-4 ms-0 ms-md-5">Add Card</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <livewire:card-details />
    </div>
    </div>
    </div>
@endsection
