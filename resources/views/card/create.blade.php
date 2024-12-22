<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add New Card</title>

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
      margin-top: auto; /* Pushes the logout link to the bottom */
      margin-bottom: 20px;
      color: white;
      text-align: center;
      padding: 10px;
      background-color: #dc3545;
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
    <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
      aria-expanded="false" aria-controls="sidebarMenu">
      ☰ Menu
    </button>
  </div>

  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <div class="col-md-3 sidebar p-3 collapse d-md-block" id="sidebarMenu">
        <!-- Close Button for mobile view -->
        <button class="close-btn" type="button" onclick="closeSidebar()">×</button>
        <h4 class="text-center fw-bold mt-3">Dashboard</h4>
        <ul class="list-unstyled">
          <li><a href="{{ route('card.index') }}" class="mt-3 fw-bold{{ request()->routeIs('card.index') ? ' active' : '' }}">Cards</a></li>
          <li><a href="{{ route('card.create') }}" class="mt-3 fw-bold{{ request()->routeIs('card.create') ? ' active' : '' }}">Add Card</a></li>
        </ul>
        <a href="#" class="logout-link fw-bold" onclick="document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>

      <!-- Main Content -->
      <div class="col-md-9 p-4">
        <h3 class="text-center fw-bold">Add New Card</h3>

        <!-- Success Message -->
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Card Add Form -->
        <div class="container mt-5">
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

            <button type="submit" class="btn btn-primary">Add Card</button>
          </form>
        </div>

      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Function to close the sidebar on mobile
    function closeSidebar() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.classList.remove('show'); // Removes the 'show' class to hide the sidebar
    }
  </script>

</body>

</html>