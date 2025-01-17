@extends('layouts.app')
@section('content')
      <div class="col-md-9 p-4">
     <div class="d-flex justify-content-between mt-3">
      <h3 class=" fw-bold">Card Details</h3>
      <a href="{{ route('card.create') }}" class="btn btn-primary  me-4 ms-0 ms-md-5">Add Card</a>
     </div>

        <div class="container mt-5">

          <!-- Success Message -->
          @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <!-- Responsive Table -->
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Card Number</th>
                  <th>Price</th>
                  <th>Inner Price</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cards as $card)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $card->card_number }}</td>
                  <td>{{ $card->price }}</td>
                  <td>{{ $card->inner_price }}</td>
                  <td>
                    <!-- Edit Button -->
                    <a href="{{ route('card.edit', $card->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <!-- Delete Form -->
                    <form action="{{ route('card.destroy', $card->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center">No cards available.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            {{ $cards->links('vendor.pagination.bootstrap-5') }}
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
