<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $app_name }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen">
<div class="flex flex-col min-h-screen">
    <div class="navbar bg-base-100">
        <div class="navbar-start">
        <a href="{{ route('home') }}" class="btn btn-ghost normal-case text-xl">{{ $app_name }}</a>
        </div>
        <div class="navbar-end">
            <a href="{{ route('configure.index') }}" class="btn btn-ghost">
                <x-heroicon-o-cog class="w-5 h-5"/>
            </a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="p-4">
            <div class="alert alert-success">
                <x-heroicon-m-check-circle class="w-5 h-5"/>
                <span>Your purchase has been confirmed!</span>
            </div>
        </div>
    @endif

    <div class="px-6 mb-auto">
        {{ $slot }}
    </div>

    <footer class="footer footer-center p-4 bg-base-300 text-base-content">
        <div>
            <p>Copyright © {{ date('Y') }} - All right reserved by {{ $author }}</p>
        </div>
    </footer>
</div>
</body>
</html>
