<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
        }
        table th, table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Upload Course Material
                <?php if (!empty($course['course_name'])): ?>
                    <span class="text-warning"> - <?= esc($course['course_name']) ?></span>
                <?php endif; ?>
            </h5>
        </div>
        <div class="card-body">

            <!-- ✅ Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- ✅ Upload Form -->
            <form action="<?= site_url('admin/course/' . $course_id . '/upload') ?>" 
                  method="POST" 
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
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload"></i> Upload
                    </button>

                    <a href="<?= previous_url() ?>" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>

                    <a href="<?= base_url('dashboard') ?>" class="btn btn-info text-white">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Uploaded Materials List -->
    <?php if (!empty($materials)): ?>
        <div class="card mt-4 shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0">Uploaded Materials</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>File Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded On</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($materials as $index => $mat): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($mat['file_name']) ?></td>
                                <td><?= esc($mat['uploaded_by']) ?></td>
                                <td><?= esc(date('M d, Y h:i A', strtotime($mat['created_at']))) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('materials/download/' . $mat['id']) ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="<?= base_url('materials/delete/' . $mat['id']) ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this material?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4">No materials uploaded yet for this course.</div>
    <?php endif; ?>
</div>

</body>
</html>
