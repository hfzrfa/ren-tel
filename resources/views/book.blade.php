@extends('layouts.app')

@section('hide_footer', true)
@section('hide_nav', false)


@section('content')
    <div class="min-h-screen antialiased">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div
                class="w-full max-w-xl rounded-3xl border border-white/40 bg-white/40 p-8 text-black shadow-2xl shadow-black/30 backdrop-blur-2xl">
                <!-- Header -->
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-semibold text-black">Booking Your Car</h1>
                    <p class="mt-1 text-sm text-gray-600">Fill in the details below to reserve your
                        vehicle</p>
                </div>

                @if ($errors->has('booking'))
                    <div
                        class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-500/40 dark:bg-red-500/10 dark:text-red-200">
                        {{ $errors->first('booking') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
                    @csrf

                    <!-- Select car -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-black/80">Select a car <span
                                class="text-red-500">*</span></label>
                        <select name="car_id" id="car_id" required
                            class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60">
                            <option value="">-- Choose car --</option>
                            @foreach ($cars ?? [] as $car)
                                <option value="{{ $car->id }}"
                                    data-price="{{ $car->price_per_day ?? ($car->price ?? 0) }}" @selected(old('car_id') == $car->id)>
                                    {{ $car->name }} (Rp
                                    {{ number_format($car->price_per_day ?? ($car->price ?? 0), 0, ',', '.') }} per day)
                                </option>
                            @endforeach
                        </select>

                        <!-- Price Display -->
                        <div id="price-display"
                            class="hidden mt-2 p-3 rounded-xl bg-slate-100 text-slate-800 border border-slate-200">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600 dark:text-slate-300">Price per day:</span>
                                    <span id="price-value" class="text-base font-semibold text-gray-900 dark:text-white">Rp
                                        0</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600 dark:text-slate-300">Rental duration:</span>
                                    <span id="rental-days" class="text-base font-semibold text-gray-900 dark:text-white">0
                                        days</span>
                                </div>
                                <div class="border-t border-slate-200 pt-2 mt-2 dark:border-slate-700">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-slate-800 dark:text-slate-200">Total
                                            Price:</span>
                                        <span id="total-price"
                                            class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Rp 0</span>
                                    </div>
                                </div>
                                <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                                    Catatan: pemesanan pada hari Sabtu dan Minggu dikenakan tambahan harga 20%.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Pick up -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Pick up date <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="pickup_date" id="pickup_date" required
                                    class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Pick up time <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="time" name="pickup_time" required
                                    class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60">
                            </div>
                        </div>
                    </div>

                    <!-- Return -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Return date <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" name="return_date" id="return_date" required
                                    class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Return time <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="time" name="return_time" required
                                    class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60">
                            </div>
                        </div>
                    </div>

                    <!-- Pickup method -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-black/80">Pickup method</label>
                        <div class="flex flex-wrap gap-3">
                            <label
                                class="peer/self group inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-800 hover:bg-slate-50 cursor-pointer">
                                <input type="radio" name="pickup_method" value="self_pickup"
                                        class="accent-black"
                                    {{ old('pickup_method', 'self_pickup') === 'self_pickup' ? 'checked' : '' }}>
                                <span>Self pickup</span>
                            </label>
                            <label
                                class="peer/del group inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-slate-800 hover:bg-slate-50 cursor-pointer">
                                <input type="radio" name="pickup_method" value="delivery"
                                        class="accent-black"
                                    {{ old('pickup_method') === 'delivery' ? 'checked' : '' }}>
                                <span>Delivery</span>
                            </label>
                        </div>
                    </div>

                    <!-- Delivery address (visible when pickup_method = delivery) -->
                    <div id="delivery-address-field" class="space-y-2 hidden">
                        <label class="text-sm font-medium text-black/80">Delivery address <span
                                class="text-red-500">*</span></label>

                        <!-- GPS Location -->
                        <div class="flex gap-2">
                            <input type="text" id="gps_location" name="gps_location" readonly
                                value="{{ old('gps_location') }}"
                                class="flex-1 rounded-xl border-0 bg-white/70 px-4 py-2.5 text-sm text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60"
                                placeholder="Click GPS button to get location">
                            <button type="button" id="gps_button"
                                class="inline-flex items-center gap-2 rounded-xl bg-black px-4 py-2.5 text-sm font-medium text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white hover:text-black hover:shadow-md focus:outline-none focus:ring-2 focus:ring-black/60">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                GPS
                            </button>
                        </div>

                        <!-- Detail Address -->
                        <textarea id="delivery_address_input" name="delivery_address" rows="2" value="{{ old('delivery_address') }}"
                            class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60"
                            placeholder="Add detailed address (building name, floor, unit number, etc.)">{{ old('delivery_address') }}</textarea>
                    </div>

                    <!-- Contact -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Your full name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required value="{{ auth()->user()->name }}" readonly
                                class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60"
                                placeholder="Nama lengkap">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required value="{{ auth()->user()->email }}" readonly
                                class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-black/80">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                readonly
                                class="w-full rounded-xl border-0 bg-white/70 px-4 py-2.5 text-black ring-1 ring-gray-300 focus:outline-none focus:ring-2 focus:ring-black/60"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-black px-4 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-white hover:text-black hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-black/60">
                            Submit booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Car price display and calculation
        const carSelect = document.getElementById('car_id');
        const priceDisplay = document.getElementById('price-display');
        const priceValue = document.getElementById('price-value');
        const rentalDays = document.getElementById('rental-days');
        const totalPrice = document.getElementById('total-price');
        const pickupDate = document.getElementById('pickup_date');
        const returnDate = document.getElementById('return_date');

        // Lock dates so user cannot choose past dates
        (function configureDateLimits() {
            if (!pickupDate || !returnDate) return;

            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;

            pickupDate.min = todayStr;
            // Default min return date is today as well; we'll update when pickup changes
            returnDate.min = todayStr;

            pickupDate.addEventListener('change', () => {
                if (!pickupDate.value) return;
                // Ensure return date can't be before pickup date
                returnDate.min = pickupDate.value;
                if (returnDate.value && returnDate.value < pickupDate.value) {
                    returnDate.value = pickupDate.value;
                }
            });
        })();

        function calculateTotal() {
            const selectedOption = carSelect.options[carSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price'));
            const pickup = pickupDate.value;
            const returnD = returnDate.value;

            if (price && carSelect.value && pickup && returnD) {
                const pickupDateTime = new Date(pickup);
                const returnDateTime = new Date(returnD);
                const diffTime = Math.abs(returnDateTime - pickupDateTime);
                const rawDiffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const days = Math.max(1, rawDiffDays);

                // Hitung berapa hari weekend (Sabtu/Minggu) untuk kenaikan 20%
                let weekendDays = 0;
                const current = new Date(pickupDateTime.getTime());
                for (let i = 0; i < days; i++) {
                    const day = current.getDay(); // 0 = Minggu, 6 = Sabtu
                    if (day === 0 || day === 6) {
                        weekendDays++;
                    }
                    current.setDate(current.getDate() + 1);
                }

                const weekdayDays = days - weekendDays;
                const weekdayTotal = weekdayDays * price;
                const weekendTotal = weekendDays * price * 1.2; // +20% untuk weekend
                const total = weekdayTotal + weekendTotal;

                const formattedPrice = price.toLocaleString('id-ID');
                const formattedTotal = total.toLocaleString('id-ID');

                priceValue.textContent = `Rp ${formattedPrice}`;
                rentalDays.textContent = `${days} day${days > 1 ? 's' : ''}`;
                totalPrice.textContent = `Rp ${formattedTotal}`;
                priceDisplay.classList.remove('hidden');
            } else if (price && carSelect.value) {
                const formattedPrice = price.toLocaleString('id-ID');
                priceValue.textContent = `Rp ${formattedPrice}`;
                rentalDays.textContent = '0 days';
                totalPrice.textContent = 'Rp 0';
                priceDisplay.classList.remove('hidden');
            } else {
                priceDisplay.classList.add('hidden');
            }
        }

        carSelect?.addEventListener('change', calculateTotal);
        pickupDate?.addEventListener('change', calculateTotal);
        returnDate?.addEventListener('change', calculateTotal);

        // GPS Location
        const gpsButton = document.getElementById('gps_button');
        const gpsLocation = document.getElementById('gps_location');

        gpsButton?.addEventListener('click', () => {
            if (!navigator.geolocation) {
                alert('Geolocation is not supported by your browser');
                return;
            }

            gpsButton.disabled = true;
            gpsButton.innerHTML = '<span class="text-sm">Getting location...</span>';

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    gpsLocation.value = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
                    gpsButton.disabled = false;
                    gpsButton.innerHTML = `
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        GPS
                    `;
                },
                (error) => {
                    alert('Unable to get your location: ' + error.message);
                    gpsButton.disabled = false;
                    gpsButton.innerHTML = `
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        GPS
                    `;
                }
            );
        });

        // Toggle delivery address based on pickup method
        const deliveryField = document.getElementById('delivery-address-field');
        const deliveryAddressInput = document.getElementById('delivery_address_input');

        function refreshDeliveryVisibility() {
            const selected = document.querySelector('input[name="pickup_method"]:checked')?.value;
            if (selected === 'delivery') {
                deliveryField.classList.remove('hidden');
                deliveryAddressInput.setAttribute('required', 'required');
            } else {
                deliveryField.classList.add('hidden');
                deliveryAddressInput.removeAttribute('required');
            }
        }
        document.querySelectorAll('input[name="pickup_method"]').forEach(r => r.addEventListener('change',
            refreshDeliveryVisibility));
        refreshDeliveryVisibility();
    </script>
@endsection
