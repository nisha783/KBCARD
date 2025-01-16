@extends('layouts.app')
@section('content')

    <div class="col-md-9">
        <a href="{{ route('card.index') }}" class="btn btn-primary mt-4 ms-3 mb-4">Go Back</a>
        <div class="d-flex justify-content-center align-items-center vh-80 ">
            <div class="card shadow-lg w-100 mb-5" style="max-width: 500px;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <h4 class="card-title text-center mb-4 fw-bold">Add New Card</h4>
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Card Add Form -->
                    <form action="{{ route('card.store') }}" method="POST">
                        @csrf

                        <!-- Card Number -->
                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control @error('card_number') is-invalid @enderror"
                                id="card_number" name="card_number" value="{{ old('card_number') }}" required>
                            @error('card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                          <!-- Inner Price -->
                          <div class="mb-3">
                            <label for="inner_price" class="form-label">Inner Price</label>
                            <input type="number" class="form-control @error('inner_price') is-invalid @enderror"
                                id="inner_price" name="inner_price" value="{{ old('inner_price') }}" required>
                            @error('inner_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Card</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

@endsection
