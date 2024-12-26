<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Sidebar Styles */
        .sidebar {
            min-height: 140vh;
            background-color: #0e5ba8; /* Blue Background */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1050; /* Keep above content */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            font-size: 16px;
            padding: 10px 15px;
            text-decoration: none;
            color: wheat;
            border-radius: 5px;
            margin: 5px 10px;
        }

        .sidebar a:hover {
            background-color: rgb(231, 214, 214);
            color:black;
        }

        .sidebar i {
            font-size: 18px;
            margin-right: 10px;
        }

        .logout {
            margin-top: auto;
        }

        .close-btn {
            display: none;
            font-size: 20px;
            padding: 10px;
            text-align: right;
            cursor: pointer;
            color: #333;
        }

        .content-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Just below the sidebar */
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
                transition: all 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .close-btn {
                display: block;
                position: absolute;
                right: 20px;
                top: 10px;
                cursor: pointer;
            }

            .content-overlay.show {
                display: block;
            }

            .sidebar img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
            }

            .sidebar a {
                font-size: 14px;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none !important; /* Hide the menu button on large screens */
            }

            .sidebar {
                position: relative;
                width: 250px;
                display: block;
            }

            .sidebar img {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
            }

            .sidebar a {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <!-- Menu Toggle Button for Small Screens -->
    <button class="menu-toggle btn btn-light d-md-none">☰</button>

    <!-- Content Overlay -->
    <div class="content-overlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 px-0">
                <div class="sidebar d-md-block">
                    <!-- Close Button -->
                    <div class="close-btn text-end mt-5" id="close-sidebar">×</div>
                    <ul class="list-unstyled text-center">
                        <img src="{{ asset('logo.jpg') }}" alt="logo" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                        <a class="text-muted ms-2" style="font-size: 13px">DASHBOARD</a>

                        <li>
                            <a href="{{ route('dashboard.index') }}" class="fw-bold">
                                <i class="bi bi-house-door"></i>
                                Dashboard
                            </a>
                        </li>
                        <li><a class="text-muted ms-2" style="font-size: 13px">Manage Card</a></li>
                        <li>
                            <a href="{{ route('card.create') }}" class="fw-bold">
                                <i class="bi bi-border-all"></i>
                                Add Card
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('card.index') }}" class="fw-bold">
                                <i class="bi bi-border-all"></i>
                                All Cards
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rate.index') }}" class="fw-bold">
                                <i class="bi bi-tag"></i>
                                Get Rates
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings.index') }}" class="fw-bold">
                                <i class="bi bi-gear"></i>
                                Web Settings
                            </a>
                        </li>
                        <li class="logout">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="margin-right:75px; background: none; border: none; padding: 0; color: inherit; font-size: inherit;" class="text-danger fw-bold mt-3">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>                                                
                    </ul>
                </div>
            </div>

        @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle for Mobile
        const toggleButton = document.querySelector('.menu-toggle');
        const closeSidebarButton = document.querySelector('#close-sidebar');
        const sidebar = document.querySelector('.sidebar');
        const contentOverlay = document.querySelector('.content-overlay');

        // Open Sidebar
        toggleButton.addEventListener('click', () => {
            sidebar.classList.add('show');
            contentOverlay.classList.add('show');
        });

        // Close Sidebar
        closeSidebarButton.addEventListener('click', () => {
            sidebar.classList.remove('show');
            contentOverlay.classList.remove('show');
        });

        // Close Sidebar by clicking on Overlay
        contentOverlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            contentOverlay.classList.remove('show');
        });
    </script>
</body>

</html>
