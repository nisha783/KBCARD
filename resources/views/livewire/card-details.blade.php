<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Card Details</h3>
                </div>
                <div class="card-body">
                    <!-- Card Number Dropdown -->
                    <div class="mb-3">
                        <label for="card_id" class="form-label">Card Number</label>
                        <select id="card_id" class="form-select" wire:model="card_id">
                            <option value="">Select a Card</option>
                            @foreach($cards as $card)
                                <option value="{{ $card->id }}">{{ $card->card_number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity Input -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Qty</label>
                        <input type="number" id="quantity" class="form-control" wire:model="quantity">
                    </div>

                    <!-- Calculate Button -->
                    <button class="btn btn-primary" wire:click="calculate">Calculate Now</button>
                </div>
            @if($total > 0)
                <table class="table table-bordered">
                    <tr>
                        <td>Card Rate:</td>
                                <td>Rs. {{$total / max($quantity, 1)}}/-</td>
                            </tr>
                            <tr>
                                <td>Sub Total:</td>
                                <td>Rs. {{ $total }}/-</td>
                            </tr>
                            <tr>
                                <td>Discounted Amount:</td>
                                <td>Rs. {{ $discount_amount }}/-</td>
                            </tr>
                            <tr>
                                <td>Extra Inner Price:</td>
                                <td>Rs. {{ $inner_price_total }}/-</td>
                            </tr>
                            <tr>
                                <td><strong>Total Amount:</strong></td>
                                <td><strong>Rs. {{ $grand_total }}/-</strong></td>
                    </tr>
                </table>
            @endif

            </div>
        </div>
    </div>
</div>
