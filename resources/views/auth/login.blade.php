<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IT-Request Login</title>
  
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      background: url("{{ asset('storage/background-ss.png') }}") no-repeat repeat; /* center fixed */
      background-size: cover;
    }
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }

    .btn-primary {
      background-color: #00559c;
    }

    /* Default: Logo 1 ပေါ်, Logo 2 မပေါ် */
    .logo-1 {
      display: block;
    }
    .logo-2 {
      display: none;
    }

    /* Example: Screen < 992px ဆို Logo 1 ပျောက်, Logo 2 မပေါ်သေး */
    @media (max-width: 1009px) {
      .logo-1 {
        display: none;
      }
      .logo-2 {
        display: none;
      }
    }

    /* Example: Screen < 768px ဆို Logo 2 ကဲပေါ် */
    @media (max-width: 815px) {
      .logo-2 {
        display: block;
      }
    }

    .logo-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap; /* screen သေးရင် အောက်လိုက်တန်းမယ် */
    }

  </style>
</head>
<body>
  <!-- ✅ Logo Container (Left + Right Responsive) -->
  <div class="position-absolute top-0 start-0 end-0 p-3">
    <div class="logo-container">
      <!-- Left Top Logo -->
      <div class="mb-2 mb-md-0">
        <img src="{{ asset('storage/login-left.png') }}" 
             alt="RGL Logo" 
             style="max-width: 150px;">
      </div>

      <!-- Right Top Logo (Logo 1 - Default/PC) -->
      <div class="logo-1">
        <img src="{{ asset('storage/login-right.png') }}" 
             alt="Moving Progress Logo" 
             style="max-width: 180px;">
      </div>

      <!-- Right Top Logo (Logo 2 - Mobile) -->
      <div class="logo-2">
        <img src="{{ asset('storage/moving-later.png') }}" 
             alt="Later Logo" 
             style="max-width: 150px;">
      </div>
    </div>
  </div>

  <div class="login-container">
    <div class="card login-card col-11 col-sm-8 col-md-6 col-lg-4">
      <h3 class="text-center mb-4">IT-Request Login</h3>
      <form method="POST" action="{{ route('login') }}">
          @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter username or email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <div class="text-center">
          <small>
              @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                      {{ __('Forgot your password?') }}
                  </a>
              @endif
          </small>
        </div>
      </form>
    </div>
  </div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
