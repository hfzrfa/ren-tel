@extends('layouts.app')

@section('title', 'Booking success')
@section('hide_footer', true)

@section('content')
    <div class="fixed inset-0 overflow-hidden bg-gray-50 text-gray-900 dark:bg-slate-950 dark:text-slate-100">
        {{-- Ambient background accents --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute left-[-12%] top-[-16%] h-64 w-64 rounded-full bg-emerald-500/10 blur-3xl"></div>
            <div class="absolute right-[-10%] bottom-[-18%] h-72 w-72 rounded-full bg-indigo-500/15 blur-3xl"></div>
        </div>

        <div class="relative flex min-h-screen items-center justify-center">
            {{-- Wrapper to center the card --}}
            <div
                class="w-full max-w-md rounded-2xl border border-slate-200 bg-white/90 p-6 text-gray-900 shadow-xl backdrop-blur dark:border-slate-800/60 dark:bg-slate-900/60 dark:text-slate-100">
                {{-- Success card --}}
                <div
                    class="rounded-xl border border-slate-200 bg-white shadow-2xl backdrop-blur-sm p-8 dark:border-slate-800/80 dark:bg-slate-900/80">
                    {{-- Success icon --}}
                    <div class="flex justify-center">
                        <div class="rounded-full bg-emerald-500/15 p-3 ring-1 ring-emerald-400/30">
                            <svg viewBox="0 0 24 24" class="h-10 w-10 text-emerald-400" fill="none" stroke="currentColor"
                                stroke-width="3">
                                <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>

                    {{-- Title and short message --}}
                    <div class="mt-6 text-center space-y-3">
                        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Booking Successful!</h1>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Your car rental is confirmed. We'll reach out with the next steps
                            shortly.</p>
                    </div>

                    {{-- Action buttons --}}
                    <div class="mt-6 space-y-5">
                        <a href="{{ route('booking.mine') }}"
                            class="block w-full rounded-2xl bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white shadow-lg transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            View my bookings
                        </a>
                        <a href="{{ route('booking.create') }}"
                            class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-800 transition hover:border-indigo-400 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-800">
                            Make another booking
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
