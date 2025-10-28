<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin • Edit Car</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <div class="mx-auto max-w-3xl p-6">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Edit car</h1>
      <a href="{{ route('admin.cars.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Back</a>
    </div>

    <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="grid gap-4 rounded-xl border border-gray-200 bg-white p-6">
      @csrf
      @method('PUT')
      <div>
        <label class="mb-1 block text-sm font-medium">Name</label>
        <input name="name" value="{{ $car->name }}" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-600 focus:outline-none">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="mb-1 block text-sm font-medium">Type</label>
          <select name="type" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            @foreach (['sedan','suv','luxury','ev','van','pickup'] as $t)
              <option value="{{ $t }}" {{ $car->type === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Transmission</label>
          <select name="transmission" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            @foreach (['automatic','manual'] as $t)
              <option value="{{ $t }}" {{ $car->transmission === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="mb-1 block text-sm font-medium">Seats</label>
          <input type="number" name="seats" value="{{ $car->seats }}" min="2" max="9" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Price per day ($)</label>
          <input type="number" step="0.01" name="price_per_day" value="{{ $car->price_per_day }}" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
        <div class="flex items-end gap-2">
          <input type="checkbox" name="is_available" value="1" {{ $car->is_available ? 'checked' : '' }} class="h-4 w-4 align-middle">
          <label class="text-sm">Available</label>
        </div>
      </div>
      <div>
        <label class="mb-1 block text-sm font-medium">Location</label>
        <input name="location" value="{{ $car->location }}" required class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
      </div>
      <div>
        <label class="mb-1 block text-sm font-medium">Image URL</label>
        <input name="image_url" value="{{ $car->image_url }}" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
      </div>

      <div class="mt-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save</button>
      </div>
    </form>
  </div>
</body>
</html>
