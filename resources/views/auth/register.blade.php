@extends('layouts.app')

@section('title', 'Create account • Rent-Tel')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create account</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="min-h-screen bg-[#0B1220] text-slate-200 antialiased">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="w-full max-w-md">
                <div class="flex justify-center mb-6">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 12c2.5 0 4-2 5.5-3.5S11.5 5 14 5c2.2 0 3.7 1.1 5 2.4" stroke="#7C8CF8" stroke-width="2"
                            stroke-linecap="round" />
                        <path d="M21 12c-2.5 0-4 2-5.5 3.5S12.5 19 10 19c-2.2 0-3.7-1.1-5-2.4" stroke="#7C8CF8"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>

                <h1 class="text-center text-2xl font-semibold mb-6">Create your account</h1>

                <div class="rounded-2xl border border-slate-800/60 bg-slate-900/60 p-6 shadow-xl backdrop-blur">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div class="space-y-2">
                            <label for="name" class="text-sm text-slate-300">Full name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="w-full rounded-lg border-0 bg-slate-900/80 px-4 py-3 text-slate-100 ring-1 focus:outline-none focus:ring-2 {{ $errors->has('name') ? 'ring-red-500 focus:ring-red-500' : 'ring-slate-800 focus:ring-indigo-500' }}"
                                placeholder="Nama lengkap" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm text-slate-300">Email address</label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full rounded-lg border-0 bg-slate-900/80 px-4 py-3 text-slate-100 ring-1 focus:outline-none focus:ring-2 {{ $errors->has('email') ? 'ring-red-500 focus:ring-red-500' : 'ring-slate-800 focus:ring-indigo-500' }}"
                                placeholder="you@example.com" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="text-sm text-slate-300">Password</label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="w-full rounded-lg border-0 bg-slate-900/80 px-4 py-3 text-slate-100 ring-1 focus:outline-none focus:ring-2 {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-500' : 'ring-slate-800 focus:ring-indigo-500' }}"
                                placeholder="••••••••">
                            @error('password')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm text-slate-300">Confirm password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required
                                class="w-full rounded-lg border-0 bg-slate-900/80 px-4 py-3 text-slate-100 ring-1 focus:outline-none focus:ring-2 {{ $errors->has('password_confirmation') ? 'ring-red-500 focus:ring-red-500' : 'ring-slate-800 focus:ring-indigo-500' }}"
                                placeholder="••••••••">
                            @error('password_confirmation')
                                <p class="text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex items-center gap-2 text-sm text-slate-300">
                            <input type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-slate-700 bg-slate-900 text-indigo-500 focus:ring-indigo-500">
                            I agree to the <a href="{{ Route::has('terms.show') ? route('terms.show') : '#' }}"
                                class="text-indigo-400 hover:text-indigo-300">Terms</a> and
                            <a href="{{ Route::has('policy.show') ? route('policy.show') : '#' }}"
                                class="text-indigo-400 hover:text-indigo-300">Privacy Policy</a>
                        </label>

                        <button type="submit"
                            class="w-full rounded-lg bg-indigo-600 px-4 py-3 text-sm font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            Create account
                        </button>

                        <div class="relative my-5">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-800"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-slate-900/60 px-3 text-sm text-slate-400">Or continue with</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ Route::has('oauth.redirect') ? route('oauth.redirect', ['provider' => 'google']) : '#' }}"
                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-800 bg-slate-900/70 px-4 py-3 text-sm text-slate-200 hover:bg-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="h-5 w-5"
                                    aria-hidden="true">
                                    <path fill="#FFC107"
                                        d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.6-6 8-11.3 8A13 13 0 1 1 37 14.7l5.7-5.7A21 21 0 1 0 24 45c10.5 0 19.5-7.5 19.5-21 0-1.6-.2-2.9-.6-3.5z" />
                                    <path fill="#FF3D00"
                                        d="M6.3 14.7l6.6 4.8A12.9 12.9 0 0 1 24 11c3.1 0 5.9 1.1 8.1 2.9l6.1-6.1A21 21 0 0 0 3 14.7z" />
                                    <path fill="#4CAF50"
                                        d="M24 45c5.2 0 9.9-2 13.4-5.2l-6.2-5.1A12.9 12.9 0 0 1 12.8 29l-6.5 5A21 21 0 0 0 24 45z" />
                                    <path fill="#1976D2"
                                        d="M43.6 20.5H42V20H24v8h11.3c-1 3-3.1 5.6-6.1 7.1l.1.1 6.2 5.1C38.6 38.9 43.5 34 43.5 24c0-1.6-.2-2.9-.6-3.5z" />
                                </svg>
                                Google
                            </a>

                            <a href="{{ Route::has('oauth.redirect') ? route('oauth.redirect', ['provider' => 'github']) : '#' }}"
                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-800 bg-slate-900/70 px-4 py-3 text-sm text-slate-200 hover:bg-slate-900">
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 2C6.48 2 2 6.58 2 12.26c0 4.52 2.87 8.35 6.85 9.7.5.1.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.1-1.5-1.1-1.5-.9-.63.07-.62.07-.62 1 .07 1.52 1.06 1.52 1.06.89 1.55 2.33 1.1 2.9.84.09-.66.35-1.1.64-1.35-2.22-.26-4.56-1.14-4.56-5.08 0-1.12.39-2.04 1.03-2.76-.1-.26-.45-1.3.1-2.72 0 0 .85-.28 2.8 1.05.81-.23 1.68-.35 2.55-.35.87 0 1.74.12 2.55.35 1.95-1.33 2.8-1.05 2.8-1.05.55 1.42.2 2.46.1 2.72.64.72 1.03 1.64 1.03 2.76 0 3.95-2.34 4.82-4.57 5.07.36.32.68.95.68 1.92 0 1.38-.01 2.49-.01 2.83 0 .27.18.59.69.49A10.04 10.04 0 0 0 22 12.26C22 6.58 17.52 2 12 2z" />
                                </svg>
                                GitHub
                            </a>
                        </div>
                    </form>
                </div>

                <p class="mt-8 text-center text-sm text-slate-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300">Sign in</a>
                </p>
            </div>
        </div>
    </body>

    </html>

@endsection
