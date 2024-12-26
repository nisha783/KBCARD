<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\rate;    
use App\Models\Setting;
use Livewire\Component;

class CardDetails extends Component
{
    public $card_id;
    public $quantity;
    public $inner_quantity;
    public $total = 0;
    public $inner_price_total = 0;
    public $discount_amount = 0;
    public $grand_total = 0;
    public $discount = 0;
    public $total_inners = 0;
    public $extra_inner_price = 0;  

    public function mount()
    {
        $setting = Setting::where('key', 'discount')->first();
        $this->discount = $setting ? $setting->value : 0; 
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
        // Fetch the card
        $card = Card::find($this->card_id);
        
        if ($card) {
            // Calculate total inner cost
            $this->inner_price_total = $card->inner_price * $this->inner_quantity;
    
            // Calculate total inners (assuming quantity and inner quantity are the multiplying factors)
            $this->total_inners = $this->quantity * $this->inner_quantity;
    
            // Calculate the total price of all cards
            $this->total = $card->price * $this->quantity;
    
            // Calculate the discount amount based on the total price
            $this->discount_amount = ($this->total * $this->discount) / 100;
    
            // Calculate the extra inner price (this assumes you want to add it to the inner total, similar to the current calculation)
            $this->extra_inner_price = $this->inner_quantity * $card->inner_price;
    
            // Calculate the grand total, factoring in the discount, total inner cost, and extra inner price
            $this->grand_total = $this->total - $this->discount_amount + $this->inner_price_total + $this->extra_inner_price;
    
            // Save the calculated data to the database
            $this->saveRate(); // Save the rate record to the database
        }
    }
    

    public function render()
    {
        // Get available cards
        $cards = Card::all();
        return view('livewire.card-details', compact('cards'));
    }
}
