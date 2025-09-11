
    <!-- Form -->
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200 mb-8">
      <h2 class="text-xl font-semibold text-gray-800 mb-6">Create a New Service Request</h2>
      <form id="new-request-form" action="{{ url('pages/request/store') }}" method="POST">
         @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div>
            <label for="requester-name" class="block text-sm font-medium text-gray-700">Requester Name</label>
            <input type="text" id="Requester_Name" name="Requester_Name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="John Doe">
          </div>
          <div>
            <label for="employee-id" class="block text-sm font-medium text-gray-700">Employee ID No.</label>
            <input type="text" id="Employee_ID" name="Employee_ID" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="EMP12345">
          </div>
          <div>
            <label for="requester-phone" class="block text-sm font-medium text-gray-700">Requester Phone</label>
            <input type="tel" id="Requester_Phone" name="Requester_Phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="09-xxxxxxxxx">
          </div>
          <div>
            <label for="Department" class="block text-sm font-medium text-gray-700">Department</label>
            <select id="Department" name="Department" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
              <option value="">Select Department</option>
              <option>Customer Service</option>
              <option>Data Center</option>
              <option>IT & Process</option>
              <option>QEHS</option>
              <option>HR</option>
              <option>Finance</option>
              <option>CCA</option>
              <option>Warehouse</option>
              <option>ICD</option>
              <option>M & E</option>
              <option>M & R</option>
              <option>Yard & Rail</option>
            </select>
          </div>
          <!-- <div class="lg:col-span-2">
            <label for="Issue_Category" class="block text-sm font-medium text-gray-700">Issue Category</label>
            <select id="Issue_Category" name="Issue_Category" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
              <option value="">Select Category</option>
              <option>Bug Fix</option>
              <option>New Feature Request</option>
              <option>Data Report</option>
              <option>Hardware Support</option>
              <option>Software Installation</option>
              <option>Access Request</option>
            </select>
          </div> -->

          <div class="lg:col-span-2">
            <label for="Issue_Category" class="block text-sm font-medium text-gray-700">Issue Category</label>
            <select id="Issue_Category" name="Issue_Category" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
              <option value="">Select Category</option>
              <option>Bug Fix</option>
              <option>New Feature Request</option>
              <option>Data Report</option>
              <option>Hardware Support</option>
              <option>Software Installation</option>
              <option>Access Request</option>
              <option value="Other">Other</option>
            </select>

            <!-- Hidden text input for "Other" -->
            <input type="text" id="Other_Category" name="Other_Category" placeholder="Please specify..." 
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 hidden">
          </div>

          
          <div class="md:col-span-2 lg:col-span-3">
            <label for="Request_Description" class="block text-sm font-medium text-gray-700">Request Description</label>
            <input type="text" id="Request_Description" name="Request_Description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="e.g., Fix login page bug">
          </div>
          <div class="md:col-span-2 lg:col-span-3">
            <label for="Remark" class="block text-sm font-medium text-gray-700">Comment / Remark</label>
            <textarea id="Remark" name="Remark" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="Add any additional details here..."></textarea>
          </div>
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
            Add Request
          </button>
        </div>
      </form>
    </div>



    <script>
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
    </script>

