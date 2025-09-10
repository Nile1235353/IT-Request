<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Entry - Service Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .status-select {
      padding: 0.5rem 0.75rem;
      border-radius: 0.375rem;
      border: 1px solid #d1d5db;
      background-color: #ffffff;
      width: 100%;
    }
    .status-Open { background-color: #f3f4f6; color: #374151; }
    .status-InProgress { background-color: #dbeafe; color: #1e40af; }
    .status-Completed { background-color: #dcfce7; color: #166534; }
  </style>
</head>
<body class="text-gray-800 antialiased  flex items-start justify-center py-10">

  <div class="w-full max-w-6xl px-4">
    <!-- Your container content -->
    <div class="bg-white p-4 md:p-8 rounded-2xl">
        @yield('content')
    </div>
  </div>

</body>
</html>
