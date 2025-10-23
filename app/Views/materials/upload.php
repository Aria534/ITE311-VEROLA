<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Upload Course Material</h5>
        </div>
        <div class="card-body">

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Upload Form -->
           <form action="<?= site_url('admin/course/' . $course_id . '/upload') ?>" 
                  method="post" 
                  enctype="multipart/form-data">
                  
                <?= csrf_field() ?>

              <!-- Material Title -->
    <div class="mb-3">
        <label for="material_title" class="form-label">Material Title</label>
        <input type="text" name="material_title" id="material_title" class="form-control" placeholder="Enter material title" required>
    </div>

    <!-- File Upload -->
    <div class="mb-3">
        <label for="material_file" class="form-label">Select Material File</label>
        <input type="file" name="material_file" id="material_file" class="form-control" required>
        <div class="form-text">Allowed: PDF, DOC, PPT, ZIP, RAR, TXT, JPG, PNG, MP4 (max 10MB)</div>
    </div>

    <!-- Buttons -->
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-upload"></i> Upload
        </button>

        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
        </a>

        <a href="<?= previous_url() ?>" class="btn btn-dark">
            <i class="bi bi-x-circle"></i> Cancel
        </a>
    </div>
</form>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
