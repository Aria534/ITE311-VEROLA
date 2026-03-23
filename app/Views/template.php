<head>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

  <?php if (!session()->get('isLoggedIn')): ?>
<!-- Light Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
  <div class="container-fluid">
<<<<<<< HEAD
    <a class="navbar-brand fw-semibold" href="<?= base_url('/') ?>">Learning Management</a>
=======
    <a class="navbar-brand fw-semibold" href="#">Learning Management</a>
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list fs-1"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/') ?>"><i class="bi bi-speedometer2"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('contact') ?>"><i class="bi bi-person-circle"></i> Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('about') ?>"><i class="bi bi-info-circle"></i> About Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php endif; ?>

<<<<<<< HEAD
  <!-- Bootstrap Bundle JS with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======


  <!-- Bootstrap Bundle JS with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6
