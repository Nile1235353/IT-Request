@extends('pages.layout')

@section('content')
    <!-- <h2 class="text-2xl font-semibold mb-6">Create a New Service Request</h2> -->

    <!-- <header class="mb-6">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">RGL IT Service Request</h1>
        <p class="text-gray-600 mt-1">Track, add, and update service requests from all departments.</p>
    </header> -->

  <!-- Request Type Dropdown -->
  <!-- <select id="request-type" name="request_type" class="border rounded-lg p-2 mb-6">
    <option value="user" {{ old('request_type', 'user') == 'user' ? 'selected' : '' }}>Request to Hardware Team</option>
    <option value="management" {{ old('request_type') == 'management' ? 'selected' : '' }}>Request to Data Center Team</option>
</select> -->


  <!--  -->
  <!-- <div id="user-fields" class="request-section">
    <p>This is User Page!</p>
  </div>

  <div id="management-fields" class="request-section">
    <p>This is Management Page !</p>
  </div> -->

  <!-- Submit Button -->
  <!-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
    Submit Request
  </button> -->

 <script>
  document.addEventListener('DOMContentLoaded', function () {
      // --- DEBUGGING: Script စတင်ကြောင်း console မှာပြရန် ---
      console.log('Service Request script started.');

      try {
          const typeSelect = document.getElementById('request-type');
          const sections = document.querySelectorAll('.request-section');
          const storageKey = 'selectedRequestType';

          // HTML element တွေ ရှာတွေ့၊ မတွေ့ စစ်ဆေးရန်
          if (!typeSelect) {
              console.error('Error: Dropdown with id "request-type" not found!');
              return; // dropdown မရှိရင် ဆက်မလုပ်တော့
          }
          if (sections.length === 0) {
              console.error('Error: No elements with class "request-section" found!');
              return; // section တွေမရှိရင် ဆက်မလုပ်တော့
          }

          function showSection(sectionValue) {
              console.log('Trying to show section for value:', sectionValue);
              let found = false;
              sections.forEach(sec => sec.classList.add('hidden'));
              
              const sectionId = sectionValue + '-fields';
              const sectionToShow = document.getElementById(sectionId);
              
              if (sectionToShow) {
                  sectionToShow.classList.remove('hidden');
                  console.log('Successfully shown section with id:', sectionId);
                  found = true;
              }

              if (!found) {
                  console.warn('Warning: Could not find a section with id:', sectionId);
              }
          }

          // 1. Page load ဖြစ်တဲ့အခါ တန်ဖိုးတွေကို စစ်ဆေးမယ်
          const savedType = localStorage.getItem(storageKey);
          const oldType = "{{ old('request_type', '') }}"; // default ကို empty string ထားပါ

          // --- DEBUGGING: console မှာ တန်ဖိုးတွေ ထုတ်ကြည့်ရန် ---
          console.log('Value from localStorage (savedType):', savedType || 'Not set');
          console.log('Value from Laravel old() (oldType):', oldType || 'Not set');

          // 2. ဘယ်တန်ဖိုးကို အသုံးပြုမလဲဆိုတာ ဆုံးဖြတ်မယ်
          let defaultType = oldType || savedType || 'user';
          
          // --- DEBUGGING: ဘယ် default value ကို ရွေးလိုက်လဲ ကြည့်ရန် ---
          console.log('Final defaultType that will be used:', defaultType);

          typeSelect.value = defaultType;
          showSection(defaultType);

          // 3. Dropdown ကို ပြောင်းလိုက်တဲ့အခါ လုပ်ဆောင်ရမယ့် event
          typeSelect.addEventListener('change', function () {
              const selectedValue = this.value;

              // --- DEBUGGING: ရွေးလိုက်တဲ့ value အသစ်ကို ပြရန် ---
              console.log('Dropdown changed. New value:', selectedValue);

              localStorage.setItem(storageKey, selectedValue);
              console.log('Saved to localStorage ->', {key: storageKey, value: selectedValue});
              
              showSection(selectedValue);
          });

      } catch (error) {
          // --- DEBUGGING: မမျှော်လင့်တဲ့ error တစ်ခုခုတက်ရင် ပြရန် ---
          console.error('An unexpected error occurred in the script:', error);
      }
  });
</script>



@endsection
