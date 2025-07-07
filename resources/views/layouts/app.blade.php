<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pet API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Pet API</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pets.create') }}">Add New Pet</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main class="py-4">
    @yield('content')
</main>

@yield('scripts')
</body>
</html>
