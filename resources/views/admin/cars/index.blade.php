<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin • Cars</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <div class="mx-auto max-w-7xl p-6">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Cars</h1>
      <a href="{{ route('admin.cars.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">New car</a>
    </div>

    @if (session('status'))
      <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-800">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
      <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-100 text-xs font-semibold text-gray-600">
          <tr>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Type</th>
            <th class="px-4 py-3">Transm.</th>
            <th class="px-4 py-3">Seats</th>
            <th class="px-4 py-3">Location</th>
            <th class="px-4 py-3">Price/day</th>
            <th class="px-4 py-3">Available</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($cars as $car)
          <tr>
            <td class="px-4 py-3">{{ $car->name }}</td>
            <td class="px-4 py-3 uppercase">{{ $car->type }}</td>
            <td class="px-4 py-3 capitalize">{{ $car->transmission }}</td>
            <td class="px-4 py-3">{{ $car->seats }}</td>
            <td class="px-4 py-3">{{ $car->location }}</td>
            <td class="px-4 py-3">${{ number_format($car->price_per_day, 0) }}</td>
            <td class="px-4 py-3">{!! $car->is_available ? '<span class="rounded bg-green-100 px-2 py-1 text-[11px] text-green-700">Yes</span>' : '<span class="rounded bg-red-100 px-2 py-1 text-[11px] text-red-700">No</span>' !!}</td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.cars.edit', $car) }}" class="rounded bg-gray-100 px-3 py-1 text-xs font-semibold hover:bg-gray-200">Edit</a>
              <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Delete this car?')">
                @csrf
                @method('DELETE')
                <button class="rounded bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 hover:bg-red-200">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4">{{ $cars->links() }}</div>

    <div class="mt-10">
      <a href="{{ route('admin.reservations.index') }}" class="text-sm font-semibold text-indigo-700">Go to Reservations →</a>
    </div>
  </div>
</body>
</html>
