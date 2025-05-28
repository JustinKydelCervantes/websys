@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Create Stock</h1>

        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="item_id" class="form-label">Item</label>
                <select name="item_id" class="form-control" required>
                    <option value="" disabled {{ old('item_id') ? '' : 'selected' }}>Select an Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->item_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required placeholder="Enter quantity"> 
            </div>

            <div class="mb-4">
                <label for="unit_cost" class="form-label">Unit Cost</label>
                <input type="number" name="unit_cost" class="form-control" step="0.01" value="{{ old('unit_cost') }}" required placeholder="Enter price">
            </div>

            <div class="mb-4">
                <label for="reference" class="form-label">Reference (Optional)</label>
                <input type="text" name="reference" class="form-control" value="{{ old('reference') }}" placeholder="Reference (Optional)">
            </div>

            <div class="mb-4">
                <label for="ris_number" class="form-label">RIS Number (Optional)</label>
                <input type="text" name="ris_number" class="form-control" value="{{ old('ris_number') }}" placeholder="00-00-0000">
            </div>

            <div class="mb-4">
                <label for="receipt_qty" class="form-label">Receipt Quantity (Optional)</label>
                <input type="number" name="receipt_qty" class="form-control" value="{{ old('receipt_qty') }}" placeholder="Receipt Quantity (Optional)">
            </div>

            <div class="mb-4">
                <label for="no_of_days_consume" class="form-label">Number of Days to Consume (Optional)</label>
                <input type="number" name="no_of_days_consume" class="form-control" value="{{ old('no_of_days_consume') }}" placeholder="Number of Days Consume (Optional)">
            </div>

            <div class="mb-4">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" class="form-control" required>
                    <option value="" disabled {{ old('unit') ? '' : 'selected' }}>Select Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->unit_name }}" {{ old('unit') == $unit->unit_name ? 'selected' : '' }}>
                           {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="supply_from" class="form-label">Supply From</label>
                <select name="supply_from" class="form-control">
                    <option value="" disabled {{ old('supply_from') ? '' : 'selected' }}>Select Supply Source</option>
                    <option value="purchased" {{ old('supply_from') == 'purchased' ? 'selected' : '' }}>Purchased</option>
                    <option value="received" {{ old('supply_from') == 'received' ? 'selected' : '' }}>Received</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Create Stock</button>
        </form>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
