<!-- Current Software Requests Table -->
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200">
  <h2 class="text-xl font-semibold text-gray-800 mb-4">Current Software Requests</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Ticket ID</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Requester Name</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Email</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Department</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Phone</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Location</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Priority</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">System</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Type</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Issue Category</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Other Category</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Description</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Assignee</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Software Comment</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Testers</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Launched Date</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Job Done Date</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Job Close Date</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">User Feedback</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Remark</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Created At</th>
          <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach($software_services as $service)
        <tr>
          <td class="px-4 py-2">{{ $service->id }}</td>
          <td class="px-4 py-2">{{ $service->requester_name }}</td>
          <td class="px-4 py-2">{{ $service->requester_email }}</td>  
          <td class="px-4 py-2">{{ $service->department }}</td>
          <td class="px-4 py-2">{{ $service->employee_id }}</td>
          <td class="px-4 py-2">{{ $service->requester_phone }}</td>
          <td class="px-4 py-2">{{ $service->location }}</td>
          <td class="px-4 py-2">{{ $service->request_date }}</td>
          <td class="px-4 py-2">{{ $service->in_progress_date }}</td>
          <td class="px-4 py-2">{{ $service->priority }}</td>
          <td class="px-4 py-2">{{ $service->system }}</td>
          <td class="px-4 py-2">{{ $service->type }}</td>
          <td class="px-4 py-2">{{ $service->issue_category }}</td>
          <td class="px-4 py-2">{{ $service->other_category }}</td>
          <td class="px-4 py-2">{{ $service->request_description }}</td>
          <td class="px-4 py-2">{{ $service->assignee }}</td>
          <td class="px-4 py-2">{{ $service->software_comment }}</td>
          <td class="px-4 py-2">{{ $service->testers }}</td>
          <td class="px-4 py-2">{{ $service->launched_date }}</td>
          <td class="px-4 py-2">{{ $service->job_done_date }}</td>
          <td class="px-4 py-2">{{ $service->job_close_date }}</td>
          <td class="px-4 py-2">
            <form action="{{ route('requests.softwareStatus', $service->id) }}" method="POST">
              @csrf
              @method('PUT')
              <select name="status"
                      class="rounded-md border-gray-300 text-sm px-2 py-1
                      @if($service->status == 'Open') bg-blue-100 text-blue-800
                      @elseif($service->status == 'In Progress') bg-amber-100 text-amber-800
                      @elseif($service->status == 'Job Done') bg-green-600 text-white
                      @elseif($service->status == 'Launched') bg-indigo-500 text-white
                      @elseif($service->status == 'Completed') bg-green-100 text-green-800
                      @endif"
                      onchange="handleStatusChange(this, {{ $service->id }})">
                <option value="Open" {{ $service->status == 'Open' ? 'selected' : '' }}>Open</option>
                <option value="In Progress" {{ $service->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Job Done" {{ $service->status == 'Job Done' ? 'selected' : '' }}>Job Done</option>
                <option value="Launched" {{ $service->status == 'Launched' ? 'selected' : '' }}>Launched</option>
                <option value="Completed" {{ $service->status == 'Completed' ? 'selected' : '' }}>Completed</option>
              </select>

            </form>
          </td>
          <td class="px-4 py-2">{{ $service->user_feedback }}</td>
          <td class="px-4 py-2">{{ $service->remark }}</td>
          <td class="px-4 py-2">{{ $service->created_at }}</td>
          <td class="px-4 py-2">{{ $service->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $software_services->links() }}
  </div>
</div>


<!-- Modal -->
<div id="inProgressModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
    <h3 class="text-lg font-semibold mb-4">Set In Progress Details</h3>

    <form id="inProgressForm" method="POST">
      @csrf
      @method('PUT')

      <!-- In Progress Date (readonly, auto today) -->
      <div class="mb-3">
        <label class="block text-sm font-medium">In Progress Date</label>
        <input type="datetime-local" name="in_progress_date" 
               value="{{ now()->format('Y-m-d\TH:i') }}" 
               class="w-full border rounded p-2 bg-gray-100" readonly>
      </div>

      <!-- Assignee (readonly, login user) -->
      <div class="mb-3">
        <label class="block text-sm font-medium">Assignee</label>
        <input type="text" name="assignee" 
               value="{{ auth()->user()->name }}" 
               class="w-full border rounded p-2 bg-gray-100" readonly>
      </div>

      <!-- Priority -->
      <div class="mb-3">
        <label class="block text-sm font-medium">Priority</label>
        <select name="priority" class="w-full border rounded p-2">
          <option value="Low">Low</option>
          <option value="Medium">Medium</option>
          <option value="High">High</option>
        </select>
      </div>

      <!-- Software Team's Comment -->
      <div class="mb-3">
        <label class="block text-sm font-medium">Software Team's Comment</label>
        <textarea name="software_comment" class="w-full border rounded p-2" rows="3"></textarea>
      </div>

      <!-- Hidden field for status -->
      <input type="hidden" name="status" value="In Progress">

      <div class="flex justify-end space-x-2">
        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded">Save</button>
      </div>
    </form>
  </div>
</div>




<script>
function handleStatusChange(select, id) {
  if (select.value === 'In Progress') {
    // open modal
    document.getElementById('inProgressModal').classList.remove('hidden');
    // set form action dynamically
    document.getElementById('inProgressForm').action = '/requests/' + id + '/softwareStatus';
  } else {
    // normal submit for other statuses
    select.form.submit();
  }
}

function closeModal() {
    // modal ကို hide
    document.getElementById('inProgressModal').classList.add('hidden');
    // page refresh
    location.reload();
}
</script>

