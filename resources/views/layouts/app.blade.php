<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Allow pushing styles from child views -->
    @stack('styles')

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #e0f7fa; /* Light cyan background */
            color: #00695c; /* Dark cyan text for contrast */
        }

        .glow-background {
            background: radial-gradient(circle at top left, #b2ebf2, #4dd0e1); /* Light cyan gradient */
            min-height: 100vh;
            background-attachment: fixed;
            color: #004d40; /* Darker cyan text */
            box-shadow: inset 0 0 60px rgba(0, 188, 212, 0.1);
        }

        .page-header {
            font-size: 2rem;
            font-weight: 700;
            color: #004d40; /* Dark cyan text */
            text-shadow: 0 0 10px rgba(0, 188, 212, 0.5); /* Cyan shadow */
        }

        header.bg-glow {
            background: rgba(0, 150, 136, 0.6); /* Soft light cyan background */
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #26c6da; /* Cyan border */
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.3);
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #26c6da; /* Light cyan border */
            border-radius: 8px;
            background-color: #b2ebf2; /* Lighter cyan background */
            color: #00695c; /* Dark cyan text */
            font-size: 14px;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 188, 212, 0.3);
            transition: 0.3s;
        }

        input:focus,
        textarea:focus {
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.7);
            border-color: #26c6da;
        }

        .submit-button {
            background: linear-gradient(to right, #00bcd4, #00838f); /* Light cyan to teal gradient */
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.6);
            transition: 0.3s;
        }

        .submit-button:hover {
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.8);
            transform: scale(1.05);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #004d40; /* Darker cyan label */
        }

        .form-container {
            background: rgba(224, 247, 250, 0.9); /* Slightly transparent light cyan */
            border-radius: 15px;
            padding: 24px;
            box-shadow: 0 0 20px rgba(0, 188, 212, 0.3);
            border: 1px solid rgba(0, 188, 212, 0.2);
            max-width: 600px;
            margin: auto;
        }

        .back-link {
            color: #26c6da;
            text-decoration: underline;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: #00bcd4;
        }
    </style>
</head>
<body class="antialiased">
    <div class="glow-background">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Header --}}
        @hasSection('header')
            <header class="bg-glow shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Page Content --}}
        <main class="px-4 py-6 sm:px-6 lg:px-8">
            @yield('content') {{-- For @section --}}
            {{ $slot ?? '' }} {{-- For <x-app-layout> --}}
        </main>

        {{-- Allow pushing scripts from child views --}}
        @stack('scripts')
    </div>
</body>
</html>
