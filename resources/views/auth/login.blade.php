@extends('layouts.app')

@section('title', 'Sign in • Rent-Tel')
@section('hide_footer', true)

@section('content')
    <div
        class="relative min-h-screen">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 12c2.5 0 4-2 5.5-3.5S11.5 5 14 5c2.2 0 3.7 1.1 5 2.4" stroke="#181818" stroke-width="2"
                            stroke-linecap="round" />
                        <path d="M21 12c-2.5 0-4 2-5.5 3.5S12.5 19 10 19c-2.2 0-3.7-1.1-5-2.4" stroke="#181818"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>

                <h1 class="text-center text-2xl font-semibold mb-6 text-black">Sign in to your account</h1>

                <!-- Card -->
				<div class="rounded-3xl border border-white/40 bg-white/40 p-8 shadow-2xl shadow-black/30 backdrop-blur-2xl">
                    @if (session('status'))
                        <div class="mb-4 text-sm text-emerald-400">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div class="space-y-2">
                            <label for="email" class="text-sm text-black/80">Email address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('email') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="you@example.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm text-black/80">Password</label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="••••••••">
                            @error('password')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center gap-2 text-sm text-black/80 select-none">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-400 bg-white text-black focus:ring-black/60">
                                Remember me
                            </label>

                            <a href="{{ Route::has('password.request') ? route('password.request') : '#' }}"
                                class="text-sm text-black/60 hover:text-black">Forgot password?</a>
                        </div>

                        <button type="submit"
                                class="w-full rounded-lg bg-black px-4 py-3 text-sm font-medium text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white hover:text-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black/60">
                                Sign in
                            </button>


                    </form>
                </div>

                <p class="mt-8 text-center text-sm text-black">
                    Not a member?
					<a href="{{ route('register') }}" class="text-black hover:text-blue-500">Create account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
