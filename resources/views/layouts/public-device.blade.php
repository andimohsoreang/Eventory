<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Device Info')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @stack('links')
    <style>
        body { background: #f8f9fa; }
        .public-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 0; margin-bottom: 2rem; }
        .public-header h1 { font-size: 1.5rem; margin: 0; color: #4361ee; font-weight: 700; }
    </style>
</head>
<body>
    <header class="public-header text-center">
        <h1>Informasi Device</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 