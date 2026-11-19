<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Travel Pass Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">
    <nav class="bg-white border-b border-slate-200 px-6 py-4 shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="font-bold text-lg text-blue-700 tracking-wide">Campus Travel Portal</a>
            <div class="space-x-4">
                <a href="{{ route('registrations.create') }}" class="text-sm font-medium hover:text-blue-600">Register</a>
                <a href="{{ route('registrations.index') }}" class="text-sm font-medium bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700">Admin Dashboard</a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto w-full px-4 py-8 flex-grow">
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} Software Engineering Department — SE4100 Portal
    </footer>
</body>
</html>
