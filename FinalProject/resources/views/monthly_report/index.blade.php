@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Monthly Report</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Summary Table</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>RIST Number</th>
                        <th>Office</th>
                        <th>Item Name</th>
                        <th>Stock Quantity</th>
                        <th>Stock Unit Cost</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report as $row)
                    <tr>
                        <td>{{ $row->ris_number }}</td>
                        <td>{{ $row->office ?? 'N/A' }}</td>
                        <td>{{ $row->item_name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>₱{{ number_format($row->stock_unit_cost, 2) }}</td>
                        <td>₱{{ number_format($row->stock_total_cost, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
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
