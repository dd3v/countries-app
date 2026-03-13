<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 dark:bg-zinc-950 text-zinc-900 flex p-4 sm:p-6 lg:p-8 items-center justify-center min-h-screen flex-col">
        <div class="flex items-center justify-center w-full min-h-64 transition-opacity opacity-100 duration-700">
            <main class="flex w-full max-w-md flex-col items-center justify-center gap-4">
                @if (Route::has('login') && !auth()->check())
                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-8 py-3 text-base font-medium bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 hover:bg-zinc-800 dark:hover:bg-zinc-200 rounded-sm transition-colors"
                    >
                        Sign in
                    </a>
                @endif
            </main>
        </div>

    </body>
</html>
