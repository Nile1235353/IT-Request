<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT - Service Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="text-gray-800 antialiased">

  <!-- 🔹 Navbar -->
  <nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">

        <!-- Left Side -->
        <div class="flex items-center space-x-6">
          <a href="{{ url('/dashboard') }}" class="text-lg font-semibold hover:text-gray-300">
            IT Service Requests
          </a>
          <!-- <a href="{{ url('/register') }}" class="hover:text-gray-300">Register</a> -->
        </div>

        <!-- Right Side with Account Dropdown -->
        <div class="flex items-center">
          @auth
            <div class="relative">
              <button id="user-menu-button" type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span class="sr-only">Open user menu</span>
                <div class="flex items-center space-x-2 text-gray-300 hover:text-white">
                  <!-- Account icon -->
                  <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  <span>Account Settings</span>
                </div>
                <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <!-- Dropdown menu -->
              <div id="user-dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                <div class="px-4 py-2 text-sm text-gray-700 truncate">
                  {{ Auth::user()->email }}
                </div>
                <!-- <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Profile
                </a> -->
                <!-- <a href="{{ url('/settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Setting
                </a> -->
                <a href="{{ url('/register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Register
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                    Logout
                  </button>
                </form>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-md text-sm">
              Login
            </a>
          @endauth
        </div>

      </div>
    </div>
  </nav>

  <!-- Page Container -->
  <div class="w-full max-w-6xl px-4 mx-auto py-8">
    <div class="bg-white p-4 md:p-8 rounded-2xl">
      @yield('content')
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userMenuButton = document.getElementById('user-menu-button');
      const userDropdownMenu = document.getElementById('user-dropdown-menu');
      
      userMenuButton.addEventListener('click', function() {
        userDropdownMenu.classList.toggle('hidden');
      });

      // Close the dropdown if the user clicks outside of it
      document.addEventListener('click', function(event) {
        if (!userMenuButton.contains(event.target) && !userDropdownMenu.contains(event.target)) {
          userDropdownMenu.classList.add('hidden');
        }
      });
    });
  </script>

</body>
</html>
