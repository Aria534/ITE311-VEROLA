<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">📚 Course Materials</h5>
        </div>
        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (!empty($materials)): ?>
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>File Name</th>
                            <th>Date Uploaded</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($materials as $material): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($material['file_name']) ?></td>
                                <td><?= esc(date('M d, Y h:i A', strtotime($material['created_at']))) ?></td>
                                <td>
                                    <a href="<?= site_url('materials/download/' . $material['id']) ?>" 
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No materials uploaded yet for this course.</p>
            <?php endif; ?>

            <a href="<?= previous_url() ?>" class="btn btn-secondary mt-3">Back</a>

        </div>
    </div>
</div>

</body>
</html>
