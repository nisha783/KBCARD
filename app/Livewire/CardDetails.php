<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\rate;    
use App\Models\Setting;
use Livewire\Component;

class CardDetails extends Component
{
    public $card_id;
    public $quantity = 0;          // Number of cards
    public $inner_quantity = 0;    // Quantity of inners per card
    public $total = 0;             // Total cost of cards
    public $inner_price_total = 0; // Total cost of inners
    public $discount_amount = 0;   // Discount amount applied
    public $grand_total = 0;       // Grand total after calculation
    public $discount = 0;          // Discount percentage
    public $total_inners = 0;      // Total inners across all cards
    public $extra_inner_price = 0; // Extra cost of additional inners

    public function mount()
    {
        // Load the discount setting from the Setting model
        $setting = Setting::where('key', 'discount')->first();
        $this->discount = $setting ? $setting->value : 0;
    }

    public function saveRate()
    {
        // Save the calculated rates into the database for future reference
        rate::create([
            'card_id' => $this->card_id,
            'quantity' => $this->quantity,
            'inner_quantity' => $this->inner_quantity,
            'total' => $this->total,
            'inner_price_total' => $this->inner_price_total,
            'extra_inner_price' => $this->extra_inner_price,
            'discount_amount' => $this->discount_amount,
            'grand_total' => $this->grand_total
        ]);
    }

    public function calculate()
    {
        // Fetch the card details from the Card model
        $card = Card::find($this->card_id);

        // Fetch Rate data from Rate model based on selected card
        $rate = Rate::where('card_id', $this->card_id)->first();

        if ($card && $rate) {
            // Card Rate Calculation (Card price multiplied by quantity)
            $card_rate = $card->price;
            $this->total = $card_rate * $this->quantity; // Total cost for all cards

            // Calculate Discount (based on the entered discount percentage)
            $this->discount = is_numeric($this->discount) && $this->discount > 0 ? $this->discount : 0;
            $this->discount_amount = ($this->total * $this->discount) / 100; // Discount amount based on total

            // Correct Inner Price Calculation:
            // Multiply the inner quantity (from Rate model) by the inner price (from Card model)
            $this->inner_price_total = $card->inner_price * $this->inner_quantity;

            // Grand Total Calculation: Total card cost + Inner price total - Discount applied
            $this->grand_total = max(0, $this->total + $this->inner_price_total - $this->discount_amount);
        
            // Save calculated data into database
            $this->saveRate();
        }
    }

    public function render()
    {
        // Load all available cards for user selection
        $cards = Card::all();
        return view('livewire.card-details', compact('cards'));
    }
}
