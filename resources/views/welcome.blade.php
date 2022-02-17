<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            <span class="block">{{ __('Challenge') }}</span>
            <span class="block text-indigo-600">{{ __('Promobit products CRUD') }}</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            @if (Route::has('login'))
            <div class="inline-flex rounded-md shadow">
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">{{ __('Login') }}</a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">{{ __('Get started') }}</a>
                @endif
                @endauth
            </div>
        </div>
        @endif
    </div>
</div>

</body>
</html>
