<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="font-family: Arial, sans-serif;">Manage Users</h2>
    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add New User
    </a>
  </div>

  <!-- Success/Error Messages -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <!-- Users Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <?php if (!empty($users)): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle" style="font-family: Arial, sans-serif;">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Enrollment Time</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= esc($user['id']) ?></td>
                  <td><?= esc($user['username']) ?></td>
                  <td><?= esc($user['email']) ?></td>
                  <td>
                    <?php
                    $roleColors = [
                      'admin' => 'danger',
                      'teacher' => 'primary',
                      'student' => 'success'
                    ];
                    $color = $roleColors[$user['role']] ?? 'secondary';
                    ?>
                    <span class="badge bg-<?= $color ?>"><?= esc(ucfirst($user['role'])) ?></span>
                  </td>
                  <td>
                    <?php
                    $statusColors = [
                      'active' => 'success',
                      'inactive' => 'secondary'
                    ];
                    $statusColor = $statusColors[$user['status']] ?? 'secondary';
                    ?>
                    <span class="badge bg-<?= $statusColor ?>"><?= esc(ucfirst($user['status'])) ?></span>
                  </td>
                  <td>
                    <?php if (!empty($user['latest_enrollment_date'])): ?>
                      <?= esc(date('M d, Y H:i', strtotime($user['latest_enrollment_date']))) ?>
                    <?php else: ?>
                      <span class="text-muted">Not enrolled</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="<?= base_url('users/edit/' . $user['id']) ?>" 
                         class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i> Edit
                      </a>
                      <?php if ($user['id'] != session()->get('user_id')): ?>
                        <a href="<?= base_url('users/delete/' . $user['id']) ?>" 
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Are you sure you want to delete this user?');">
                          <i class="bi bi-trash"></i> Delete
                        </a>
                      <?php else: ?>
                        <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete your own account">
                          <i class="bi bi-trash"></i> Delete
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-center py-5">
          <i class="bi bi-people fs-1 text-muted"></i>
          <p class="text-muted mt-3">No users found.</p>
          <a href="<?= base_url('users/create') ?>" class="btn btn-primary mt-2">
            <i class="bi bi-plus-circle"></i> Create First User
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

</body>
</html>

