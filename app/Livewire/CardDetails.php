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
    public $screen_price = 0;      // Screen price from settings

    public function mount()
    {
        $discountSetting = Setting::where('key', 'discount')->first();
        $this->discount = $discountSetting ? $discountSetting->value : 0;
        
        $screenPriceSetting = Setting::where('key', 'screen_price')->first();
        $this->screen_price = $screenPriceSetting ? $screenPriceSetting->value : 0;
    }

    public function saveRate()
    {
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
        $card = Card::find($this->card_id);

        if ($card) {
            $card_rate = $card->price ?? 0;
            $this->total = $card_rate * $this->quantity;

            $this->discount = (is_numeric($this->discount) && $this->discount > 0) ? $this->discount : 0;
            $this->discount_amount = ($this->total * $this->discount) / 100;

            $this->inner_price_total = ($card->inner_price ?? 0) * $this->inner_quantity;
            
            // Add screen price multiplied by quantity
            $screen_price_total = $this->screen_price * $this->quantity;
            
            // Calculate the grand total
            $this->grand_total = max(0, $this->total + $this->inner_price_total + $screen_price_total - $this->discount_amount);

            // Save calculated values into the rate model
            $this->saveRate();
        } else {
            session()->flash('error', 'Please select a valid card to calculate.');
        }
    }

    public function render()
    {
        $cards = Card::all();
        return view('livewire.card-details', compact('cards'));
    }
}