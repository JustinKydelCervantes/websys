@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Create Issuance</h1>

        <form action="{{ route('issuances.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="item_id" class="form-label">Item</label>
                <select name="item_id" id="item_id" class="form-control" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="office" class="form-label">Office</label>
                <input type="text" name="office" id="office" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="qty_issued" class="form-label">Quantity Issued</label>
                <input type="number" name="qty_issued" id="qty_issued" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Issuance</button>
        </form>
    </div>
@endsection
