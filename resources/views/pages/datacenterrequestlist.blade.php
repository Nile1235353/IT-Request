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
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th> -->
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
                <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Request_Description }}</td> -->
                 <!-- Request Description Inline Edit -->
                <td class="px-6 py-4 text-sm text-gray-900">
                    <div class="flex items-center space-x-2">
                        <span class="description-text">{{ $service->Request_Description }}</span>

                        <form action="{{ route('requests.DataCenterUpdateDescription', $service->id) }}" method="POST" class="inline-block hidden description-form w-full">
                            @csrf
                            @method('PUT')
                            <textarea name="Request_Description" class="border rounded px-2 py-1 text-sm w-80 h-20" rows="3"
                                onkeydown="if(event.key==='Enter'){this.form.submit(); return false;}">{{ $service->Request_Description }}</textarea>
                        </form>

                        <button type="button" class="btn btn-sm btn-outline-primary edit-btn p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                </td>

                <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Issue_Category }}</td> -->
                <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <span class="category-text">{{ $service->Issue_Category }}</span>

                            <form action="{{ route('requests.DataCenterUpdateCategory', $service->id) }}" method="POST" class="inline-block hidden category-form w-full">
                                @csrf
                                @method('PUT')
                                <select name="Issue_Category" class="border rounded px-2 py-1 text-sm w-full">
                                    <option value="">Select Category</option>
                                    <option value="datacenterCancel">Data Center Doc Cancel Request</option>
                                    <option value="operationCancel">Operation Doc Cancel Request</option>
                                    <option value="customerCancel">Customer Doc Cancel Request</option>
                                    <option value="printSSCC">Print SSCC</option>
                                    <option value="Other">Other</option>
                                </select>

                                <input type="text" name="Other_Category" placeholder="Please specify..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 hidden">
                            </form>

                            <button type="button" class="btn btn-sm btn-outline-primary edit-category-btn p-0">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                              </svg>
                            </button>
                        </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Name }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Department }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Location }}</td>
                <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Priority }}</td> -->
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Employee_ID }}</td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Phone }}</td>
                <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Remark }}</td> -->
                <td class="px-6 py-4 text-sm text-gray-900" style="width: 50px;overflow: hidden;white-space: wrap;text-overflow: ellipsis;">
                    <div class="flex items-center space-x-2">
                        <span class="remark-text truncate w-full block">{{ $service->Remark }}</span>

                        <form action="{{ route('requests.DataCenterUpdateRemark', $service->id) }}" method="POST" class="inline-block hidden remark-form w-full">
                            @csrf
                            @method('PUT')
                            <textarea name="Remark" class="border rounded px-2 py-1 text-sm w-80 h-20" rows="1"
                                onkeydown="if(event.key==='Enter'){this.form.submit(); return false;}">{{ $service->Remark }}</textarea>
                        </form>

                        <button type="button" class="btn btn-sm btn-outline-primary edit-remark-btn p-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                </td>

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
            {{ $datacenter_services->links() }}
        </div>
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Request Description Inline Edit
        // ...
        document.querySelectorAll('.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const td = btn.closest('td');
                td.querySelector('.description-text').classList.toggle('hidden');
                const form = td.querySelector('.description-form');
                form.classList.toggle('hidden');
                // <input> အစား <textarea> ကို focus လုပ်ပါ
                if (!form.classList.contains('hidden')) form.querySelector('textarea').focus();
            });
        });
        // ...
        document.querySelectorAll('.edit-category-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const container = btn.closest('td');
                const form = container.querySelector('.category-form');
                const select = form.querySelector('select[name="Issue_Category"]');
                const otherInput = form.querySelector('input[name="Other_Category"]');

                container.querySelector('.category-text').classList.add('hidden');
                form.classList.remove('hidden');
                select.focus();

                select.addEventListener('change', function() {
                    if (this.value === 'Other') {
                        otherInput.classList.remove('hidden');
                        otherInput.focus();
                    } else {
                        otherInput.classList.add('hidden');
                        form.submit();
                    }
                });

                otherInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (otherInput.value.trim() !== '') {
                            form.submit();
                        } else {
                            alert('Please specify the category.');
                            otherInput.focus();
                        }
                    }
                });
            });
        });
    });

    // Request Description Inline Edit
    // document.querySelectorAll('.edit-btn').forEach(function(btn) {
    //     btn.addEventListener('click', function() {
    //         const td = btn.closest('td');
    //         td.querySelector('.description-text').classList.toggle('hidden');
    //         const form = td.querySelector('.description-form');
    //         form.classList.toggle('hidden');
    //         if (!form.classList.contains('hidden')) form.querySelector('input').focus();
    //     });
    // });

    // Remark Inline Edit
    document.querySelectorAll('.edit-remark-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const td = btn.closest('td');
            td.querySelector('.remark-text').classList.toggle('hidden');
            const form = td.querySelector('.remark-form');
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) form.querySelector('textarea').focus();
        });
    });
</script>