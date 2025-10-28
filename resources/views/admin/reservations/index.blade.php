<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin • Reservations</title>
  @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <div class="mx-auto max-w-7xl p-6">
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold">Reservations</h1>
      <a href="{{ route('admin.cars.index') }}" class="text-sm font-semibold text-indigo-700">← Cars</a>
    </div>

    @if (session('status'))
      <div class="mb-4 rounded-lg bg-green-50 p-3 text-sm text-green-800">{{ session('status') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
      <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-100 text-xs font-semibold text-gray-600">
          <tr>
            <th class="px-4 py-3">Customer</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Car</th>
            <th class="px-4 py-3">Pickup</th>
            <th class="px-4 py-3">Return</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($reservations as $r)
          <tr>
            <td class="px-4 py-3">{{ $r->full_name }}</td>
            <td class="px-4 py-3">{{ $r->email }}</td>
            <td class="px-4 py-3">{{ optional($r->car)->name }}</td>
            <td class="px-4 py-3">{{ $r->pickup_date->format('Y-m-d') }} {{ $r->pickup_time }}</td>
            <td class="px-4 py-3">{{ $r->return_date->format('Y-m-d') }} {{ $r->return_time }}</td>
            <td class="px-4 py-3">{{ ucfirst($r->status) }}</td>
            <td class="px-4 py-3 text-right">
              <a href="{{ route('admin.reservations.edit', $r) }}" class="rounded bg-gray-100 px-3 py-1 text-xs font-semibold hover:bg-gray-200">Edit</a>
              <form action="{{ route('admin.reservations.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Delete this reservation?')">
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

    <div class="mt-4">{{ $reservations->links() }}</div>
  </div>
</body>
</html>
