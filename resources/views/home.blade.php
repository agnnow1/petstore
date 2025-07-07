@extends('layouts.app')

@section('content')
    @include('partials.messages')

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-6">
                <h4>Search Pets by Status</h4>
                <form action="{{ route('pets.findByStatus') }}" method="GET">
                    <div class="mb-3">
                        <label for="status" class="form-label">Select Statuses</label>
                        <select name="status[]" id="status" class="form-select" multiple required>
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <div class="col-md-6">
                <h4>Search Pet by ID</h4>
                <form action="{{ route('pets.findById') }}" method="GET">
                    <div class="mb-3">
                        <label for="id" class="form-label">Pet ID</label>
                        <input type="number" name="id" id="id" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
@endsection
