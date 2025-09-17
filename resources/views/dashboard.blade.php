@extends('pages.layout')

@section('content')
    <!-- <h2 class="text-2xl font-semibold mb-6">Create a New Service Request</h2> -->

    <!-- <header class="mb-6">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">RGL IT Service Request</h1>
        <p class="text-gray-600 mt-1">Track, add, and update service requests from all departments.</p>
    </header> -->

  <!-- Request Type Dropdown -->
  <select id="request-type" name="request_type" class="border rounded-lg p-2 mb-6">
  <option value="infra" {{ old('request_type', 'infra') == 'infra' ? 'selected' : '' }}>Request to Hardware Team</option>
  <!-- <option value="software" {{ old('request_type') == 'software' ? 'selected' : '' }}>Request to Software Team</option> -->
  <option value="datacenter" {{ old('request_type') == 'datacenter' ? 'selected' : '' }}>Request to Data Center Team</option>
</select>


  <!-- Infra Fields -->
  <div id="infra-fields" class="request-section">
    <!-- <fieldset class="mb-6 p-4 border rounded-lg bg-gray-50">
      <legend class="text-lg font-semibold">Infrastructure Details</legend>
      <label class="block text-gray-700 mb-2">Hardware Needed</label>
      <input type="text" name="hardware" class="w-full border rounded-lg p-2 mb-4">
    </fieldset> -->
    @include('pages.dashboard')
    @include('pages.requestform')
    @include('pages.requestlist')
  </div>

  <!-- Software Fields -->
  <div id="software-fields" class="request-section hidden">
    <!-- <fieldset class="mb-6 p-4 border rounded-lg bg-gray-50">
      <legend class="text-lg font-semibold">Software Details</legend>
      <label class="block text-gray-700 mb-2">Software Name</label>
      <input type="text" name="software_name" class="w-full border rounded-lg p-2 mb-4">

      <label class="block text-gray-700 mb-2">Version</label>
      <input type="text" name="version" class="w-full border rounded-lg p-2 mb-4">
    </fieldset> -->
    @include('pages.softwaredashboard')
    @include('pages.softwarerequestform')
    @include('pages.softwarerequestlist')
  </div>

  <!-- Data Center Fields -->
  <div id="datacenter-fields" class="request-section hidden">
    <!-- <fieldset class="mb-6 p-4 border rounded-lg bg-gray-50">
      <legend class="text-lg font-semibold">Data Center Details</legend>
      <label class="block text-gray-700 mb-2">Server Requirement</label>
      <input type="text" name="server" class="w-full border rounded-lg p-2 mb-4">

      <label class="block text-gray-700 mb-2">Rack Number</label>
      <input type="text" name="rack" class="w-full border rounded-lg p-2 mb-4">
    </fieldset> -->
    @include('pages.datacenterdashboard')
    @include('pages.datacenterrequestform')
    @include('pages.datacenterrequestlist')
  </div>

  <!-- Submit Button -->
  <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
    Submit Request
  </button> -->

  <script>
document.addEventListener('DOMContentLoaded', function () {
  const typeSelect = document.getElementById('request-type');
  const sections = document.querySelectorAll('.request-section');

  function showSection(sectionId) {
    sections.forEach(sec => sec.classList.add('hidden'));
    document.getElementById(sectionId).classList.remove('hidden');
  }

  // Page refresh ဖြစ်လည်း old() value ကိုသုံးပြီး show
  let defaultType = "{{ old('request_type', 'infra') }}";
  if (defaultType === 'infra') showSection('infra-fields');
  else if (defaultType === 'software') showSection('software-fields');
  else if (defaultType === 'datacenter') showSection('datacenter-fields');

  typeSelect.addEventListener('change', function () {
    if (this.value === 'infra') showSection('infra-fields');
    else if (this.value === 'software') showSection('software-fields');
    else if (this.value === 'datacenter') showSection('datacenter-fields');
  });
});
</script>



@endsection
