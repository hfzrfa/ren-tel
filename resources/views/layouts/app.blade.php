<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f8fafc">
    <title>@yield('title', 'Rent-Tel')</title>

    <!-- Font: Instrument Sans (matches Tailwind @theme font-sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        (() => {
            const storageKey = 'rentel-theme';
            const root = document.documentElement;
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            let theme = mediaQuery.matches ? 'dark' : 'light';

            try {
                const saved = localStorage.getItem(storageKey);
                if (saved === 'dark' || saved === 'light') {
                    theme = saved;
                }
            } catch (_) {
                /* no-op: fallback to media preference */
            }

            root.classList.toggle('dark', theme === 'dark');
            root.dataset.theme = theme;
            root.style.colorScheme = theme;
            const meta = document.querySelector('meta[name="theme-color"]');
            if (meta) {
                meta.setAttribute('content', theme === 'dark' ? '#0B1220' : '#f8fafc');
            }
        })();
    </script>

    <!-- Vite assets (Tailwind v4 is configured) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Small polish for focus and scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Hide scrollbars globally but keep scrolling enabled */
        html,
        body {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }
    </style>
    @stack('head')
    @yield('head')
</head>

<body class="min-h-full bg-[#F4F4F4] text-black antialiased dark:bg-gray-950 dark:text-gray-100">
    @if (! View::hasSection('hide_nav'))
        @include('partials.nav')
    @endif

    <main>
        @yield('content')
    </main>

    {{-- Mobile theme toggle (always accessible) --}}
    <button type="button" data-theme-toggle aria-pressed="false"
        class="fixed bottom-4 right-4 z-50 inline-flex h-12 w-12 items-center justify-center rounded-full border border-slate-300 bg-white/90 text-slate-700 shadow-lg backdrop-blur transition hover:border-indigo-400 hover:text-indigo-500 md:hidden dark:border-slate-700 dark:bg-slate-800/90 dark:text-slate-200 dark:hover:border-indigo-400 dark:hover:text-indigo-200"
        aria-label="Toggle theme">
        <span data-theme-icon="light" class="block" aria-hidden="true">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2m0 16v2m10-10h-2M4 12H2m15.36 6.36-.7-.7M7.34 7.34l-.7-.7m12.72 0-.7.7M7.34 16.66l-.7.7" />
            </svg>
        </span>
        <span data-theme-icon="dark" class="hidden" aria-hidden="true">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 1 0 9.79 9.79Z" />
            </svg>
        </span>
        <span class="sr-only" data-theme-label>Toggle theme</span>
    </button>

    @if (! View::hasSection('hide_footer'))
        @include('partials.footer')
    @endif

    @stack('scripts')
    @yield('scripts')
    <!-- Global React Dock mount point (mobile only) -->
    <div id="react-dock"></div>
</body>

</html>
