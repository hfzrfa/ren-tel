<!-- Hero -->
<section class="relative overflow-hidden scrollbar-hidden">
    <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:py-20">
        <div>
            <span
                class="inline-flex items-center rounded-full bg-[#1e1e1e] px-3 py-1 text-xs font-semibold text-white ring-1 ring-inset ring-indigo-600/20">Premium
                fleet • Nationwide</span>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-black">Your ride,
                on your terms.</h1>
            @auth
                <p class="mt-2 text-sm font-medium text-black/70 ">Welcome back,
                    {{ auth()->user()->name }}.</p>
            @endauth
            <p class="mt-4 max-w-xl text-base leading-7 text-gray-600 dark:text-black">Rent-Tel makes car rental
                effortless—transparent pricing, top-tier vehicles, and flexible pickup options in minutes. Drive the
                exact car you want, when you want it.</p>
            <div class="mt-8 flex items-center gap-3">
                <a href="/book"
                    class="rounded-lg bg-[#1e1e1e] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-black hover:shadow-lg focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1e1e1e]">Start
                    your booking</a>
                <a href="#cars"
                    class="rounded-full px-6 py-3 text-sm font-semibold  bg-white/80  text-black shadow-sm hover:bg-white focus-visible:outline-none focus-visible:ring-2  dark:hover:text-white dark:hover:bg-black">Browse
                    cars</a>
            </div>
            <dl class="mt-10 grid grid-cols-3 gap-6 text-center sm:max-w-md">
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-black">2,500+</dt>
                    <dd class="mt-1 text-xs text-gray-500">5-star reviews</dd>
                </div>
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-black">120+</dt>
                    <dd class="mt-1 text-xs text-gray-500">Pickup spots</dd>
                </div>
                <div>
                    <dt class="text-2xl font-bold text-gray-900 dark:text-black">98%</dt>
                    <dd class="mt-1 text-xs text-gray-500">On-time pickups</dd>
                </div>
            </dl>
        </div>
        <div
            id="react-hero-tilted-card"
            class="relative mt-10 lg:mt-0"
            data-image-src="{{ asset('images/pict1.jpg') }}"
            data-caption="Premium rental car"
        >
            <!-- Static card with glassmorphism style (blur + shadow) -->
            <div id="hero-tilt-card" class="relative mx-auto max-w-md rounded-3xl border border-white/40 bg-white/40 p-4 shadow-2xl shadow-black/30 backdrop-blur-2xl transform-gpu transition-transform duration-150">
                <div class="overflow-hidden rounded-3xl">
                    <img
                        src="{{ asset('images/pict1.jpg') }}"
                        alt="Premium rental car"
                        class="block h-full w-full object-cover object-center"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>


    </div>
</section>
