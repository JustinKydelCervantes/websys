@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Monthly Report</h4>

        </div>
                    <div class="card-body">

           <div class="table-responsive">
                <h2>Stock Additions - {{ now()->format('F Y') }}</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>RIS Number</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Total Cost</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $stock->ris_number }}</td>
                            <td>{{ $stock->item_name }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>₱{{ number_format($stock->unit_cost, 2) }}</td>
                            <td>₱{{ number_format($stock->total_cost, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->created_at)->setTimezone('Asia/Manila')->format('Y-m-d h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2 class="mt-5">Item Issuances - {{ now()->format('F Y') }}</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Office</th>
                            <th>Item</th>
                            <th>Quantity Issued</th>
                            <th>Date Issued</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($issuances as $issue)
                        <tr>
                            <td>{{ $issue->office }}</td>
                            <td>{{ $issue->item_name }}</td>
                            <td>{{ $issue->qty_issued }}</td>
                            <td>{{ \Carbon\Carbon::parse($issue->created_at)->setTimezone('Asia/Manila')->format('Y-m-d h:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('monthly_report.download') }}" class="btn btn-success">
                Download CSV
            </a>
        </div>
    </div>
</div>
@endsection
