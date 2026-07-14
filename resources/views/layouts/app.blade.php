<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Denpasar Hotel School')</title>
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS & JS Assets (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .label-text {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-weight: 600;
        }
        body {
            background-color: #F6F2EA; /* Cream bg */
            color: #1B2A6B; /* Navy Blue text */
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-background-light text-text-light font-sans antialiased transition-colors">
    <!-- Navigation Bar -->
    @include('partials.nav')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')
</body>
</html>
