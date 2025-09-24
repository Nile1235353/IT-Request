@extends('pages.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit User</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name & Phone -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full p-2 border rounded">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required
                    class="w-full p-2 border rounded">
                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Email & Role -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full p-2 border rounded">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Role</label>
                <select name="role" required class="w-full p-2 border rounded">
                    <option value="">Select Role</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Department, Employee ID & Location -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Department</label>
                <select name="department" required class="w-full p-2 border rounded">
                    <option value="">Select Department</option>
                    <option value="AHR" {{ old('department', $user->department) == 'AHR' ? 'selected' : '' }}>AHR</option>
                    <option value="Business Development" {{ old('department', $user->department) == 'Business Development' ? 'selected' : '' }}>Business Development</option>
                    <option value="Sale_Customer_Service" {{ old('department', $user->department) == 'Sale_Customer_Service' ? 'selected' : '' }}>Sale & Customer Service</option>
                    <option value="Data Center" {{ old('department', $user->department) == 'Data Center' ? 'selected' : '' }}>Data Center</option>
                    <option value="Finance" {{ old('department', $user->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="ICD" {{ old('department', $user->department) == 'ICD' ? 'selected' : '' }}>ICD</option>
                    <option value="CCA" {{ old('department', $user->department) == 'CCA' ? 'selected' : '' }}>CCA</option>
                    <option value="IT" {{ old('department', $user->department) == 'IT' ? 'selected' : '' }}>IT & Process</option>
                    <option value="M&E" {{ old('department', $user->department) == 'M&E' ? 'selected' : '' }}>M&E</option>
                    <option value="QEHS" {{ old('department', $user->department) == 'QEHS' ? 'selected' : '' }}>QEHS</option>
                    <option value="Operation" {{ old('department', $user->department) == 'Operation' ? 'selected' : '' }}>Operation</option>
                    <option value="Truck" {{ old('department', $user->department) == 'Truck' ? 'selected' : '' }}>Truck</option>
                    <option value="Yard & Rail" {{ old('department', $user->department) == 'Yard & Rail' ? 'selected' : '' }}>Yard & Rail</option>
                    <option value="Process" {{ old('department', $user->department) == 'Process' ? 'selected' : '' }}>Process</option>
                </select>
                @error('department')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Employee ID</label>
                <input type="text" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" required
                    class="w-full p-2 border rounded">
                @error('employee_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Location</label>
                <select name="location" required class="w-full p-2 border rounded">
                    <option value="">Select Location</option>
                    <option value="Yangon" {{ old('location', $user->location) == 'Yangon' ? 'selected' : '' }}>Yangon</option>
                    <option value="Mandalay" {{ old('location', $user->location) == 'Mandalay' ? 'selected' : '' }}>Mandalay</option>
                </select>
                @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:underline">Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
        </div>
    </form>
</div>
@endsection
