@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Add Unit</h2>
    <form action="{{ route('units.store') }}" method="POST"> @csrf
        <div class="mb-3">
            <label for="unit_name" class="form-label">Unit Name</label>
            <input type="text" name="unit_name" class="form-control" required placeholder="Enter unit (e.g., pcs, box)">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection 