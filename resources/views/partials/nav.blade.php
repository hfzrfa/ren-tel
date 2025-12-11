<!-- Top Nav -->
<header
    class="hidden md:block sticky top-0 z-40 border-b border-gray-200/70 bg-white/90 backdrop-blur-md dark:border-gray-800/70 dark:bg-gray-950/80">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <a href="/" class="inline-flex items-center gap-2">
                {{-- <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm">RT</span> --}}
                <span class="text-lg font-semibold tracking-tight">Rent-Tel</span>
            </a>

            <nav class="hidden md:flex items-center gap-8">
                {{-- <a href="/book"
                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                    Booking</a> --}}
                {{-- <a href="#cars"
                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">Cars</a> --}}
                    <a href="{{ url('/#benefits') }}"
                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">Benefits</a>
                    <a href="{{ url('/#how') }}"
                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">How
                    it works</a>
                    <a href="{{ url('/#testimonials') }}"
                    class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">Reviews</a>
                    <a href="{{ route('cars.index') }}"
                        class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">View
                        cars</a>
                @auth
                    @if (Route::has('booking.mine'))
                        <a href="{{ route('booking.mine') }}"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">My
                            bookings</a>
                    @endif
                @endauth
            </nav>

            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="rounded-lg px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">Sign
                        in</a>
                @endguest
                @auth
                    <div class="text-sm text-gray-700 dark:text-gray-300">Hi, {{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-lg px-3 py-2 text-sm font-semibold text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">Logout</button>
                    </form>
                @endauth
                <a href="{{ route('booking.create') }}"
                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Book
                    now</a>
            </div>

            <!-- Mobile menu button -->
            <button id="menuBtn"
                class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md hover:bg-gray-100 dark:hover:bg-gray-900"
                aria-label="Open menu" aria-expanded="false">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu panel -->
    <div id="mobileMenu"
        class="md:hidden hidden border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-950">
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
</header>
