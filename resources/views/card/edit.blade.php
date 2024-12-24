@extends('layouts.app')
@section('content')
            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <a href="{{ route('card.index') }}" class="btn btn-primary">Go Back</a>
                <!-- Success Message -->
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <!-- Card Form in Bootstrap Card -->
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                        <div class="card  shadow">
                            
                            <div class="card-body">
                                <h1 class="text-center mb-4">Edit Card</h1>
                                <form action="{{ route('card.update', $card->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Card Number -->
                                <div class="mb-3">
                                    <label for="card_number" class="form-label">Card Number</label>
                                    <input type="text" class="form-control @error('card_number') is-invalid @enderror"
                                        id="card_number" name="card_number" value="{{ old('card_number', $card->card_number) }}" required>
                                    @error('card_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Quantity -->
                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('qty') is-invalid @enderror"
                                        id="qty" name="qty" value="{{ old('qty', $card->qty) }}" required>
                                        @error('qty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Price -->
                                    <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $card->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Card</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>

  @endsection
