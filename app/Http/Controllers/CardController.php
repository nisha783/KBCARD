<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all cards from the database
        $cards = Card::paginate(5);
        return view('card.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('card.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data manually
        $request->validate([
            'card_number' => 'required|string|unique:cards',
            'price' => 'required|numeric|min:0',
            'inner_price' => 'required|numeric|min:0',
        ]);

        // Store the new card using request input
        Card::create([
            'card_number' => $request->input('card_number'),
            'price' => $request->input('price'),
            'inner_price' => $request->input('inner_price'),
        ]);

        // Redirect with a success message
        return redirect()->route('card.index')->with('success', 'Card created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return view('card.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('card.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        // Validate the incoming data manually
        $request->validate([
            'card_number' => 'required|string|unique:cards,card_number,' . $card->id,
            'price' => 'required|numeric|min:0',
            'inner_price' => 'required|numeric|min:0',
            
        ]);

        // Update the card using request input
        $card->update([
            'card_number' => $request->input('card_number'),
            'price' => $request->input('price'),
            'inner_price' => $request->input('inner_price'),
        ]);

        // Redirect with a success message
        return redirect()->route('card.index')->with('success', 'Card updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        // Delete the card
        $card->delete();

        // Redirect with a success message
        return redirect()->route('card.index')->with('success', 'Card deleted successfully!');
    }
}
