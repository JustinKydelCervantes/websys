@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    @foreach ($stocksByCategory as $category => $stocksBySupplyType)
        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ ucfirst($category) }} Supplies</h4>
            </div>
            <div class="card-body">
                @foreach ($stocksBySupplyType as $supplyType => $stocks)
                    <h5 class="mt-4 mb-3 text-secondary">{{ ucfirst($supplyType) }} Supplies</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <th>Purchased Qty</th>
                                    <th>Purchased Amount</th>
                                    <th>Received Qty</th>
                                    <th>Received Amount</th>
                                    <th>Issued</th>
                                    <th>Total Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->item->item_name }}</td>
                                        <td>{{ $stock->unit }}</td>
                                        <td>{{ $stock->purchased_quantity }}</td>
                                        <td>{{ number_format($stock->purchased_amount, 2) }}</td>
                                        <td>{{ $stock->received_quantity }}</td>
                                        <td>{{ number_format($stock->received_amount, 2) }}</td>
                                        <td>{{ $stock->issued_count }}</td>
                                        <td>{{ $stock->total_quantity }}</td>
                                        <td>{{ number_format($stock->unit_cost, 2) }}</td>
                                        <td>{{ number_format($stock->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-end fw-bold">Grand Total:</td>
                                    <td class="fw-bold">₱{{ number_format($grandTotalAmount, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
