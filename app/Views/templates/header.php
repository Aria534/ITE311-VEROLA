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

  <style>
    body {
      background-color: #f8f9fa;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #212529;
    }

    .dashboard-card {
      border-radius: 0.75rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
      background: #fff;
      padding: 2rem;
    }

    .dashboard-title {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .dashboard-subtitle {
      color: #6c757d;
      font-size: 0.95rem;
    }

    .panel-link {
      display: flex;
      align-items: center;
      padding: 0.5rem 0;
      text-decoration: none;
      color: #212529;
      transition: color 0.2s ease;
    }

    .panel-link i {
      margin-right: 0.5rem;
    }

    .panel-link:hover {
      color: #0d6efd;
    }

    .logout-btn {
      border-radius: 30px;
      padding: 0.6rem 1.5rem;
      font-weight: 500;
    }
  </style>
</head>
<body>

 <!-- Navbar -->
<?php if (session()->get('role') === 'student'): ?>
  <!-- Student Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">My Website</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStudent">
        <i class="bi bi-list fs-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarStudent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>"><i class="bi bi-house"></i> Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/classes') ?>"><i class="bi bi-journal-text"></i> My Schedule</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/grades') ?>"><i class="bi bi-card-checklist"></i> My Grades</a></li>
          <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

<?php elseif (session()->get('role') === 'teacher'): ?>
  <!-- Teacher Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">Teacher Portal</a>
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

<?php elseif (session()->get('role') === 'admin'): ?>
  <!-- Admin Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="<?= base_url('/') ?>">Admin</a>
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


  <!-- Page Content -->
<div class="container my-5">
  <div class="dashboard-card">
    <h2 class="dashboard-title">Welcome, <?= esc(session()->get('username')) ?>!</h2>
    <p class="dashboard-subtitle">You are logged in as 
      <span class="fw-semibold"><?= esc(session()->get('role')) ?></span>.
    </p>
    <hr>

    <?php if (session()->get('role') === 'student'): ?> 
    <?php elseif (session()->get('role') === 'teacher'): ?>
    <?php elseif (session()->get('role') === 'admin'): ?>
      
    <?php endif; ?>

    <hr>

    <a href="<?= base_url('/logout') ?>" class="btn btn-primary w-100 logout-btn">
  <i class="bi bi-box-arrow-right me-1"></i> Logout
</a>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
