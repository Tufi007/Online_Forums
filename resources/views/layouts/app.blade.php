<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
</head>
<body>
    <header>
        <!-- Navbar code goes here -->
        @include('components.navbar')
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
