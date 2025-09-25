<?= $this->include('templates/header') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-3">Welcome, <?= esc(session()->get('username')) ?>!</h2>
        <p class="text-muted">You are logged in as <strong><?= esc(session()->get('role')) ?></strong>.</p>

        <hr>

        <!-- Hard-coded but role-based content -->
        <?php if (session()->get('role') === 'admin'): ?>
            <h4>📌 Admin Panel</h4>
            <ul>
                <li><a href="<?= base_url('users/manage') ?>">Manage Users</a></li>
                <li><a href="<?= base_url('reports') ?>">View Reports</a></li>
            </ul>

        <?php elseif (session()->get('role') === 'teacher'): ?>
            <h4>📌 Teacher Panel</h4>
            <ul>
                <li><a href="<?= base_url('courses/manage') ?>">Manage Courses</a></li>
                <li><a href="<?= base_url('students') ?>">View Students</a></li>
            </ul>

        <?php elseif (session()->get('role') === 'student'): ?>
            <h4>📌 Student Panel</h4>
            <ul>
                <li><a href="<?= base_url('courses/enrolled') ?>">My Courses</a></li>
                <li><a href="<?= base_url('grades') ?>">My Grades</a></li>
            </ul>
        <?php endif; ?>

        <hr>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
    </div>
</div>
<?= $this->endSection() ?>
</body>
</html>