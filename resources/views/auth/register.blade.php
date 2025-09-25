@extends('pages.layout')

@section('content')
<div class="max-w-x6l mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name & Phone -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full p-2 border rounded">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required
                    class="w-full p-2 border rounded">
                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Email & Role -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-2 border rounded">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Role</label>
                <select name="role" required class="w-full p-2 border rounded">
                    <option value="">Select Role</option>
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Department, Employee ID & Location -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <!-- <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Department</label>
                <input type="text" name="department" value="{{ old('department') }}" required
                    class="w-full p-2 border rounded">
                @error('department')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div> -->

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Department</label>
                <select name="department" required class="w-full p-2 border rounded">
                    <option value="">Select Department</option>
                    <option value="AHR" {{ old('department') == 'AHR' ? 'selected' : '' }}>AHR</option>
                    <option value="Business Development" {{ old('department') == 'Business Development' ? 'selected' : '' }}>Business Development</option>
                    <option value="Sale_Customer_Service" {{ old('department') == 'Sale_Customer_Service' ? 'selected' : '' }}>Sale & Customer Service</option>
                    <option value="Data Center" {{ old('department') == 'Data Center' ? 'selected' : '' }}>Data Center</option>
                    <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="ICD" {{ old('department') == 'ICD' ? 'selected' : '' }}>ICD</option>
                    <option value="CCA" {{ old('department') == 'CCA' ? 'selected' : '' }}>CCA</option>
                    <option value="IT" {{ old('department') == 'IT & Process' ? 'selected' : '' }}>IT & Process</option>
                    <option value="M&E" {{ old('department') == 'M&E' ? 'selected' : '' }}>M&E</option>
                    <option value="M&R" {{ old('department') == 'M&R' ? 'selected' : '' }}>M&R</option>
                    <option value="QEHS" {{ old('department') == 'QEHS' ? 'selected' : '' }}>QEHS</option>
                    <option value="Operation" {{ old('department') == 'Operation' ? 'selected' : '' }}>Operation</option>
                    <option value="Truck" {{ old('department') == 'Truck' ? 'selected' : '' }}>Truck</option>
                    <option value="Yard & Rail" {{ old('department') == 'Yard & Rail' ? 'selected' : '' }}>Yard & Rail</option>
                    <option value="Process" {{ old('department') == 'Process' ? 'selected' : '' }}>Process</option>
                </select>
                @error('department')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Employee ID</label>
                <input type="text" name="employee_id" value="{{ old('employee_id') }}" required
                    class="w-full p-2 border rounded">
                @error('employee_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Location</label>
                <select name="location" required class="w-full p-2 border rounded">
                    <option value="">Select Location</option>
                    <option value="Yangon" {{ old('location') == 'Yangon' ? 'selected' : '' }}>Yangon</option>
                    <option value="Mandalay" {{ old('location') == 'Mandalay' ? 'selected' : '' }}>Mandalay</option>
                </select>
                @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Password & Confirm Password -->
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full p-2 border rounded">
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex-1 mb-4">
                <label class="block mb-2 text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full p-2 border rounded">
                @error('password_confirmation')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">Already registered?</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Register</button>
        </div>

    </form>
</div>
@endsection
