<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Learning Material</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex align-items-center">
      <h4 class="mb-0 fw-bold">
        📂 Upload Learning Material
      </h4>
    </div>

    <div class="card-body">
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mt-2">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mt-2">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('admin/course/' . $course_id . '/upload') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3 mt-3">
          <label for="title" class="form-label fw-semibold">Material Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter material title" value="<?= esc($course_name ?? '') ?>" required>
        </div>

        <div class="mb-3">
          <label for="material" class="form-label fw-semibold">Select File</label>
          <input class="form-control" type="file" name="material" id="material" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
          <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
          </a>
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-upload"></i> Upload Material
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
