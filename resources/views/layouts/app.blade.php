<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pothole Fixer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 2rem; padding-bottom: 2rem; }
        .danger-card { border-left: 5px solid #dc3545; }
        .warning-card { border-left: 5px solid #ffc107; }
        .success-card { border-left: 5px solid #198754; }
    </style>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="{{ route('reports.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4">🚧 Pothole Fixer BE</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('reports.create') }}" class="nav-link {{ request()->routeIs('reports.create') ? 'active' : '' }}">Report Pothole</a></li>
        </ul>
    </header>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>