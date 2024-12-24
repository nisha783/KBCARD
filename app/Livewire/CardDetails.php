<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Card;
use App\Models\Setting;

class CardDetails extends Component
{

    public $card_id;
    public $quantity;
    public $total = 0;
    public $discount_amount = 0;
    public $grand_total = 0;
    public $discount = 0;

   
    public function mount()
    {
        $setting = Setting::where('key', 'discount')->first();
        $this->discount = $setting ? $setting->value : 0; // Load the discount value
    }

    /**
     * Calculate totals based on card selection and quantity
     */
    public function calculate()
    {
        $card = Card::find($this->card_id);
        
        if ($card) {
            $this->total = $card->price * $this->quantity;
            $this->discount_amount = $this->total * $this->discount / 100;
            $this->grand_total = $this->total - $this->discount_amount;
        }
    }  
    public function render()
    {
        $cards = Card::all();
        return view('livewire.card-details' ,compact('cards'));
    }
}
