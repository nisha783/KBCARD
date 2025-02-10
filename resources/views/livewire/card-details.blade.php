<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- First Column: Inputs -->
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

                    <!-- Inner Quantity Input -->
                    <div class="mb-3">
                        <label for="inner_quantity" class="form-label">Inner Qty</label>
                        <input type="number" id="inner_quantity" class="form-control" wire:model="inner_quantity">
                    </div>

                    <!-- Screen Price Input (NEW) -->
                    <div class="mb-3">
                        <label for="screen_price" class="form-label">Screen Price</label>
                        <input type="number" id="screen_price" class="form-control" wire:model="screen_price">
                    </div>

                    <!-- Calculate Button -->
                    <button class="btn btn-primary w-100" wire:click="calculate">Calculate Now</button>
                </div>
            </div>
        </div>

        <!-- Second Column: Calculated Results -->
        @if($grand_total > 0)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Calculation Results</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <!-- Card Rate (Price per unit) -->
                                @php
                                    $selectedCard = \App\Models\Card::find($card_id);
                                @endphp

                                <tr>
                                    <td>Card Rate:</td>
                                    <td>
                                        Rs. {{ $selectedCard ? number_format($selectedCard->price, 2) : '0.00' }}/-
                                    </td>
                                </tr>

                                <!-- Sub Total before discount -->
                                <tr>
                                    <td>Sub Total:</td>
                                    <td>Rs. {{ number_format($total, 2) }}/-</td>
                                </tr>
                                <!-- Discount Percentage -->
                                <tr>
                                    <td>Discount ({{ $discount }}%):</td>
                                    <td>Rs. {{ number_format($discount_amount, 2) }}/-</td>
                                </tr>
                                <!-- Remaining Amount after Discount -->
                                <tr>
                                    <td>Sub Total Amount:</td>
                                    <td>Rs. {{ number_format($total - $discount_amount, 2) }}/-</td>
                                </tr>
                                <!-- Inner Price per unit -->
                                <tr>
                                    <td>Inner Price:</td>
                                    <td>Rs. {{ $card ? number_format($card->inner_price, 2) : '0.00' }}/-</td>
                                </tr>
                                <!-- Inner Quantity -->
                                <tr>
                                    <td>Inner Quantity:</td>
                                    <td>{{ $inner_quantity }}</td>
                                </tr>
                                <!-- Screen Price (NEW) -->
                                <tr>
                                    <td>Screen Price:</td>
                                    <td>Rs. {{ number_format($screen_price, 2) }} x {{ $quantity }} = Rs.
                                        {{ number_format($screen_price * $quantity, 2) }}/-</td>
                                </tr>

                                <tr>
                                    <td>Total Inner Cost:</td>
                                    <td>Rs. {{ number_format($inner_price_total, 2) }}/-</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Amount:</strong></td>
                                    <td><strong>Rs. {{ number_format($grand_total, 2) }}/-</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
        @endif
    </div>
</div>