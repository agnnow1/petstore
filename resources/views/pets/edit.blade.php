@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pet</h1>

        @include('partials.messages')

        <form action="{{ route('pets.update', ['id' => $pet->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ old('id', $pet->id ?? '') }}">

            @include('pets.form-fields', ['pet' => $pet])

            <button type="submit" class="btn btn-primary">Update Pet</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>

        </form>
        <form action="{{ route('pets.delete', ['id' => $pet->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ms-2">Delete</button>
        </form>
    </div>
@endsection
