<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Http\Requests\PriceRequest;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::all();

        return view('price.index', [ 'prices' => $prices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('price.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PriceRequest $request)
    {

        $validated = $request->validated();
    
        $price = new Price();
        $price->type = $validated['type'];
        $price->price = $validated['price'];
        $price->start_date = $validated['start_date'];
        $price->end_date = $validated['end_date'];

        $price->save();

        return redirect()->route('price.index')->with('success', 'Prix ajouté avec sucès');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $price = Price::findOrFail($id);

        return view('price.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, string $id)
    {
        // $validated = $request->validate([
        //     'type' => 'required|string|max:255',
        //     'price' => 'required|numeric|min:0',
        //     'start_date' => 'required|date',
        //     'end_date' => 'date|after_or_equal:start_date',
        // ]);

        $validated = $request->validated();

        $price = Price::findOrFail($id);
        $price->update($validated);

        return redirect()->route('price.index')->with('success', 'Price updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $price = Price::findOrFail($id);

        if($price) {
            $price->delete();
        }

        return redirect()->route('price.index')->with('success', 'Prix supprimé avec sucès');

    }
}
