<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin • Edit Reservation</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <div class="mx-auto max-w-3xl p-6">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Edit reservation</h1>
      <a href="{{ route('admin.reservations.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">Back</a>
    </div>

    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="grid gap-4 rounded-xl border border-gray-200 bg-white p-6">
      @csrf
      @method('PUT')
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="mb-1 block text-sm font-medium">Status</label>
          <select name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            @foreach (['pending','confirmed','cancelled','completed'] as $s)
              <option value="{{ $s }}" {{ $reservation->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="mb-1 block text-sm font-medium">Total Price ($)</label>
          <input type="number" step="0.01" name="total_price" value="{{ $reservation->total_price }}" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
      </div>
      <div class="rounded-lg bg-gray-50 p-4 text-sm">
        <div><span class="font-semibold">Customer:</span> {{ $reservation->full_name }} ({{ $reservation->email }})</div>
        <div><span class="font-semibold">Car:</span> {{ optional($reservation->car)->name }}</div>
        <div><span class="font-semibold">Pickup:</span> {{ $reservation->pickup_date->format('Y-m-d') }} {{ $reservation->pickup_time }} @ {{ $reservation->pickup_location }}</div>
        <div><span class="font-semibold">Return:</span> {{ $reservation->return_date->format('Y-m-d') }} {{ $reservation->return_time }}</div>
      </div>

      <div class="mt-2">
        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save</button>
      </div>
    </form>
  </div>
</body>
</html>
