<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'My Website' ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('/') ?>">My Website</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-1"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/') ?>">
              <i class="bi bi-speedometer2"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/courses') ?>">
              <i class="bi bi-journal-bookmark"></i> Courses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/grades') ?>">
              <i class="bi bi-bar-chart-line"></i> Grades
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/profile') ?>">
              <i class="bi bi-person-circle"></i> Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/about') ?>">
              <i class="bi bi-info-circle"></i> About Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/contact') ?>">
              <i class="bi bi-envelope"></i> Contact
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/settings') ?>">
              <i class="bi bi-gear"></i> Settings
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-4">
      <?= $this->renderSection('content') ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
