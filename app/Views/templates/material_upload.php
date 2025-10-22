<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Upload Material</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('admin/course/' . $course_id . '/upload') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="material" class="form-label">Select File</label>
                <input class="form-control" type="file" name="material" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
