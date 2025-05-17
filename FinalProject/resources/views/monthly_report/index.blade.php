@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Summary Table</h4>
        </div>
                    <div class="card-body">

        <h5 class="mt-4 mb-3 text-secondary">Monthly Report</h5>
           <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead class="table-light">
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
