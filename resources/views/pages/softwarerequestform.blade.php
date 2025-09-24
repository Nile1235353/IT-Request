<!-- Software Request Form -->
<div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200 mb-8">
  <h2 class="text-xl font-semibold text-gray-800 mb-6">Create a New Software Request</h2>
  <form id="software-request-form" action="{{ url('pages/request/softwareStore') }}" method="POST">
     @csrf

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Row 1 -->
      <div>
          <label for="Ticket_ID" class="block text-sm font-medium text-gray-700">Ticket ID</label>
          <input type="text" id="Ticket_ID" name="Ticket_ID" 
                value="TCKT-{{ time() }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <div>
          <label for="Request_Date" class="block text-sm font-medium text-gray-700">Request Date & Time</label>
          <input type="datetime-local" id="Request_Date" name="Request_Date" 
                value="{{ now()->format('Y-m-d\TH:i') }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <div>
          <label for="Requester_Name" class="block text-sm font-medium text-gray-700">Requester</label>
          <input type="text" id="Requester_Name" name="Requester_Name" 
                value="{{ Auth::user()->name }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <!-- Row 2 -->
      <div>
          <label for="Employee_ID" class="block text-sm font-medium text-gray-700">Employee ID</label>
          <input type="text" id="Employee_ID" name="Employee_ID" 
                value="{{ Auth::user()->employee_id }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <div>
          <label for="Requester_Email" class="block text-sm font-medium text-gray-700">Requester Email</label>
          <input type="email" id="Requester_Email" name="Requester_Email" 
                value="{{ Auth::user()->email }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <div>
          <label for="Requester_Phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="tel" id="Requester_Phone" name="Requester_Phone" 
                value="{{ Auth::user()->phone }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <!-- Row 3 -->
      <div>
          <label for="Department" class="block text-sm font-medium text-gray-700">Department</label>
          <input type="text" id="Department" name="Department" 
                value="{{ Auth::user()->department }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 bg-gray-100" readonly>
      </div>

      <div>
        <label for="Location" class="block text-sm font-medium text-gray-700">Location</label>
        <input type="text" id="Location" name="Location" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label for="Priority" class="block text-sm font-medium text-gray-700">Priority</label>
        <select id="Priority" name="Priority" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option value="">Select Priority</option>
          <option>Low</option>
          <option>Medium</option>
          <option>High</option>
          <option>Critical</option>
        </select>
      </div>

      <!-- Row 4 -->
      <div>
        <label for="System" class="block text-sm font-medium text-gray-700">System</label>
        <select id="System" name="System" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option value="">Select System</option>
          <option>RGL Portal</option>
          <option>RGL WMS</option>
          <option>TMS</option>
          <option>Gate</option>
          <option>SAP</option>
          <option>RGL Apps</option>
          <option>Utilities Request</option>
        </select>
      </div>

      <div>
        <label for="Type" class="block text-sm font-medium text-gray-700">Type</label>
        <select id="Type" name="Type" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option value="">Select Type</option>
          <option>System Error</option>
          <option>Request Training</option>
        </select>
      </div>

      <div>
        <label for="Issue_Category" class="block text-sm font-medium text-gray-700">Issue Category</label>
        <select id="Issue_Category" name="Issue_Category" required 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option value="">Select Category</option>
          <option>Bug Fix</option>
          <option>New Feature Request</option>
          <option>Performance Issue</option>
          <option>Access Request</option>
          <option>Software Installation</option>
          <option value="Other">Other</option>
        </select>
        <input type="text" id="Other_Category" name="Other_Category" placeholder="Please specify..." 
              class="mt-2 block w-full rounded-md border-gray-300 shadow-sm p-2 hidden">
      </div>

      <!-- Row 5 -->
      <div>
        <label for="Assignee" class="block text-sm font-medium text-gray-700">Assignee</label>
        <input type="text" id="Assignee" name="Assignee"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label for="Testers" class="block text-sm font-medium text-gray-700">Testers</label>
        <input type="text" id="Testers" name="Testers"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label for="Status" class="block text-sm font-medium text-gray-700">Status</label>
        <select id="Status" name="Status" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option>Open</option>
          <option>Pending</option>
          <option>In Progress</option>
          <option>Done</option>
        </select>
      </div>

      <!-- Row 6 -->
      <div>
        <label for="Launched_Date" class="block text-sm font-medium text-gray-700">Launched Date</label>
        <input type="date" id="Launched_Date" name="Launched_Date" 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label for="Job_Done_Date" class="block text-sm font-medium text-gray-700">Job Done Date</label>
        <input type="date" id="Job_Done_Date" name="Job_Done_Date" 
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

    </div>

    <!-- Full width fields at the bottom -->
    <div class="mt-6 space-y-6">
      <div>
        <label for="Request_Description" class="block text-sm font-medium text-gray-700">Request Description</label>
        <textarea id="Request_Description" name="Request_Description" rows="2" required
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"
              placeholder="e.g., Fix login module bug"></textarea>
      </div>

      <div>
        <label for="Software_Comment" class="block text-sm font-medium text-gray-700">Software Team’s Comment</label>
        <textarea id="Software_Comment" name="Software_Comment" rows="2"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"></textarea>
      </div>

      <div>
        <label for="User_Feedback" class="block text-sm font-medium text-gray-700">User Feedback</label>
        <textarea id="User_Feedback" name="User_Feedback" rows="2"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"></textarea>
      </div>

      <div>
        <label for="Remark" class="block text-sm font-medium text-gray-700">Comment / Remark</label>
        <textarea id="Remark" name="Remark" rows="3"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"></textarea>
      </div>
    </div>

    <!-- Submit -->
    <div class="mt-6">
      <button type="submit" 
        class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
        Add Request
      </button>
    </div>
  </form>
</div>


