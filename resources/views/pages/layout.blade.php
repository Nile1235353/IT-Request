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

    .bg-blue {
      background-color: #00559c;
    }
  </style>
</head>
<body class="text-gray-800 antialiased">

  <nav class="bg-blue text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">

      <div class="flex items-center space-x-6">
        {{-- Logo will be hidden on small screens, shown on medium screens and up --}}
        <a href="{{ url('/dashboard') }}" class="flex-shrink-0 hidden md:block">
          <img class="h-8 w-auto" src="{{ asset('storage/navlogo.png') }}" alt="RGL Logo">
        </a>
        
        <a href="{{ url('/dashboard') }}" class="text-lg font-semibold hover:text-gray-300">
          IT Service Requests
        </a>
      </div>

      <div class="flex items-center">
        @auth
          <div class="relative">
            <button id="user-menu-button" type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white">
              <span class="sr-only">Open user menu</span>
              <div class="flex items-center space-x-2 text-gray-300 hover:text-white">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Account Settings</span>
              </div>
              <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            
            <div id="user-dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
              <div class="px-4 py-2 text-sm text-gray-700 truncate">
                {{ Auth::user()->email }}
              </div>
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

    <div class="flex flex-col items-center mb-6 md:flex-row-reverse md:justify-between md:items-start">
      
      <div class="mb-4 md:mb-0 md:ml-6">
        <img src="{{ asset('storage/contentlogo.png') }}" alt="RGL Logo" class="w-80 h-auto" />
      </div>

      <div class="text-center md:text-left md:flex-grow">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">RGL IT Service Request</h1>
        <p class="text-gray-600 mt-1">Track, add, and update service requests from all departments.</p>
      </div>

    </div>

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

    @if(session('error'))
      <div id="alert-box" 
          class="fixed top-6 right-6 backdrop-blur-md bg-red-500/80 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 border border-red-300/30 animate-fade-in">
          
          <!-- Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" 
              class="h-6 w-6 flex-shrink-0" 
              fill="none" 
              viewBox="0 0 24 24" 
              stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  d="M12 9v2m0 4h.01M12 5c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z"/>
          </svg>

          <!-- Message -->
          <span class="font-medium">{{ session('error') }}</span>
      </div>

      <script>
        // Auto hide after 3 sec
        setTimeout(() => {
          const box = document.getElementById('alert-box');
          if (box) box.style.display = 'none';
        }, 3000);
      </script>

      <style>
        @keyframes fade-in {
          from {opacity:0; transform: translateY(-10px);}
          to {opacity:1; transform: translateY(0);}
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out; }
      </style>
    @endif



    @if(session('error'))
      <div id="alert-box" 
          class="fixed top-6 right-6 backdrop-blur-md bg-red-500/90 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 border border-red-300/30 animate-fade-in">
          
          <!-- Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" 
              class="h-6 w-6 flex-shrink-0" 
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M12 9v2m0 4h.01M12 5c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z"/>
          </svg>

          <!-- Message -->
          <span class="font-medium flex-1">{{ session('error') }}</span>

          <!-- Close button -->
          <button onclick="document.getElementById('alert-box').remove();" 
                  class="text-white hover:text-gray-200 focus:outline-none">
            ✖
          </button>
      </div>

      <style>
        @keyframes fade-in {
          from {opacity:0; transform: translateY(-10px);}
          to {opacity:1; transform: translateY(0);}
        }
        .animate-fade-in { animation: fade-in 0.4s ease-out; }
      </style>
    @endif


    @if(session('success'))
      <div id="alert-box" 
          class="fixed top-6 right-6 backdrop-blur-md bg-green-500/80 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 border border-green-300/30 animate-fade-in">
          <svg xmlns="http://www.w3.org/2000/svg" 
              class="h-6 w-6 flex-shrink-0" 
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M5 13l4 4L19 7"/>
          </svg>
          <span class="font-medium">{{ session('success') }}</span>
      </div>
    @endif

    <script>
      // Auto hide after 3 sec
      setTimeout(() => {
        const box = document.getElementById('alert-box');
        if (box) box.style.display = 'none';
      }, 3000);
    </script>

    <style>
      @keyframes fade-in {
        from {opacity:0; transform: translateY(-10px);}
        to {opacity:1; transform: translateY(0);}
      }
      .animate-fade-in { animation: fade-in 0.4s ease-out; }
    </style>





</body>
</html>
