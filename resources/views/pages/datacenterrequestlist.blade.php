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
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
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
             @foreach($datacenter_services as $service)
              <tr>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->id }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Request_Description }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Issue_Category }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Name }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Department }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Priority }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Employee_ID }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Phone }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Remark }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->created_at }}</td>
                <td>
                  <form action="{{ route('requests.dataCenterStatus', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status"
                            class="rounded-md border-gray-300 text-sm px-2 py-1
                            @if($service->status == 'Open') bg-blue-100 text-blue-800
                            @elseif($service->status == 'In Progress') bg-amber-100 text-amber-800
                            @elseif($service->status == 'Completed') bg-green-100 text-green-800
                            @endif"
                            onchange="this.form.submit()">
                      <option value="Open" {{ $service->status == 'Open' ? 'selected' : '' }}>Open</option>
                      <option value="In Progress" {{ $service->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="Completed" {{ $service->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                  </form>
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