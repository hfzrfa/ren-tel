<!-- Featured cars -->
<section id="cars" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:py-16">
    <header class="flex items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-black">Popular choices</h2>
            <p class="mt-1 text-sm text-gray-600 hover:text-black">Handpicked vehicles ready for your next trip.</p>
        </div>
        <a href="{{ route('cars.index') }}"
            class="hidden md:inline-flex items-center gap-1 text-sm font-semibold text-black hover:text-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded dark:hover:text-white">
            See all cars
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14" />
                <path d="M12 5l7 7-7 7" />
            </svg>
        </a>
    </header>

    <div id="carsGrid" class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($cars as $car)
            <article
                class="group overflow-hidden rounded-2xl border border-gray-200/80 bg-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md focus-within:ring-2 focus-within:ring-indigo-500  dark:bg-[#f5f5f5] dark:hover:shadow-lg">
                <div class="relative aspect-4/3 overflow-hidden">
                    @php
                        $img = $car->image_path
                            ? asset('storage/' . $car->image_path)
                            : ($car->image_url ?:
                            'https://images.unsplash.com/photo-1549924231-f129b911e442?q=80&w=1200&auto=format&fit=crop');
                    @endphp

                    <img src="{{ $img }}" alt="{{ $car->name }}"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy"
                        decoding="async" />

                    <!-- soft top gradient -->
                    <div
                        class="pointer-events-none absolute inset-0 bg-linear-to-t from-black/25 via-black/0 to-transparent">
                    </div>

                    <!-- type badge -->
                    <span
                        class="absolute left-3 top-3 inline-flex items-center rounded-full bg-white/90 px-2 py-1 text-[10px] font-medium text-gray-900 ring-1 ring-black/5 backdrop-blur dark:bg-gray-900/80 dark:text-gray-100">
                        {{ strtoupper($car->type) }}
                    </span>
                </div>

                <div class="p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h3 class="line-clamp-1 text-base font-semibold leading-6 text-black">
                                {{ $car->name }}
                            </h3>
                            <p class="mt-0.5  text-black">
                                {{ strtoupper($car->type) }} • {{ ucfirst($car->transmission) }}
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-black">
                                Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                <span class="text-sm font-medium text-gray-500">/day</span>
                            </div>
                        </div>
                    </div>

                    <ul class="mt-3 flex flex-wrap items-center gap-2 text-[11px]">
                        <li
                            class="inline-flex items-center gap-1 rounded-md bg-[#1e1e1e] px-2 py-1 text-white ring-1 ring-gray-200 transition-colors hover:bg-white hover:text-[#181818] hover:ring-[#181818]">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 13v-2a8 8 0 1 0-16 0v2" />
                                <path d="M2 13h20" />
                                <path d="M6 17h.01" />
                                <path d="M10 17h.01" />
                                <path d="M14 17h.01" />
                                <path d="M18 17h.01" />
                            </svg>
                            AC
                        </li>
                        <li
                            class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 text-[#181818] ring-1 ring-gray-200 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:ring-gray-700 dark:hover:bg-gray-700">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12l5-5 5 5" />
                                <path d="M12 19V7" />
                            </svg>
                            {{ ucfirst($car->transmission) }}
                        </li>
                        <li
                            class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 text-[#181818] ring-1 ring-gray-200 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:ring-gray-700 dark:hover:bg-gray-700">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 7h20M2 17h20M4 7l2 10m12-10l2 10M6 11h12" />
                            </svg>
                            {{ $car->seats }} seats
                        </li>
                    </ul>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-[11px] text-gray-500">{{ $car->location }}</span>

                        <a href="{{ route('booking.create') }}"
                            class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-3 py-2 text-xs font-semibold text-white shadow-sm transition-colors hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-900 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus-visible:ring-gray-700">
                            Reserve
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="sm:col-span-2 lg:col-span-3">
                <div
                    class="rounded-xl border border-gray-200 bg-white p-6 text-center text-sm text-gray-600 dark:border-gray-800 dark:bg-gray-900 hover:text-black">
                    No cars found. Try adjusting filters.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6 text-center md:hidden">
        <a href="{{ route('cars.index') }}"
            class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 rounded">
            See all cars
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14" />
                <path d="M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</section>
