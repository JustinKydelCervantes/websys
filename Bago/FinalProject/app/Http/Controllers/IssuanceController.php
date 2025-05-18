<?php

namespace App\Http\Controllers;

use App\Models\Issuance;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function index()
    {
        $issuances = Issuance::with('item')->get();
        return view('issuances.index', compact('issuances'));
    }

    public function create()
    {
        $items = Item::all();
        return view('issuances.create', compact('items'));
    }
    public function edit(Issuance $issuance)
{
    $items = Item::all(); // So the dropdown has all items
    return view('issuances.edit', compact('issuance', 'items'));
}

public function update(Request $request, Issuance $issuance)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'office' => 'required|string',
        'qty_issued' => 'required|integer|min:1',
    ]);

    $oldQty = $issuance->qty_issued;

    // Get the stock for the item
    $stock = Stock::where('item_id', $issuance->item_id)->first();

    if (!$stock) {
        return back()->withErrors('No stock available for this item.');
    }

    // Adjust stock based on qty difference
    $diff = $request->qty_issued - $oldQty;
    if ($stock->quantity < $diff) {
        return back()->withErrors('Not enough stock available for update.');
    }

    $stock->quantity -= $diff;
    $stock->save();

    // Update issuance
    $issuance->update([
        'item_id' => $request->item_id,
        'office' => $request->office,
        'qty_issued' => $request->qty_issued,
    ]);

    return redirect()->route('issuances.index')->with('success', 'Issuance updated successfully.');
}


    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'office' => 'required|string',
            'qty_issued' => 'required|integer|min:1',
        ]);

        // Find the stock for the selected item
        $stock = Stock::where('item_id', $request->item_id)->first();

        if (!$stock) {
            return back()->withErrors('No stock available for this item.');
        }

        if ($stock->quantity < $request->qty_issued) {
            return back()->withErrors('Not enough stock available.');
        }

        // Subtract issued quantity
        $stock->quantity -= $request->qty_issued;
        $stock->save();

        // Create the issuance record
        Issuance::create([
            'item_id' => $request->item_id,
            'office' => $request->office,
            'qty_issued' => $request->qty_issued,
            ]);

        return redirect()->route('issuances.index')->with('success', 'Issuance created successfully.');
    }

    public function destroy(Issuance $issuance)
    {
        $issuance->delete();
        return back()->with('success', 'Issuance deleted.');
    }
}
