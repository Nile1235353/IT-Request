<!-- Dashboard -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
  <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-sm font-medium text-gray-500">Today's Requests</h3>
    <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $software_stats['today'] }}</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-sm font-medium text-gray-500">Open</h3>
    <p class="mt-1 text-3xl font-semibold text-blue-600">{{ $software_stats['open'] }}</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-sm font-medium text-gray-500">In Progress</h3>
    <p class="mt-1 text-3xl font-semibold text-amber-600">{{ $software_stats['in progress'] }}</p>
  </div>
  <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-sm font-medium text-gray-500">Completed</h3>
    <p class="mt-1 text-3xl font-semibold text-green-600">{{ $software_stats['completed'] }}</p>
  </div>
</div>