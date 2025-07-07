@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Search Results</h2>

        @if (empty($pets) || count($pets) === 0)
            <div class="alert alert-info">No pets found for the selected status.</div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pets as $pet)
                    <tr>
                        <td>{{ $pet->id }}</td>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->status }}</td>
                        <td>
                            <a href="{{ route('pets.edit', ['id' => $pet->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('pets.delete', ['id' => $pet->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this pet?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @endif
    </div>
@endsection
