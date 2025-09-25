<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<div class="dashboard-card">
  <h2 class="dashboard-title">Welcome, <?= esc(session()->get('username')) ?>!</h2>
  <p class="dashboard-subtitle">You are logged in as <span class="fw-semibold"><?= esc(session()->get('role')) ?></span>.</p>
  <hr>

  <?php if (session()->get('role') === 'student'): ?>
    <h5 class="fw-bold mb-3">
      <i class="bi bi-pin-angle-fill text-danger"></i> Student 
    </h5>

    <div class="ms-2 mb-4">
      <a href="<?= base_url('courses/enrolled') ?>" class="panel-link">
        <i class="bi bi-book text-primary"></i> My Schedule
      </a>
      <a href="<?= base_url('grades') ?>" class="panel-link">
        <i class="bi bi-award text-success"></i> My Grades
      </a>
    </div>
  <?php endif; ?>

  <hr>

  <a href="<?= base_url('/logout') ?>" class="btn btn-danger w-100 logout-btn">
    <i class="bi bi-box-arrow-right me-1"></i> Logout
  </a>
</div>

<?= $this->endSection() ?>
