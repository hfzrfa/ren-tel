<!-- Hero -->
<section class="relative overflow-hidden scrollbar-hidden">
    <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:py-20">
        <div>
            <span
                class="inline-flex items-center rounded-full bg-indigo-600/10 px-3 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-600/20 dark:text-indigo-300">Premium
                fleet • Nationwide</span>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Your ride,
                on your terms.</h1>
            @auth
                <p class="mt-2 text-sm font-medium text-gray-700 dark:text-gray-200">Welcome back,
                    {{ auth()->user()->name }}.</p>
            @endauth
            <p class="mt-4 max-w-xl text-base leading-7 text-gray-600 dark:text-gray-300">Rent-Tel makes car rental
                effortless—transparent pricing, top-tier vehicles, and flexible pickup options in minutes. Drive the
                exact car you want, when you want it.</p>
            <div class="mt-8 flex items-center gap-3">
                <a href="/book"
                    class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Start
                    your booking</a>
                <a href="#cars"
                    class="rounded-lg px-5 py-3 text-sm font-semibold text-gray-800 ring-1 ring-gray-300 hover:bg-gray-50 dark:text-gray-200 dark:ring-gray-700 dark:hover:bg-gray-900">Browse
                    cars</a>
            </div>
            <dl class="mt-10 grid grid-cols-3 gap-6 text-center sm:max-w-md">
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-white">2,500+</dt>
                    <dd class="mt-1 text-xs text-gray-500">5-star reviews</dd>
                </div>
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-white">120+</dt>
                    <dd class="mt-1 text-xs text-gray-500">Pickup spots</dd>
                </div>
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-white">98%</dt>
                    <dd class="mt-1 text-xs text-gray-500">On-time pickups</dd>
                </div>
            </dl>
        </div>

<div class="relative hidden lg:block">
    <!-- Glow background -->
    <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-indigo-500/10 blur-3xl"></div>

    <!-- Wrapper card -->
    <div class="relative mx-auto max-w-md rounded-3xl border border-slate-800/60 bg-slate-900/80 p-4 shadow-2xl shadow-indigo-900/40">

        <!-- IMAGE FIX -->
        <div class="overflow-hidden rounded-2xl bg-slate-900">
            <img
                src="{{ asset('images/hero-car.png') }}"
                alt="Premium rental car"
                class="w-full h-64 object-cover object-center block"
                loading="lazy"
            >
        </div>

        <!-- Bottom label -->
        <div class="mt-4 flex items-center justify-between text-xs text-slate-300">
            <span>Featured vehicle</span>
            <span class="rounded-full bg-emerald-500/10 px-2 py-0.5 text-[10px] font-semibold text-emerald-300">
                Instant confirmation
            </span>
        </div>

    </div>
</div>


    </div>
</section>
