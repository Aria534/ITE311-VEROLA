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
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">My Website</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list fs-1"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          
          <!-- Always visible -->
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/') ?>">
              <i class="bi bi-speedometer2"></i> Home
            </a>
          </li>
          
          <!-- Show only when user is NOT logged in -->
          <?php if (!session()->get('isLoggedIn')): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/about') ?>">
                <i class="bi bi-info-circle"></i> About 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/contact') ?>">
                <i class="bi bi-envelope"></i> Contact
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/login') ?>">
                <i class="bi bi-box-arrow-in-right"></i> Login
              </a>
            </li>
          <?php else: ?>
            
            <!-- Role-specific links -->
            <?php if (session()->get('role') === 'admin'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/users') ?>">
                  <i class="bi bi-people"></i> Manage Users
                </a>
              </li>
            <?php elseif (session()->get('role') === 'teacher'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/classes') ?>">
                  <i class="bi bi-journal-text"></i> My Classes
                </a>
              </li>
            <?php elseif (session()->get('role') === 'student'): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/courses') ?>">
                  <i class="bi bi-book"></i> My Courses
                </a>
              </li>
            <?php endif; ?>

            <!-- Common link for logged-in users -->
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('/dashboard') ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="<?= base_url('/logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
            </li>
          <?php endif; ?>

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

