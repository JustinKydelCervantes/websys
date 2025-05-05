<!-- resources/views/issuances/edit.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Issuance</h2>

    <form action="{{ route('issuances.update', $issuance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Item -->
        <div class="form-group">
            <label for="item_id">Item</label>
            <select name="item_id" id="item_id" class="form-control" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $issuance->item_id ? 'selected' : '' }}>
                        {{ $item->item_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Office -->
        <div class="form-group">
            <label for="office">Office</label>
            <input type="text" name="office" id="office" class="form-control" value="{{ old('office', $issuance->office) }}" required>
        </div>

        <!-- Quantity Issued -->
        <div class="form-group">
            <label for="qty_issued">Quantity Issued</label>
            <input type="number" name="qty_issued" id="qty_issued" class="form-control" value="{{ old('qty_issued', $issuance->qty_issued) }}" required min="1">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Update Issuance</button>
    </form>
</div>
@endsection
