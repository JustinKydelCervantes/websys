@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Create Item</h2>

        <form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="item_name" class="form-label">Item Name</label>
        <input type="text" name="item_name" id="item_name" class="form-control" required placeholder="Enter item name">
    </div>

    <div class="mb-4">
        <label for="item_description" class="form-label">Description</label>
        <input type="text" name="item_description" id="item_description" class="form-control" placeholder="Enter description">
    </div>

    <div class="mb-4">
        <label for="supply_type" class="form-label">Supply Type</label>
        <select name="supply_type" id="supply_type" class="form-control" required>
            <option value="Office Supply">Office Supply</option>
            <option value="Medical Supply">Medical Supply</option>
            <option value="Janitorial Supply">Janitorial Supply</option>
        </select>
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
        <label for="stock_number" class="form-label">Stock Number</label>
        <input type="text" name="stock_number" id="stock_number" class="form-control" placeholder="000">
    </div>

    <button type="submit" class="btn btn-success w-100">Create Item</button>
</form>
    </div>
@endsection
