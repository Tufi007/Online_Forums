<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>X-advice</title>
    <script defer src="{{ asset('js/global.js') }}"></script>

</head>
<body>
    <header>
        <!-- Navbar code goes here -->
        @include('components.navbar')
    </header>

    <main>
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
