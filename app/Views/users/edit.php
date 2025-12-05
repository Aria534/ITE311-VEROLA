<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0" style="font-family: Arial, sans-serif;">
            <i class="bi bi-pencil"></i> Edit User
          </h4>
        </div>
        <div class="card-body">
          <!-- Error Messages -->
          <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
              <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                  <li><?= esc($error) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form action="<?= base_url('users/update/' . $user['id']) ?>" method="POST" style="font-family: Arial, sans-serif;">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
              <input type="text" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username']) ? 'is-invalid' : '' ?>" 
                     id="username" 
                     name="username" 
                     value="<?= old('username', $user['username']) ?>" 
                     required>
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['username']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email']) ? 'is-invalid' : '' ?>" 
                     id="email" 
                     name="email" 
                     value="<?= old('email', $user['email']) ?>" 
                     required>
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['email']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">New Password <small class="text-muted">(Leave blank to keep current password)</small></label>
              <input type="password" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password']) ? 'is-invalid' : '' ?>" 
                     id="password" 
                     name="password">
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['password']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="password_confirm" class="form-label">Confirm New Password</label>
              <input type="password" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password_confirm']) ? 'is-invalid' : '' ?>" 
                     id="password_confirm" 
                     name="password_confirm">
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password_confirm'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['password_confirm']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
              <select class="form-select <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['role']) ? 'is-invalid' : '' ?>" 
                      id="role" 
                      name="role" 
                      required>
                <option value="">Select Role</option>
                <option value="student" <?= old('role', $user['role']) === 'student' ? 'selected' : '' ?>>Student</option>
                <option value="teacher" <?= old('role', $user['role']) === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="admin" <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>>Admin</option>
              </select>
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['role'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['role']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="<?= base_url('users') ?>" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Update User
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>

