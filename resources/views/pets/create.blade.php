@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Pet</h1>

        @include('partials.messages')

        <form action="{{ route('pets.store') }}" method="POST">
            @csrf

            @include('pets.form-fields')

            <button type="submit" class="btn btn-success">Create Pet</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
