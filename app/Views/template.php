<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Navbar with Icons</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

  <!-- Light Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navigation Sample</a>

      <!-- Custom Toggle Button with Icon -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-1"></i> <!-- Custom icon instead of default hamburger -->
      </button>

      <!-- Navigation Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#"><i class="bi bi-speedometer2"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-journal-bookmark"></i> Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-bar-chart-line"></i> Grades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-person-circle"></i> Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="bi bi-gear"></i> Settings</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Bootstrap Bundle JS with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
