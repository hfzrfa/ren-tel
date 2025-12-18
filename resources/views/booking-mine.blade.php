@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <div class="min-h-screen bg-gray-50 py-10 text-gray-900 dark:bg-[#050711] dark:text-white">
        <div class="mx-auto max-w-6xl px-4 lg:px-0">
            {{-- Page header --}}
            <header class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[0.7rem] font-semibold uppercase tracking-[0.35em] text-cyan-400/80">
                        Bookings
                    </p>
                    <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">
                        Your reserved cars
                    </h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Quick overview of your upcoming and past rentals.
                    </p>
                </div>

                @if (!$reservations->isEmpty())
                    <form method="GET" action="{{ route('booking.mine') }}" class="flex items-center gap-3">
                        <div class="relative w-64">
                            <input type="text" name="search" value="{{ request('search') }}"
							placeholder="Search car, location, status"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 pl-9 text-sm text-gray-800 placeholder:text-gray-500 shadow-sm outline-none focus:ring-1 focus:ring-cyan-500/70 dark:border-slate-800 dark:bg-[#050711] dark:text-gray-100 dark:shadow-black/40">
                        </div>

                        <div class="hidden text-xs text-gray-500 sm:inline-flex dark:text-gray-400">
                            <span
                                class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-gray-700 dark:bg-white/5 dark:text-gray-200">
                                Total bookings:
                                <span class="ml-1.5 font-semibold text-cyan-600 dark:text-cyan-300">
                                    {{ $reservations->total() }}
                                </span>
                            </span>
                        </div>
                    </form>
                @endif
            </header>

            @if ($reservations->isEmpty())
                {{-- Empty state --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-10 text-center text-gray-800 shadow-lg backdrop-blur dark:border-white/10 dark:bg-white/5 dark:text-white dark:shadow-[0_24px_60px_rgba(0,0,0,0.8)]">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-cyan-500/15">
                    </div>
                    <p class="text-base font-semibold text-slate-900 dark:text-white">
                        No bookings yet
                    </p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Start by reserving a car and it will appear here.
                    </p>
                    <a href="{{ route('booking.create') }}"
                        class="mt-6 inline-flex items-center justify-center rounded-lg bg-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-cyan-500/30 transition hover:bg-cyan-400">
                        Book a car
                    </a>
                </div>
            @else
                {{-- Table container --}}
                <div
					class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl backdrop-blur dark:border-white/10 dark:bg-black/40 dark:shadow-[0_24px_80px_rgba(0,0,0,0.85)]">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse text-sm">
                            <thead>
                                <tr
								class="bg-slate-100 text-xs uppercase tracking-wide text-gray-600 dark:bg-black/70 dark:text-gray-400">
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Car</th>
                                    {{-- <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Pickup location</th> --}}
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Pickup date</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Return date</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-right font-medium">Total</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Status</th>
                                    <th class="whitespace-nowrap px-4 py-3 text-left font-medium">Pickup type</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/[0.06]">
                                @foreach ($reservations as $reservation)
                                    @php
                                        $pickup = $reservation->pickup_date;
                                        $return = $reservation->return_date;
                                        $pickupType = $reservation->pickup_type ?? 'self_pickup';
                                        $pickupLabel = \Illuminate\Support\Str::headline($pickupType);
                                        $status = $reservation->status ?? 'pending';

                                        $statusClasses = match ($status) {
                                            'confirmed'
                                                => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 dark:bg-emerald-500/15 dark:text-emerald-200 dark:ring-emerald-500/40',
                                            'completed',
                                            'finished'
                                                => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200 dark:bg-sky-500/15 dark:text-sky-200 dark:ring-sky-500/40',
                                            'canceled',
                                            'cancelled'
                                                => 'bg-rose-50 text-rose-700 ring-1 ring-rose-200 dark:bg-rose-500/15 dark:text-rose-200 dark:ring-rose-500/35',
                                            'pending' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200 dark:bg-amber-500/15 dark:text-amber-200 dark:ring-amber-500/40',
                                            default => 'bg-slate-100 text-slate-700 ring-1 ring-slate-300 dark:bg-slate-600/30 dark:text-slate-100 dark:ring-slate-500/40',
                                        };
                                    @endphp

                                    <tr
                                        class="group bg-white text-gray-700 transition hover:bg-gray-50 dark:bg-black/30 dark:text-gray-200 dark:hover:bg-black/60">
                                        {{-- car --}}
                                        <td
                                            class="whitespace-nowrap px-4 py-3 align-middle text-[0.95rem] font-semibold text-slate-900 dark:text-white">
                                            {{ $reservation->car->name ?? 'Unknown car' }}
                                            @if (!empty($reservation->reference_code))
                                                <div class="mt-0.5 text-[0.7rem] font-mono text-gray-500 dark:text-gray-500">
                                                    #{{ $reservation->reference_code }}
                                                </div>
                                            @endif
                                        </td>

                                        {{-- pickup location --}}
                                        {{-- <td class="whitespace-nowrap px-4 py-3 align-middle text-gray-200">
        								{{ $reservation->pickup_location ?? '-' }}
        							</td> --}}

                                        {{-- pickup date --}}
                                        <td class="whitespace-nowrap px-4 py-3 align-middle text-gray-700 dark:text-gray-200">
        								{{ $pickup?->format('M d, Y') ?? '-' }}
                                        </td>


                                        {{-- return date --}}
                                        <td class="whitespace-nowrap px-4 py-3 align-middle text-gray-700 dark:text-gray-200">
        								{{ $return?->format('M d, Y') ?? '-' }}
                                        </td>

                                        {{-- total --}}
                                        <td
                                            class="whitespace-nowrap px-4 py-3 align-middle text-right text-gray-900 dark:text-gray-100">
                                            @if (!is_null($reservation->total_price))
                                    Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                                        </td>

                                        {{-- status --}}
                                        <td class="whitespace-nowrap px-4 py-3 align-middle">
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[0.7rem] font-semibold {{ $statusClasses }}">
                                                <span class="h-1.5 w-1.5 rounded-full bg-current opacity-80"></span>
                                                {{ \Illuminate\Support\Str::headline($status) }}
                                            </span>
                                        </td>

                                        {{-- pickup type --}}
                                        <td class="whitespace-nowrap px-4 py-3 align-middle">
                                            <span
                                                class="inline-flex items-center rounded-full bg-cyan-100 px-3 py-1 text-[0.7rem] font-medium text-cyan-800 ring-1 ring-cyan-200 dark:bg-cyan-500/15 dark:text-cyan-200 dark:ring-cyan-400/40">
                                                {{ $pickupLabel }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Footer: pagination + per-page + summary --}}
                    <div
						class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-4 py-3 text-xs text-gray-600 sm:flex-row sm:items-center sm:justify-between dark:border-white/5 dark:bg-black/70 dark:text-gray-400">
                        <div class="flex items-center gap-2">
                            @if ($reservations instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <span>
                                    Showing
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
									{{ $reservations->firstItem() }} - {{ $reservations->lastItem() }}
                                    </span>
                                    of
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $reservations->total() }}
                                    </span>
                                    results
                                </span>
                            @else
                                <span>
                                    Showing
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $reservations->count() }}
                                    </span>
                                    result(s)
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center gap-4 sm:justify-end">
                            <form method="GET" class="flex items-center gap-2">
                                @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <label for="per_page" class="text-gray-600 dark:text-gray-400">Per page</label>
                                <select id="per_page" name="per_page"
                                    class="h-8 rounded-lg border border-slate-200 bg-white px-2 text-xs text-gray-700 shadow-sm focus:outline-none focus:ring-1 focus:ring-cyan-500/70 dark:border-slate-800 dark:bg-black/60 dark:text-gray-100 dark:shadow-black/40"
                                    onchange="this.form.submit()">
                                    @foreach ([10, 25, 50] as $size)
                                        <option value="{{ $size }}" @selected((int) request('per_page', 10) === $size)>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            <div class="text-right text-xs">
                                {{ $reservations->appends([
                                        'search' => request('search'),
                                        'per_page' => request('per_page'),
                                    ])->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
