import "./bootstrap";
import "./dock-app.jsx";
import "./benefits-app.jsx";
import "./date-pickers-app.jsx";
import "./theme.js";

// Dynamic cars fetching for search + periodic refresh (simple real-time)
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("searchForm");
    const grid = document.getElementById("carsGrid");
    if (!form || !grid) return;

    const endpoint = (params) => `/api/cars?${params.toString()}`;
    const formatIDR = (amount) =>
        new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(amount || 0);

    function cardTemplate(car) {
        const image = car.image_path
            ? `/storage/${car.image_path}`
            : car.image_url ||
              "https://images.unsplash.com/photo-1549924231-f129b911e442?q=80&w=1200&auto=format&fit=crop";
        const transmission = car.transmission || "automatic";
        const seats = car.seats || 5;
        const location = car.location || "";
        const price = car.price_per_day ?? 0;
        const name = car.name;

        return `
			<div class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
				<div class="relative aspect-4/3 overflow-hidden">
					<img src="${image}" alt="${name}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
					<div class="pointer-events-none absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
				</div>
				<div class="p-4">
					<div class="flex items-start justify-between gap-3">
						<div>
							<h3 class="text-base font-semibold leading-6">${name}</h3>
							<p class="mt-0.5 text-xs text-gray-500">${(car.type || "").toUpperCase()} • ${
            transmission.charAt(0).toUpperCase() + transmission.slice(1)
        }</p>
						</div>
                        <div class="text-right">
                            <div class="text-lg font-bold">${formatIDR(
                                price
                            )}<span class="text-sm font-medium text-gray-500">/day</span></div>
                        </div>
					</div>
					<div class="mt-3 flex flex-wrap items-center gap-2 text-[11px] text-gray-600 dark:text-gray-300">
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13v-2a8 8 0 1 0-16 0v2"/><path d="M2 13h20"/><path d="M6 17h.01"/><path d="M10 17h.01"/><path d="M14 17h.01"/><path d="M18 17h.01"/></svg>
							AC
						</span>
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5-5 5 5"/><path d="M12 19V7"/></svg>
							${transmission.charAt(0).toUpperCase() + transmission.slice(1)}
						</span>
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 7h20M2 17h20M4 7l2 10m12-10l2 10M6 11h12"/></svg>
							${seats} seats
						</span>
					</div>
					<div class="mt-4 flex items-center justify-between">
						<span class="text-[11px] text-gray-500">${location}</span>
						<button class="rounded-lg bg-gray-900 px-3 py-2 text-xs font-semibold text-white hover:bg-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700">Reserve</button>
					</div>
				</div>
			</div>
		`;
    }

    async function loadCars(params) {
        try {
            const url = endpoint(params);
            const res = await fetch(url, {
                headers: { Accept: "application/json" },
            });
            const data = await res.json();
            const cars = data?.data || data;
            if (!Array.isArray(cars)) return;
            grid.innerHTML = cars.map(cardTemplate).join("");
            // Append empty state if none
            if (cars.length === 0) {
                grid.innerHTML = `<div class="sm:col-span-2 lg:col-span-3"><div class="rounded-xl border border-gray-200 bg-white p-6 text-center text-sm text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">No cars found. Try adjusting filters.</div></div>`;
            }
        } catch (e) {
            // Soft fail: keep current content
            console.error("Failed to load cars", e);
        }
    }

    function getParams() {
        const fd = new FormData(form);
        const p = new URLSearchParams();
        for (const [k, v] of fd.entries()) {
            if (v) p.append(k, v.toString());
        }
        return p;
    }

    // Intercept form submit → fetch JSON and render cards
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const params = getParams();
        loadCars(params);
        // Push state so URL reflects filters
        const url = `${form.action}?${params.toString()}`;
        window.history.replaceState({}, "", url);
    });

    // Periodic refresh (15s) for simple real-time updates from admin changes
    setInterval(() => loadCars(getParams()), 15000);
});
