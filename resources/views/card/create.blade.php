<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .sidebar {
      background-color: #007bff;
      color: white;
      min-height: 100vh;
      position: relative;
      display: flex;
      flex-direction: column;
    }

    .sidebar a {
      color: white;
      font-size: 18px;
      padding: 10px 15px;
      display: block;
      text-decoration: none;
      border-radius: 5px;
    }

    .sidebar a:hover {
      background-color: #bbc3d3;
      color: black;
    }

    .sidebar .active {
      background-color: wheat;
      color: black;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      color: white;
      font-size: 20px;
      background: transparent;
      border: none;
      cursor: pointer;
    }

    /* Logout Link */
    .logout-link {
      margin-top: auto;
      margin-bottom: 20px;
      color: white;
      text-align: center;
      padding: 10px;
      border-radius: 5px;
      display: block;
      font-size: 18px;
    }

    .logout-link:hover {
      background-color: #c82333;
      text-decoration: none;
    }

    /* Mobile Sidebar */
    @media (max-width: 768px) {
      .sidebar {
        min-height: auto;
        position: absolute;
        top: 0;
        left: -250px;
        width: 250px;
        transition: all 0.3s ease;
      }

      .sidebar.show {
        left: 0;
      }

      .close-btn {
        display: block;
      }
    }

    @media (min-width: 769px) {
      .close-btn {
        display: none;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar Toggle Button for Mobile -->
  <div class="d-md-none bg-primary text-white p-2">
    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
      ☰ Menu
    </button>
  </div>

  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <div class="col-md-3 sidebar p-3 collapse d-md-block" id="sidebarMenu">
        <button class="close-btn" type="button" onclick="closeSidebar()">×</button>
        <h4 class="text-center fw-bold mt-3">Dashboard</h4>
        <ul class="list-unstyled">
          <span class="ms-3 mt-5 " style="font-size: 13px">Manage card</span>
          <li><a href="{{ route('card.create') }}" class="mt-3 fw-bold {{ request()->routeIs('card.create') ? 'active' : '' }}">Add Card</a></li>
          <li><a href="{{ route('card.index') }}" class="mt-3 fw-bold {{ request()->routeIs('card.index') ? 'active' : '' }}">All Cards</a></li>
          <span class="ms-3 t-3" style="font-size: 13px">options</span>
          <li><a href="{{ route('rate.index') }}" class="mt-3 fw-bold {{ request()->routeIs('rate.index') ? 'active' : '' }}">Get Rates</a></li>
          <li><a href="{{ route('settings.index') }}" class="mt-3 fw-bold {{ request()->routeIs('settings.index') ? 'active' : '' }}">Website Setting</a></li>
        </ul>
        <a href="#" class="logout-link fw-bold" onclick="document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>

      <!-- Main Content -->

      <div class="col-md-9">
        <a href="{{ route('card.index') }}" class="btn btn-primary mt-5 ms-3">Go Back</a>
        <div class="d-flex justify-content-center align-items-center vh-100 ">

          <div class="card shadow-lg w-100 mb-5" style="max-width: 500px;">
            <div class="card-body">
              <h4 class="card-title text-center mb-4 fw-bold">Add New Card</h4>
              <!-- Success Message -->
              @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              
              <!-- Card Add Form -->
              <form action="{{ route('card.store') }}" method="POST">
                @csrf
                
                <!-- Card Number -->
                <div class="mb-3">
                  <label for="card_number" class="form-label">Card Number</label>
                  <input type="text" class="form-control @error('card_number') is-invalid @enderror" id="card_number" name="card_number" value="{{ old('card_number') }}" required>
                  @error('card_number')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- Quantity -->
                <div class="mb-3">
                  <label for="qty" class="form-label">Quantity</label>
                  <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}" required>
                  @error('qty')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <!-- Price -->
                <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary w-100">Add Card</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function closeSidebar() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.classList.remove('show');
    }
  </script>

</body>

</html>
