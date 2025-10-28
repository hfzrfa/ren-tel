<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin • New Car</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <div class="mx-auto max-w-3xl p-6">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">New car</h1>
      <a href="{{ route('admin.cars.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Back</a>
    </div>

    <form action="{{ route('admin.cars.store') }}" method="POST" class="grid gap-4 rounded-xl border border-gray-200 bg-white p-6">
      @csrf
      <div>
        <label class="mb-1 block text-sm font-medium">Name</label>
        <input name="name" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-600 focus:outline-none">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="mb-1 block text-sm font-medium">Type</label>
          <select name="type" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            <option value="sedan">Sedan</option>
            <option value="suv">SUV</option>
            <option value="luxury">Luxury</option>
            <option value="ev">EV</option>
            <option value="van">Van</option>
            <option value="pickup">Pickup</option>
          </select>
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Transmission</label>
          <select name="transmission" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            <option value="automatic">Automatic</option>
            <option value="manual">Manual</option>
          </select>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="mb-1 block text-sm font-medium">Seats</label>
          <input type="number" name="seats" value="5" min="2" max="9" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Price per day ($)</label>
          <input type="number" step="0.01" name="price_per_day" value="50" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Available</label>
          <input type="checkbox" name="is_available" value="1" class="h-4 w-4 align-middle">
        </div>
      </div>
      <div>
        <label class="mb-1 block text-sm font-medium">Location</label>
        <input name="location" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
      </div>
      <div>
        <label class="mb-1 block text-sm font-medium">Image URL</label>
        <input name="image_url" placeholder="https://..." class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
      </div>

      <div class="mt-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Create</button>
      </div>
    </form>
  </div>
</body>
</html>
