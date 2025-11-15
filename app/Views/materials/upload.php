<?php include(APPPATH . 'Views/templates/header.php'); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        font-size: 14px; /* overall smaller font */
    }

    .card-header {
        font-size: 1rem; /* smaller header */
    }

    label.form-label {
        font-size: 0.9rem;
    }

    input.form-control {
        font-size: 0.9rem;
    }

    .form-text {
        font-size: 0.8rem;
    }

    table th, table td {
        font-size: 0.85rem;
    }

    .btn {
        font-size: 0.85rem;
    }
</style>

<div class="container mt-5">

    <!-- Upload Form Card -->
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-header card-header-gradient">
            <i class="bi bi-cloud-upload me-2"></i> Upload Course Material
            <?php if (!empty($course['course_name'])): ?>
                <span class="text-warning"> - <?= esc($course['course_name']) ?></span>
            <?php endif; ?>
        </div>

        <div class="card-body">

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success rounded-3"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger rounded-3"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Upload Form -->
           <form action="<?= base_url('admin/course/' . $course_id . '/upload') ?>" 
      method="post" 
      enctype="multipart/form-data">


                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="material_title" class="form-label">Material Title</label>
                    <input type="text" 
                           name="material_title" 
                           id="material_title" 
                           class="form-control form-control-lg" 
                           placeholder="Enter material title" 
                           required>
                </div>

                <div class="mb-3">
                    <label for="material_file" class="form-label">Select Material File(s)</label>
                    <input type="file" 
                           name="material_file[]" 
                           id="material_file" 
                           class="form-control" 
                           multiple 
                           required>
                    <div class="form-text">
                        Allowed: PDF, DOC, PPT, ZIP, RAR, TXT, JPG, PNG, MP4 (Max 10MB each)
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-hover-scale">
                        <i class="bi bi-upload me-1"></i> Upload
                    </button>
                    <a href="<?= previous_url() ?>" class="btn btn-danger btn-hover-scale">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-info text-white btn-hover-scale">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- Uploaded Materials List -->
    <div class="card shadow-sm rounded-4">
        <div class="card-header card-header-gradient">
            <i class="bi bi-folder2-open me-2"></i> Uploaded Materials
        </div>

        <div class="card-body p-0">
            <?php if (!empty($materials)): ?>
                <table class="table table-hover table-striped mb-0">
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
                                    <a href="<?= base_url('materials/download/' . $mat['id']) ?>" 
                                       class="btn btn-sm btn-primary btn-hover-scale me-1">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <a href="<?= base_url('materials/delete/' . $mat['id']) ?>" 
                                       class="btn btn-sm btn-danger btn-hover-scale"
                                       onclick="return confirm('Are you sure you want to delete this material?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info m-3">No materials uploaded yet for this course.</div>
            <?php endif; ?>
        </div>
    </div>

</div>

</body>
</html>
