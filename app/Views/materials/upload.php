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
            <h4 class="mb-0">📂 Upload Learning Material</h4>
        </div>
        <div class="card-body">

            <!-- Success or error messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Upload Form -->
            <form action="<?= base_url('materials/upload') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="title" class="form-label">Material Title</label>
                    <input type="text" class="form-control" id="title" name="title" required placeholder="Enter material title">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Choose File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="<?= base_url('materials') ?>" class="btn btn-outline-secondary">← Back to Materials</a>
    </div>
</div>
</body>
</html>
