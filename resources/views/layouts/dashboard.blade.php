<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Countries App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-stone-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 h-screen flex flex-col">
@php
    $user = auth()->user();
    $userName = $user->getAttribute('name') ?? 'User';
    $userEmail = $user->getAttribute('email') ?? '';
@endphp
<nav
    class="sticky top-0 z-50 bg-stone-50/80 dark:bg-zinc-950/80 backdrop-blur-lg border-b border-zinc-200/50 dark:border-zinc-700/50 px-4 sm:px-6 py-4 flex items-center justify-between gap-4 min-h-14">
    <span class="font-semibold text-base">Countries App</span>
    <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
            <p class="font-medium text-sm text-zinc-900 dark:text-zinc-100">{{ $userName }}</p>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $userEmail }}</p>
        </div>
        <a href="{{ route('logout') }}"
           class="inline-flex items-center justify-center min-h-10 px-5 py-2 border border-zinc-300 hover:border-zinc-400 dark:border-zinc-700 dark:hover:border-zinc-500 rounded-sm text-sm leading-normal shrink-0">
            Log out
        </a>
    </div>
</nav>

<main class="max-w-6xl w-full mx-auto p-4 sm:px-6 pb-8 flex-1 flex flex-col min-h-0">
    @yield('content')
</main>

@stack('scripts')
</body>
</html>
