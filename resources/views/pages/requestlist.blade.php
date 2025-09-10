

    <!-- Table -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Current Requests</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Description</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requester Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Logged</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Completed</th>
            </tr>
          </thead>
          <tbody id="requests-table-body" class="bg-white divide-y divide-gray-200">
            <!-- Static rows can go here -->
             @foreach($services as $service)
              <tr>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->id }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Name }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Employee_ID }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Phone }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Department }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Issue_Category }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Request_Description }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Remark }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->created_at }}</td>
                <td class="px-6 py-4 text-sm">
                  <select class="status-select status-Completed">
                    <option selected>Completed</option>
                  </select>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->	updated_at }}</td>
              </tr>
              <!-- Add more rows manually if needed -->
              @endforeach
          </tbody>
        </table>
      </div>
        <div>
            {{ $services->links() }}
        </div>
    </div>

