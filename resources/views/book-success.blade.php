@extends('layouts.app')

@section('title', 'Booking success')
@section('hide_footer', true)

@section('content')
    <div class="min-h-screen overflow-hidden bg-[#f4f4f4] text-slate-900">
        {{-- Ambient background accents --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute left-[-12%] top-[-16%] h-64 w-64 rounded-full bg-emerald-500/10 blur-3xl"></div>
            <div class="absolute right-[-10%] bottom-[-18%] h-72 w-72 rounded-full bg-indigo-500/15 blur-3xl"></div>
        </div>

        <div class="relative flex min-h-screen items-center justify-center">
            {{-- Wrapper to center the card --}}
            <div
                class="w-full max-w-xl rounded-3xl border border-white/40 bg-white/40 p-8 text-black shadow-2xl shadow-black/30 backdrop-blur-2xl">
                {{-- Success card --}}
                <div class="rounded-2xl border border-white/60 bg-white/90 p-8 shadow-xl backdrop-blur-sm">
                    {{-- Success icon --}}
                    <div class="flex justify-center">
                        <div class="rounded-full bg-emerald-500/15 p-3 ring-1 ring-emerald-400/30">
                            <svg viewBox="0 0 24 24" class="h-10 w-10 text-emerald-400" fill="none" stroke="currentColor"
                                stroke-width="3">
                                <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-6 text-center space-y-3">
                        <h1 class="text-xl font-semibold text-slate-900">Booking Successful!</h1>
                        <p class="text-sm text-slate-600">Your car rental is confirmed. We'll reach out with the next
                            steps shortly.</p>
                    </div>

                    <div class="mt-6 space-y-4">
                        <a href="{{ route('booking.mine') }}"
                            class="block w-full rounded-2xl bg-black px-4 py-3 text-center text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white hover:text-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black/60">
                            View my bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
