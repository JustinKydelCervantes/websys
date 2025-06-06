<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Issuance;

class InventoryController extends Controller
{
    public function index()
    {
        // Fetch all stocks with item data
        $stocks = Stock::with('item')
        ->selectRaw('item_id, unit, 
            SUM(quantity) as total_quantity, 
            SUM(CASE WHEN supply_from = "purchased" THEN quantity ELSE 0 END) as purchased_quantity,
            SUM(CASE WHEN supply_from = "received" THEN quantity ELSE 0 END) as received_quantity,
            MAX(unit_cost) as unit_cost,
            MAX(created_at) as latest_date') // 👈 Add this line
        ->groupBy('item_id', 'unit')
        ->get();

        // Group stocks by category (from Item model) and supply type
        $stocksByCategory = $stocks->groupBy(function ($stock) {
            return $stock->item->category;  // Group by category
        });

        // Group by supply type (purchased / received) within each category
        foreach ($stocksByCategory as $category => $stocksInCategory) {
            $stocksByCategory[$category] = $stocksInCategory->groupBy(function ($stock) {
                return $stock->item->supply_type; // Group by supply type (purchased / received)
            });
        }

        // Add issued count and amount calculations
        $issueCounts = Issuance::selectRaw('item_id, COUNT(*) as issued_count')
            ->groupBy('item_id')
            ->pluck('issued_count', 'item_id');

        // Initialize grand total variable
        $grandTotalAmount = 0;

        foreach ($stocks as $stock) {
            // Set issued count from Issuance
            $stock->issued_count = $issueCounts[$stock->item_id] ?? 0;

            // Calculate purchased and received amounts
            $stock->purchased_amount = $stock->purchased_quantity * $stock->unit_cost;
            $stock->received_amount = $stock->received_quantity * $stock->unit_cost;

            // If 'supply_from' is null, calculate total amount as quantity * unit_cost
            if (is_null($stock->supply_from)) {
                $stock->total_amount = $stock->total_quantity * $stock->unit_cost;
            } else {
                // Calculate total amount normally (purchased + received amounts)
                $stock->total_amount = $stock->purchased_amount + $stock->received_amount;
            }

            // Add to the grand total
            $grandTotalAmount += $stock->total_amount;
        }

        // Return the view with stocks grouped by category and the grand total
        return view('inventory.index', compact('stocksByCategory', 'grandTotalAmount'));
    }
}
