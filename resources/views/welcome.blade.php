<!DOCTYPE html>
<html lang="en">
<head>
  <title>KB Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1 class="fw-bold">KB Card</h1>
</div>
  
@if (Route::has('login'))
<nav class="-mx-3 flex flex-1 justify-end">
    @auth
        <a
            href="{{ url('/card') }}"
            class="btn btn-primary text-white mt-5 ms-5"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="btn btn-primary  btn-md text-white mt-5 ms-5"
        >
            Log in
        </a>
    @endauth
</nav>
@endif

</body>
</html>
