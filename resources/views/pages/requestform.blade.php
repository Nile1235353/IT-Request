<div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200 mb-8">
  <h2 class="text-xl font-semibold text-gray-800 mb-6 text-left">Create a New Service Request</h2>

  <form id="new-request-form" action="{{ url('pages/request/store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Requester Info -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Requester Name</label>
        <input type="text" name="Requester_Name" value="{{ Auth::user()->name }}" readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Employee ID No.</label>
        <input type="text" name="Employee_ID" value="{{ Auth::user()->employee_id }}" readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Requester Phone</label>
        <input type="tel" name="Requester_Phone" value="{{ Auth::user()->phone }}" readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Department</label>
        <input type="text" name="Department" value="{{ Auth::user()->department }}" readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Location</label>
        <input type="text" name="Location" value="{{ Auth::user()->location }}" readonly
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
      </div>

      <!-- Priority -->
      <!-- <div>
        <label class="block text-sm font-medium text-gray-700">Priority</label>
        <select name="Priority" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
          <option>Low</option>
          <option>Medium</option>
          <option>High</option>
          <option>Urgent</option>
        </select>
      </div> -->

      <!-- Issue Category + Fixed Side by Side -->
      <div class="lg:col-span-3 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Issue Category -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Issue Category</label>
          <select id="Issue_Category" name="Issue_Category" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
            <option value="">Select Category</option>
            <optgroup label="Hardware Issues">
              <option>Slow Performance</option>
              <option>No Power</option>
              <option>Keyboard / Mouse Issues</option>
              <option>Monitor Issues</option>
            </optgroup>
            <optgroup label="Software Issues">
              <option>Windows Activate</option>
              <option>Microsoft Office Activate</option>
              <option>Viber Issues</option>
              <option>Web Browser Issues</option>
              <option>Team Issues</option>
              <option>Outlook Issues</option>
              <option>Microsoft Office Issues</option>
            </optgroup>
            <optgroup label="Printer / Scanner">
              <option>Unable to Print / Scan</option>
              <option>Printer / Scanner connection issue</option>
              <option>Paper Jam</option>
              <option>Toner / Ink Replacement</option>
            </optgroup>
            <optgroup label="Internet / WiFi">
              <option>No Internet Connection</option>
              <option>Slow Internet Speed</option>
              <option>Unable to Connect to Wi-Fi</option>
              <option>Weak Wi-Fi Signal</option>
            </optgroup>
            <optgroup label="Service Request">
              <option>New Hardware Request</option>
              <option>New Software Installation Request</option>
            </optgroup>
            <option value="Other">Other</option>
          </select>

          <input type="text" id="Other_Category" name="Other_Category" placeholder="Please specify..." 
                 class="mt-2 block w-full rounded-md border-gray-300 shadow-sm p-2 hidden">
        </div>

        <!-- Fixed / Not Fixed -->
        <!-- <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Issue Fixed?</label>
          <div class="flex items-center space-x-4">
            <label class="flex items-center space-x-2">
              <input type="radio" name="is_fixed" value="Yes" class="form-radio h-4 w-4 text-indigo-600">
              <span>Yes</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="radio" name="is_fixed" value="No" class="form-radio h-4 w-4 text-indigo-600">
              <span>No</span>
            </label>
          </div>

          <input type="text" id="Fixed_Details" name="Fixed_Details" placeholder="Please describe the fix..." 
                 class="mt-2 block w-full rounded-md border-gray-300 shadow-sm p-2 hidden">
        </div> -->
      </div>

      <!-- Request Description -->
      <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-gray-700">Request Description</label>
        <input type="text" name="Request_Description" required 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" 
               placeholder="e.g., Fix login page bug">
      </div>

      <!-- Remark / Comment -->
      <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-gray-700">Comment / Remark</label>
        <textarea name="Remark" rows="3" required 
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" 
                  placeholder="Add any additional details here..."></textarea>
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

<script>
  // Issue Category "Other"
  const categorySelect = document.getElementById('Issue_Category');
  const otherInput = document.getElementById('Other_Category');

  categorySelect.addEventListener('change', function() {
    if (this.value === 'Other') {
      otherInput.classList.remove('hidden');
      otherInput.required = true;
    } else {
      otherInput.classList.add('hidden');
      otherInput.required = false;
      otherInput.value = '';
    }
  });

  // Fixed / Not Fixed
  const radios = document.querySelectorAll('input[name="is_fixed"]');
  const fixedInput = document.getElementById('Fixed_Details');

  radios.forEach(radio => {
    radio.addEventListener('change', function() {
      if(this.value === 'Yes') {
        fixedInput.classList.remove('hidden');
        fixedInput.required = true;
      } else {
        fixedInput.classList.add('hidden');
        fixedInput.required = false;
        fixedInput.value = '';
      }
    });
  });
</script>
