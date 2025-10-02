<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'LMS') ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php if (session()->get('isLoggedIn')): ?>
  <?php if ($role === 'student'): ?>
    <!-- Student Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/dashboard') ?>">Student Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStudent">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarStudent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>"><i class="bi bi-house"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/classes') ?>"><i class="bi bi-journal-text"></i> My Schedule</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/Notification') ?>"><i class="bi bi-bell"></i> Notifications</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php elseif ($role === 'teacher'): ?>
    <!-- Teacher Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/dashboard') ?>">Teacher Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTeacher">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarTeacher">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/courses') ?>"><i class="bi bi-book"></i> Manage Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/students') ?>"><i class="bi bi-people"></i> Student List</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php elseif ($role === 'admin'): ?>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="<?= base_url('/dashboard') ?>">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarAdmin">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/users') ?>"><i class="bi bi-person-gear"></i> Manage Users</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/settings') ?>"><i class="bi bi-gear"></i> System Settings</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif; ?>
<?php endif; ?>

