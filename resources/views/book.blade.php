@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="min-h-screen bg-[#0B1220] text-slate-200 antialiased ">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-xl rounded-[22px] bg-slate-900 text-slate-200 shadow-xl ring-1 ring-slate-700 p-6">
                <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
                    @csrf

                    <!-- Select car -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-200">Select a car <span
                                class="text-red-500">*</span></label>
                        <select name="car_id" required
                            class="w-full rounded-xl border border-slate-300 bg-white text-slate-900 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-slate-600">
                            <option value="">-- Choose car --</option>
                            @foreach ($cars ?? [] as $car)
                                <option value="{{ $car->id }}" @selected(old('car_id') == $car->id)>{{ $car->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pick up -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Pick up date <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="pickup_date" required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 pr-10 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600">
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">📅</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Pick up time <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="time" name="pickup_time" required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 pr-10 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600">
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">🕘</span>
                            </div>
                        </div>
                    </div>

                    <!-- Return -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Return date <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="return_date" required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 pr-10 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600">
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">📅</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Return time <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="time" name="return_time" required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 pr-10 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600">
                                <span
                                    class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">🕘</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pickup method -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-200">Pickup method</label>
                        <div class="flex gap-3">
                            <label
                                class="peer/self group inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-800 hover:bg-slate-50 cursor-pointer">
                                <input type="radio" name="pickup_method" value="self_pickup" class="accent-slate-900" {{ old('pickup_method', 'self_pickup') === 'self_pickup' ? 'checked' : '' }}>
                                <span>Self pickup</span>
                            </label>
                            <label
                                class="peer/del group inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-800 hover:bg-slate-50 cursor-pointer">
                                <input type="radio" name="pickup_method" value="delivery" class="accent-slate-900" {{ old('pickup_method') === 'delivery' ? 'checked' : '' }}>
                                <span>Delivery</span>
                            </label>
                        </div>
                    </div>

                    <!-- Delivery address (visible when pickup_method = delivery) -->
                    <div id="delivery-address-field" class="space-y-2 hidden">
                        <label class="text-sm font-medium text-slate-200">Delivery address <span class="text-red-500">*</span></label>
                        <input type="text" name="delivery_address" value="{{ old('delivery_address') }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600"
                            placeholder="Alamat pengantaran">
                    </div>

                    <!-- Contact -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Your full name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required value="{{ auth()->user()->name }}" readonly
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600"
                                placeholder="Nama lengkap">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required value="{{ auth()->user()->email }}" readonly
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-slate-200">Pickup location <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="pickup_location" required value="{{ old('pickup_location') }}"
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-600"
                                placeholder="Alamat jemput">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-slate-800 px-4 py-3 text-sm font-semibold text-white hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-600">
                            Submit booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
@endsection

@section('scripts')
    <script>
        // Toggle delivery address based on pickup method (tetap sama)
        const deliveryField = document.getElementById('delivery-address-field');

        function refreshDeliveryVisibility() {
            const selected = document.querySelector('input[name="pickup_method"]:checked')?.value;
            if (selected === 'delivery') {
                deliveryField.classList.remove('hidden');
            } else {
                deliveryField.classList.add('hidden');
            }
        }
        document.querySelectorAll('input[name="pickup_method"]').forEach(r => r.addEventListener('change',
            refreshDeliveryVisibility));
        refreshDeliveryVisibility();
    </script>
@endsection
