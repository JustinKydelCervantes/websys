@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Create Item</h2>

        <form action="{{ route('items.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="item_name" class="form-label">Item Name</label>
        <input type="text" name="item_name" id="item_name" class="form-control" required>
    </div>

    <div class="mb-4">
        <label for="item_description" class="form-label">Description</label>
        <input type="text" name="item_description" id="item_description" class="form-control">
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
        <label for="unit_of_measure" class="form-label">Unit of measure</label>
        <input type="text" name="unit_of_measure" id="unit_of_measure" class="form-control">
    </div>

    <div class="mb-4">
        <label for="stock_number" class="form-label">Stock Number</label>
        <input type="text" name="stock_number" id="stock_number" class="form-control">
    </div>

    <button type="submit" class="btn btn-success w-100">Create Item</button>
</form>
    </div>
@endsection
