@extends('layouts.admin')

@section('content')
    <h1>Stocks</h1>
    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Create New Stock</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Total Cost</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (collect($stocks)->sortBy(fn($stock) => $stock->item->item_name) as $stock)
                <tr>
                    <td>{{ $stock->item->item_name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ number_format($stock->unit_cost, 2) }}</td>
                    <td>{{ number_format($stock->total_cost, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($stock->created_at)->format('Y-m-d') }}</td> 
                    <td>
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->

@endsection
