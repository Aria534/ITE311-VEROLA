<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0" style="font-family: Arial, sans-serif;">
            <i class="bi bi-person-plus"></i> Add New User
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

          <form action="<?= base_url('users/store') ?>" method="POST" style="font-family: Arial, sans-serif;">
            <?= csrf_field() ?>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
              <input type="text" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username']) ? 'is-invalid' : '' ?>" 
                     id="username" 
                     name="username" 
                     value="<?= old('username') ?>" 
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
                     value="<?= old('email') ?>" 
                     required>
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['email']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
              <input type="password" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password']) ? 'is-invalid' : '' ?>" 
                     id="password" 
                     name="password" 
                     required>
              <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password'])): ?>
                <div class="invalid-feedback">
                  <?= esc(session()->getFlashdata('errors')['password']) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="password_confirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
              <input type="password" 
                     class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password_confirm']) ? 'is-invalid' : '' ?>" 
                     id="password_confirm" 
                     name="password_confirm" 
                     required>
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
                <option value="student" <?= old('role') === 'student' ? 'selected' : '' ?>>Student</option>
                <option value="teacher" <?= old('role') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
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
                <i class="bi bi-check-circle"></i> Create User
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

