<!DOCTYPE html>
<html lang="en">

<head>
  <title>Card Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

    .logout-link {
      margin-top: auto; /* Pushes logout link to the bottom */
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

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
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
        <!-- Close Button visible on mobile -->
        <button class="close-btn" type="button" onclick="closeSidebar()">
          &times;
        </button>
        <h4 class="text-center fw-bold mt-3">KB Card</h4>
        <ul class="list-unstyled">
            <li><a href="{{ route('dashboard.index') }}" class="mt-3 fw-bold {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('card.create') }}" class="mt-3 fw-bold {{ request()->routeIs('card.create') ? 'active' : '' }}">Add Card</a></li>
            <li><a href="{{ route('card.index') }}" class="mt-3 fw-bold {{ request()->routeIs('card.index') ? 'active' : '' }}">All Cards</a></li>
            <li><a href="{{ route('rate.index') }}" class="mt-3 fw-bold {{ request()->routeIs('rate.index') ? 'active' : '' }}">Get Rates</a></li>
            <li><a href="{{ route('settings.index') }}" class="mt-3 fw-bold {{ request()->routeIs('settings.index') ? 'active' : '' }}">Website Setting</a></li>
          </ul>
         <a href="#" class="logout-link fw-bold" onclick="document.getElementById('logout-form').submit();">Logout</a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
         </form>
      </div>

      <!-- Main Content -->
      <div class="col-md-9 p-4">
          <div class="d-flex justify-content-between mt-3">
            <h3 class="fw-bold">Discount Setting</h3>
            <a href="{{ route('settings.create') }}" class="btn btn-primary mt-3 me-4">Add New Setting</a>
          </div>
            <table class="table table-borderd mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $setting->key }}</td>
                        <td>{{ $setting->value }}%</td>
                        <td>
                            <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $settings->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // JavaScript to close the sidebar on mobile when close button is clicked
    function closeSidebar() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.classList.remove('show'); // Removes the 'show' class to hide the sidebar
    }
  </script>
</body>

</html>
