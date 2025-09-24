<!-- Current Requests Table -->
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IT Officer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Logged</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Completed</th>
                </tr>
            </thead>
            <tbody id="requests-table-body" class="bg-white divide-y divide-gray-200">
                @foreach($services as $service)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->id }}</td>

                    <!-- Request Description Inline Edit -->
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <span class="description-text">{{ $service->Request_Description }}</span>

                            <form action="{{ route('requests.updateDescription', $service->id) }}" method="POST" class="inline-block hidden description-form w-full">
                                @csrf
                                @method('PUT')
                                <textarea name="Request_Description" class="border rounded px-2 py-1 text-sm w-80 h-20"
                                    onkeydown="if(event.key==='Enter'){this.form.submit(); return false;}">{{ $service->Request_Description }}</textarea>
                            </form>


                            <button type="button" class="btn btn-sm btn-outline-primary edit-des-btn p-0">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                              </svg>
                            </button>
                        </div>
                    </td>

                    <!-- Issue Category Inline Edit -->
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <span class="category-text">{{ $service->Issue_Category }}</span>

                            <form action="{{ route('requests.updateCategory', $service->id) }}" method="POST" class="inline-block hidden category-form w-full">
                                @csrf
                                @method('PUT')
                                <select name="Issue_Category" class="border rounded px-2 py-1 text-sm w-full">
                                    <option value="">Select Category</option>
                                    <optgroup label="Hardware Issues">
                                        <option {{ $service->Issue_Category=='Slow Performance' ? 'selected' : '' }}>Slow Performance</option>
                                        <option {{ $service->Issue_Category=='No Power' ? 'selected' : '' }}>No Power</option>
                                        <option {{ $service->Issue_Category=='Keyboard / Mouse Issues' ? 'selected' : '' }}>Keyboard / Mouse Issues</option>
                                        <option {{ $service->Issue_Category=='Monitor Issues' ? 'selected' : '' }}>Monitor Issues</option>
                                    </optgroup>
                                    <optgroup label="Software Issues">
                                        <option {{ $service->Issue_Category=='Windows Activate' ? 'selected' : '' }}>Windows Activate</option>
                                        <option {{ $service->Issue_Category=='Microsoft Office Activate' ? 'selected' : '' }}>Microsoft Office Activate</option>
                                        <option {{ $service->Issue_Category=='Viber Issues' ? 'selected' : '' }}>Viber Issues</option>
                                        <option {{ $service->Issue_Category=='Web Browser Issues' ? 'selected' : '' }}>Web Browser Issues</option>
                                        <option {{ $service->Issue_Category=='Team Issues' ? 'selected' : '' }}>Team Issues</option>
                                        <option {{ $service->Issue_Category=='Outlook Issues' ? 'selected' : '' }}>Outlook Issues</option>
                                        <option {{ $service->Issue_Category=='Microsoft Office Issues' ? 'selected' : '' }}>Microsoft Office Issues</option>
                                    </optgroup>
                                    <optgroup label="Printer / Scanner">
                                        <option {{ $service->Issue_Category=='Unable to Print / Scan' ? 'selected' : '' }}>Unable to Print / Scan</option>
                                        <option {{ $service->Issue_Category=='Printer / Scanner connection issue' ? 'selected' : '' }}>Printer / Scanner connection issue</option>
                                        <option {{ $service->Issue_Category=='Paper Jam' ? 'selected' : '' }}>Paper Jam</option>
                                        <option {{ $service->Issue_Category=='Toner / Ink Replacement' ? 'selected' : '' }}>Toner / Ink Replacement</option>
                                    </optgroup>
                                    <optgroup label="Internet / WiFi">
                                        <option {{ $service->Issue_Category=='No Internet Connection' ? 'selected' : '' }}>No Internet Connection</option>
                                        <option {{ $service->Issue_Category=='Slow Internet Speed' ? 'selected' : '' }}>Slow Internet Speed</option>
                                        <option {{ $service->Issue_Category=='Unable to Connect to Wi-Fi' ? 'selected' : '' }}>Unable to Connect to Wi-Fi</option>
                                        <option {{ $service->Issue_Category=='Weak Wi-Fi Signal' ? 'selected' : '' }}>Weak Wi-Fi Signal</option>
                                    </optgroup>
                                    <optgroup label="Service Request">
                                        <option {{ $service->Issue_Category=='New Hardware Request' ? 'selected' : '' }}>New Hardware Request</option>
                                        <option {{ $service->Issue_Category=='New Software Installation Request' ? 'selected' : '' }}>New Software Installation Request</option>
                                    </optgroup>
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
                    <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->location }}</td> -->
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <span class="location-text">{{ $service->location }}</span>

                            <form action="{{ route('requests.updateLocation', $service->id) }}" method="POST" class="inline-block hidden location-form w-full">
                                @csrf
                                @method('PUT')
                                <select name="Location" class="border rounded px-2 py-1 text-sm w-full" onchange="this.form.submit()">
                                    <option value="Yangon" {{ $service->location=='Yangon' ? 'selected' : '' }}>Yangon</option>
                                    <option value="Mandalay" {{ $service->location=='Mandalay' ? 'selected' : '' }}>Mandalay</option>
                                </select>
                            </form>

                            <button type="button" class="btn btn-sm btn-outline-primary edit-location-btn p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Employee_ID }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Requester_Phone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->IT_Officer }}</td>
                    <!-- <td class="px-6 py-4 text-sm text-gray-900">{{ $service->Remark }}</td> -->
                    <td class="px-6 py-4 text-sm text-gray-900"  style="width: 50px;overflow: hidden;white-space: wrap;text-overflow: ellipsis;">
                        <div class="flex items-center space-x-2">
                            <span class="comment-text">{{ $service->Remark }}</span>

                            <form action="{{ route('requests.updateRemark', $service->id) }}" method="POST" class="inline-block hidden comment-form w-full">
                                @csrf
                                @method('PUT')
                                <input type="text" name="Remark" value="{{ $service->Remark }}" class="border rounded px-2 py-1 text-sm w-80 h-20"
                                    onkeydown="if(event.key==='Enter'){this.form.submit(); return false;}">
                            </form>

                            <button type="button" class="btn btn-sm btn-outline-primary edit-remark-btn p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->created_at }}</td>

                    <!-- Status dropdown -->
                    <td class="px-6 py-4">
                        <form action="{{ route('requests.updateStatus', $service->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="rounded-md border-gray-300 text-sm px-2 py-1
                                @if($service->status=='Open') bg-blue-100 text-blue-800
                                @elseif($service->status=='In Progress') bg-amber-100 text-amber-800
                                @elseif($service->status=='Completed') bg-green-100 text-green-800
                                @endif"
                                onchange="this.form.submit()">
                                <option value="Open" {{ $service->status=='Open' ? 'selected' : '' }}>Open</option>
                                <option value="In Progress" {{ $service->status=='In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ $service->status=='Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-900">{{ $service->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $services->links() }}
    </div>
</div>


<!-- Inline Edit JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Table Body ကို parent အဖြစ် သတ်မှတ်ပြီး listener တစ်ခုတည်း တပ်ဆင်ပါ
    const tableBody = document.getElementById('requests-table-body');

    if (tableBody) {
        tableBody.addEventListener('click', function(event) {
            
            // --- Request Description Edit ---
            const editBtn = event.target.closest('.edit-des-btn');
            if (editBtn) {
                const td = editBtn.closest('td');
                td.querySelector('.description-text').classList.toggle('hidden');
                const form = td.querySelector('.description-form');
                form.classList.toggle('hidden');
                if (!form.classList.contains('hidden')) form.querySelector('textarea').focus();  // ✅ textarea ကိုပဲ focus
                return;
            }


            // --- Remark/Comment Edit ---
            const editRemarkBtn = event.target.closest('.edit-remark-btn');
            if (editRemarkBtn) {
                const td = editRemarkBtn.closest('td');
                td.querySelector('.comment-text').classList.toggle('hidden');
                const form = td.querySelector('.comment-form');
                form.classList.toggle('hidden');
                if (!form.classList.contains('hidden')) form.querySelector('input').focus();
                return;
            }

            // --- Location Edit ---
            const editLocationBtn = event.target.closest('.edit-location-btn');
            if (editLocationBtn) {
                const td = editLocationBtn.closest('td');
                td.querySelector('.location-text').classList.add('hidden');
                const form = td.querySelector('.location-form');
                form.classList.remove('hidden');
                form.querySelector('select').focus();
                return;
            }

            // --- Category Edit ---
            const editCategoryBtn = event.target.closest('.edit-category-btn');
            if (editCategoryBtn) {
                const container = editCategoryBtn.closest('td');
                container.querySelector('.category-text').classList.add('hidden');
                const form = container.querySelector('.category-form');
                form.classList.remove('hidden');
                form.querySelector('select[name="Issue_Category"]').focus();
            }
        });
        
        // --- Category form's dynamic behavior (change/keydown) ---
        // This part also needs delegation
        tableBody.addEventListener('change', function(event) {
            const select = event.target;
            if (select.name === 'Issue_Category') {
                const form = select.closest('.category-form');
                const otherInput = form.querySelector('input[name="Other_Category"]');
                if (select.value === 'Other') {
                    otherInput.classList.remove('hidden');
                    otherInput.focus();
                } else {
                    otherInput.classList.add('hidden');
                    form.submit();
                }
            }
        });

        tableBody.addEventListener('keydown', function(event) {
            const input = event.target;
            if (input.name === 'Other_Category' && event.key === 'Enter') {
                event.preventDefault();
                const form = input.closest('.category-form');
                if (input.value.trim() !== '') {
                    form.submit();
                } else {
                    alert('Please specify the category.');
                    input.focus();
                }
            }
        });
    }
});
</script>
