<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class MonthlyReportController extends Controller
{
public function index()
{
    $now = Carbon::now('Asia/Manila');
    // Fetch stocks created this month
    $stocks = DB::table('stocks')
        ->join('items', 'stocks.item_id', '=', 'items.id')
        ->select(
            'stocks.ris_number',
            'items.item_name',
            'stocks.quantity',
            'stocks.unit_cost',
            'stocks.total_cost',
            'stocks.created_at'
        )
        ->whereMonth('stocks.created_at', $now->month)
        ->whereYear('stocks.created_at', $now->year)
        ->orderBy('items.item_name')
        ->get();

    // Fetch issuances for the same month
    $issuances = DB::table('issuances')
        ->join('items', 'issuances.item_id', '=', 'items.id')
        ->select(
            'issuances.office',
            'items.item_name',
            'issuances.qty_issued',
            'issuances.created_at'
        )
        ->whereMonth('issuances.created_at', now()->month)
        ->whereYear('issuances.created_at', now()->year)
        ->orderBy('items.item_name')
        ->get();

    return view('monthly_report.index', compact('stocks', 'issuances'));
}


    public function download()
    {
        $report = DB::table('stocks')
            ->join('items', 'stocks.item_id', '=', 'items.id')
            ->leftJoin('issuances', 'stocks.item_id', '=', 'issuances.item_id')
            ->select(
                'stocks.ris_number',
                'issuances.office',
                'items.item_name',
                'items.unit_cost as item_unit_cost',
                'stocks.quantity',
                'stocks.unit_cost as stock_unit_cost',
                'stocks.total_cost as stock_total_cost'
            )
            ->get();
    
        $filename = 'monthly_report.csv';
    
        // Use a temporary file
        $handle = fopen('php://temp', 'w+');
    
        // Add UTF-8 BOM for Excel compatibility
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
    
        // Write header
        fputcsv($handle, [
            'RIST Number', 
            'Office', 
            'Item Name', 
            'Item Unit Cost', 
            'Stock Quantity', 
            'Stock Unit Cost', 
            'Total Cost'
        ]);
    
        // Write data rows
        foreach ($report as $row) {
            fputcsv($handle, [
                $row->ris_number,
                $row->office ?? 'N/A',
                $row->item_name,
                '₱' . number_format($row->item_unit_cost, 2),
                $row->quantity,
                '₱' . number_format($row->stock_unit_cost, 2),
                '₱' . number_format($row->stock_total_cost, 2),
            ]);
        }
    
        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);
    
        return response($csvContent)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Pragma', 'no-cache')
            ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->header('Expires', '0');
    }
    }
