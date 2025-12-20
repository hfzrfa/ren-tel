@section('hide_footer', true)

@extends('layouts.app')

@section('title', 'Create account Г?Ы Rent-Tel')

@section('content')
    <div class="relative min-h-screen">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-md">
                <div class="mb-6 flex justify-center">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 12c2.5 0 4-2 5.5-3.5S11.5 5 14 5c2.2 0 3.7 1.1 5 2.4" stroke="#181818" stroke-width="2"
                            stroke-linecap="round" />
                        <path d="M21 12c-2.5 0-4 2-5.5 3.5S12.5 19 10 19c-2.2 0-3.7-1.1-5-2.4" stroke="#181818"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>

                <h1 class="mb-6 text-center text-2xl font-semibold text-black">Create your account</h1>

                <div
                    class="rounded-3xl border border-white/40 bg-white/40 p-8 text-black shadow-2xl shadow-black/30 backdrop-blur-2xl">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div class="space-y-2">
                            <label for="name" class="text-sm text-black/80">Full name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('name') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="Your Name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm text-black/80">Email address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('email') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="you@example.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="text-sm text-black/80">Phone number</label>
                            <input id="phone" name="phone" type="text" autocomplete="tel" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('phone') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="Your Phone Number" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm text-black/80">Password</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="********">
                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm text-black/80">Confirm
                                password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required
                                class="w-full rounded-lg border-0 bg-white/70 px-4 py-3 text-black ring-1 focus:outline-none focus:ring-2 {{ $errors->has('password_confirmation') ? 'ring-red-500 focus:ring-red-500' : 'ring-gray-300 focus:ring-black/60' }}"
                                placeholder="********">
                            @error('password_confirmation')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-2 text-sm text-black/80">
                            <input type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-gray-400 bg-white text-black focus:ring-black/60">
                            I agree to the
                            <a href="{{ Route::has('terms.show') ? route('terms.show') : (Route::has('policy.show') ? route('policy.show') : '#') }}"
                                class="underline hover:text-black">Terms & Privacy Policy</a>
                        </label>

                        <button type="submit"
                            class="w-full rounded-lg bg-black px-4 py-3 text-sm font-medium text-white hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-black/60">
                            Create account
                        </button>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Already have an account?
					<a href="{{ route('login') }}" class="text-black hover:text-blue-500">Sign
						in</a>
                </p>
            </div>
        </div>
    </div>
@endsection
