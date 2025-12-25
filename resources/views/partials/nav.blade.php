<header class="hidden md:flex sticky top-4 z-40 w-full justify-center">
        <div
		class="flex items-center gap-10 px-8 py-3 rounded-full border border-white/40 bg-white/40 text-slate-800 shadow-2xl shadow-black/30 backdrop-blur-2xl transition ">

        {{-- Brand --}}
        <a href="/" class="flex items-center gap-3">
            <span class="text-lg font-semibold tracking-tight text-slate-800 dark:text-black dark:hover:text-white">
                Rent-Tel
            </span>
        </a>

        {{-- NAVIGATION TEXT ONLY --}}
        <nav class="hidden md:flex items-center gap-6">

            <a href="{{ url('/#benefits') }}"
                class="text-sm font-medium transition hover:text-white dark:text-black dark:hover:text-white">
                Benefits
            </a>

            <a href="{{ url('/#how') }}"
                class="text-sm font-medium transition hover:text-white dark:text-black dark:hover:text-white">
                How it works
            </a>

            <a href="{{ url('/#testimonials') }}"
                class="text-sm font-medium transition hover:text-white dark:text-black dark:hover:text-white">
                Reviews
            </a>

            <a href="{{ route('cars.index') }}"
                class="text-sm font-medium transition hover:text-white dark:text-black dark:hover:text-white">
                View cars
            </a>

            @auth
                @if (Route::has('booking.mine'))
                    <a href="{{ route('booking.mine') }}"
                        class="text-sm font-medium text-slate-700 transition hover:text-white dark:text-black dark:hover:text-white">
                        My bookings
                    </a>
                @endif
            @endauth

        </nav>

        {{-- Spacer biar kanan rapi --}}
        <div class="flex-1"></div>

        {{-- Right Section --}}
        <div class="hidden md:flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                    class="rounded-full px-3 py-1.5 text-xs font-semibold text-slate-700 border border-slate-200 hover:border-white hover:text-black transition dark:text-black dark:border-slate-600/70 dark:hover:text-black">
                    Sign in
                </a>
            @endguest

            @auth
                <span class="text-xs font-medium text-slate-700 dark:text-black">
                    Hi, {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-full px-3 py-1.5 text-xs font-semibold text-slate-700 border border-slate-200 hover:border-rose-500 hover:text-rose-500 transition dark:text-black dark:border-slate-600/70 dark:hover:text-rose-300">
                        Logout
                    </button>
                </form>
            @endauth

            <a href="{{ route('booking.create') }}"
                class="ml-1 inline-flex items-center rounded-full bg-black px-4 py-2 text-sm font-semibold text-white shadow-md shadow-black/20 hover:bg-white hover:text-black transition">
                Book now
            </a>
        </div>

    </div>
</header>


<!-- Mobile menu panel -->
<div id="mobileMenu" class="md:hidden hidden border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-950">
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6">
        <nav class="grid gap-2">
            <a href="{{ url('/#cars') }}"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">Cars</a>
            <a href="{{ route('cars.index') }}"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">All
                cars</a>
            @auth
                @if (Route::has('booking.mine'))
                    <a href="{{ route('booking.mine') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">My
                        bookings</a>
                @endif
            @endauth
            <a href="{{ url('/#benefits') }}"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">Benefits</a>
            <a href="{{ url('/#how') }}"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">How it
                works</a>
            <a href="{{ url('/#testimonials') }}"
                class="rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-900">Reviews</a>
            <div class="mt-2 flex gap-2">
                @guest
                    <a href="{{ route('login') }}"
                        class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-900">Sign
                        in</a>
                @else
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full rounded-lg px-3 py-2 text-center text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-900">Logout</button>
                    </form>
                @endguest
                <a href="{{ route('booking.create') }}"
                    class="flex-1 rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Book
                    now</a>
            </div>
        </nav>
    </div>
</div>
