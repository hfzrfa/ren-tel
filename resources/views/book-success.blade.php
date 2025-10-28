@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment successful</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#0B1220] text-slate-200 antialiased">
  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-xl">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-8 shadow-[0_20px_40px_-20px_rgba(0,0,0,0.6)]">
        <!-- Check badge -->
        <div class="mx-auto mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-emerald-600/15">
          <svg viewBox="0 0 24 24" class="h-6 w-6 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <!-- Title -->
        <h1 class="text-center text-xl font-semibold">Payment successful</h1>

        <!-- Copy -->
        <p class="mt-3 text-center text-slate-400">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur amet labore.
        </p>

        <!-- Action -->
        <div class="mt-6">
          <a href="{{ url('/') }}"
             class="block w-full rounded-lg bg-indigo-600 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            Go back to dashboard
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

@endsection
