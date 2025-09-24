<div class="bg-white p-6 md:p-8 rounded-2xl shadow-md border border-gray-200 mb-8">
  <h2 class="text-xl font-semibold text-gray-800 mb-6">Create a New Service Request</h2>
  <form id="new-request-form" action="{{ url('pages/request/datacenterStore') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div>
        <label for="Requester_Name" class="block text-sm font-medium text-gray-700">Requester Name</label>
        <input type="text" id="Requester_Name" name="Requester_Name" 
               value="{{ Auth::user()->name }}" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" readonly>
      </div>

      <div>
        <label for="Employee_ID" class="block text-sm font-medium text-gray-700">Employee ID No.</label>
        <input type="text" id="Employee_ID" name="Employee_ID" 
               value="{{ Auth::user()->employee_id }}" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" readonly>
      </div>

      <div>
        <label for="Requester_Phone" class="block text-sm font-medium text-gray-700">Requester Phone</label>
        <input type="tel" id="Requester_Phone" name="Requester_Phone" 
            value="{{ Auth::user()->phone }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" readonly>
    </div>

    <div>
        <label for="Department" class="block text-sm font-medium text-gray-700">Department</label>
        <input type="text" id="Department" name="Department" 
            value="{{ Auth::user()->department }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" readonly>
    </div>

    <div>
        <label for="Location" class="block text-sm font-medium text-gray-700">Location</label>
        <input type="text" id="Location" name="Location" 
            value="{{ Auth::user()->location }}" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2" readonly>
    </div>

      <div class="lg:col-span-2">
        <label for="category" class="block text-sm font-medium text-gray-700">Request Category </label>
        <div>
          <select id="category" name="category" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
              <option value="">Select Category</option>
              <option value="Data Center Doc Cancel Request">Data Center Doc Cancel Request</option>
              <option value="Operation Doc Cancel Request">Operation Doc Cancel Request</option>
              <option value="Customer Doc Cancel Request">Customer Doc Cancel Request</option>
              <option value="Print SSCC">Print SSCC</option>
              <!-- <option value="Other">Other</option> -->
          </select>

          <input type="text" id="otherCategoryDiv" name="otherCategoryDiv" placeholder="Please specify..." 
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm p-2 hidden">
        </div>
      </div>

      <div class="md:col-span-2 lg:col-span-3">
        <label for="Request_Description" class="block text-sm font-medium text-gray-700">Request Description</label>
        <input type="text" id="Request_Description" name="Request_Description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2" placeholder="e.g., Fix login page bug">
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
document.addEventListener("DOMContentLoaded", function () {
    const category = document.getElementById("category");
    const otherDiv = document.getElementById("otherCategoryDiv");

    function toggleOtherInput() {
        if (category.value === "Other") {
            otherDiv.style.display = "block";
        } else {
            otherDiv.style.display = "none";
        }
    }

    // First load check
    toggleOtherInput();

    // When user changes
    category.addEventListener("change", toggleOtherInput);
});
</script>
