<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="card p-4 shadow-lg border-0 rounded-4">

    <!-- Header -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Welcome, <?= esc($name ?? $username ?? 'User') ?>!</h2>
      <p class="text-muted">
        You are logged in as 
        <span class="fw-semibold text-primary"><?= esc($role ?? 'guest') ?></span>.
      </p>
    </div>

    <!-- Alert placeholder -->
    <div id="alertPlaceholder"></div>

    <!-- ================= STUDENT DASHBOARD ================= -->
    <?php if (($role ?? '') === 'student'): ?>
      <div class="row g-4">

        <!-- My Grades -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
              <i class="bi bi-journal-check fs-1 text-primary mb-3"></i>
              <h5 class="card-title fw-semibold">My Grades</h5>
              <p class="text-muted small mb-3">View your grades for completed courses.</p>
              <a href="<?= site_url('student/grades') ?>" class="btn btn-outline-primary btn-sm">View Grades</a>
            </div>
          </div>
        </div>

        <!-- Assignments -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
              <i class="bi bi-file-earmark-text fs-1 text-warning mb-3"></i>
              <h5 class="card-title fw-semibold">Assignments</h5>
              <p class="text-muted small mb-3">Check your upcoming assignments.</p>
              <a href="<?= site_url('student/assignments') ?>" class="btn btn-outline-warning btn-sm">View</a>
            </div>
          </div>
        </div>

        <!-- Calendar -->
        <div class="col-md-3 mb-4">
          <div class="card text-center shadow-sm border-0 h-100">
            <div class="card-body">
              <i class="bi bi-calendar3 fs-1 text-success mb-3"></i>
              <h5 class="card-title fw-semibold">Calendar</h5>
              <p class="text-muted small mb-3">See your schedule and important dates.</p>
              <a href="<?= site_url('student/calendar') ?>" class="btn btn-outline-success btn-sm">Open</a>
            </div>
          </div>
        </div>

        <div class="col-md-3">
    <div class="card text-center border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary"><i class="bi bi-file-earmark-text"></i> Materials</h5>
            <p class="card-text">View uploaded learning materials.</p>
            <a href="<?= base_url('materials') ?>" class="btn btn-primary">View</a>
        </div>
    </div>
</div>


      <!-- Enrolled Courses -->
      <div class="mt-5">
        <h4 class="fw-bold mb-3">Enrolled Courses</h4>
        <ul id="enrolledList" class="list-group">
          <?php if (!empty($enrolledCourses ?? [])): ?>
            <?php foreach ($enrolledCourses as $ec): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= esc($ec['course_name']) ?>
                <span class="badge bg-primary rounded-pill">Enrolled</span>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-center text-muted py-4">
              <i class="bi bi-book fs-2 d-block mb-2 text-secondary"></i>
              You haven't enrolled in any courses yet.<br>
              <span class="text-primary fw-semibold">Start by choosing from the available courses below!</span>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Available Courses -->
      <div class="mt-5 mb-5">
        <h4 class="fw-bold mb-3">Available Courses</h4>
        <ul id="availableList" class="list-group">
          <?php if (!empty($availableCourses ?? [])): ?>
            <?php foreach ($availableCourses as $course): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= esc($course['course_name']) ?>
                <button class="btn btn-sm btn-outline-success enroll-btn" data-course-id="<?= esc($course['id']) ?>">
                  Enroll
                </button>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-center text-muted py-4">
              <i class="bi bi-plus-circle fs-2 d-block mb-2 text-secondary"></i>
              No courses available at the moment.<br>
              <span class="text-secondary">Please check back later.</span>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- ================= TEACHER DASHBOARD ================= -->
    <?php if (($role ?? '') === 'teacher'): ?>
      <div class="row g-4">

        <!-- Manage Classes -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
              <h5 class="fw-bold mb-3">Manage Classes</h5>
              <a href="#" class="btn btn-outline-primary btn-sm">View Classes</a>
            </div>
          </div>
        </div>

        <!-- Grade Submissions -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-card-checklist fs-1 text-info mb-3"></i>
              <h5 class="fw-bold mb-3">Grade Submissions</h5>
              <a href="#" class="btn btn-outline-info btn-sm">Check Grades</a>
            </div>
          </div>
        </div>

        <!-- Post Assignments -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-upload fs-1 text-warning mb-3"></i>
              <h5 class="fw-bold mb-3">Post Assignments</h5>
              <a href="#" class="btn btn-outline-warning btn-sm">Create Assignment</a>
            </div>
          </div>
        </div>

        <!-- Announcements -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-megaphone fs-1 text-success mb-3"></i>
              <h5 class="fw-bold mb-3">Announcements</h5>
              <a href="<?= site_url('announcements') ?>" class="btn btn-outline-success btn-sm">View Announcements</a>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= UPLOAD MATERIAL SECTION ================= -->
      <div class="container mt-5 mb-5">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-4 text-primary">
              <i class="bi bi-upload me-2"></i>Upload Course Material
            </h3>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php elseif (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <!-- Upload Form -->
            <form action="<?= base_url('admin/course/' . esc($course_id ?? 0) . '/upload') ?>" 
                  method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
              <?= csrf_field() ?>
              <div class="mb-3">
                <label for="material" class="form-label">Select File</label>
                <input class="form-control" type="file" name="material" id="material" required>
              </div>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
          </div>
        </div>
      </div>
    <?php endif; ?> <!-- ✅ closes teacher dashboard -->

    <!-- ================= ADMIN DASHBOARD ================= -->
    <?php if (($role ?? '') === 'admin'): ?>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-graph-up fs-1 text-success mb-3"></i>
              <h5 class="fw-bold mb-3">Reports</h5>
              <a href="#" class="btn btn-outline-success btn-sm">View Reports</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-bar-chart fs-1 text-danger mb-3"></i>
              <h5 class="fw-bold mb-3">Analytics</h5>
              <a href="#" class="btn btn-outline-danger btn-sm">View Analytics</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <i class="bi bi-folder fs-1 text-primary mb-3"></i>
              <h5 class="fw-bold mb-3">Content Management</h5>
              <a href="#" class="btn btn-outline-primary btn-sm">Manage Content</a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.enroll-btn').click(function(e) {
    e.preventDefault();
    let button = $(this);
    let courseId = button.data('course-id');

    $.post("<?= site_url('course/enroll') ?>", { course_id: courseId }, function(response) {
      if (response.success) {
        $('#alertPlaceholder').html(`
          <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            Successfully enrolled in <strong>${response.course_name}</strong>!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        `);

        button.prop('disabled', true)
              .text('Enrolled')
              .removeClass('btn-outline-success')
              .addClass('btn-success');

        $('#enrolledList').append(`
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${response.course_name}
            <span class="badge bg-primary rounded-pill">Enrolled</span>
          </li>
        `);
      } else {
        $('#alertPlaceholder').html(`
          <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            ${response.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        `);
      }
    }, 'json');
  });
});
</script>

</body>
</html>
