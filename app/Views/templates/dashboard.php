<?= $this->extend('templates/header') ?>
<?= $this->section('content') ?>

<div class="dashboard-card">
  <h2 class="dashboard-title">Welcome, <?= esc(session()->get('username')) ?>!</h2>
  <p class="dashboard-subtitle">You are logged in as <span class="fw-semibold"><?= esc(session()->get('role')) ?></span>.</p>
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

<?= $this->endSection() ?>
