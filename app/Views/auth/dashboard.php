<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">

  <!-- Welcome Header -->
  <div class="text-center mb-5">
    <h2 class="fw-bold" style="font-family: Arial, sans-serif;">Welcome, <?= esc($username) ?>!</h2>
    <p style="font-family: Arial, sans-serif;">
      You are logged in as <span class="fw-semibold text-primary"><?= esc($role) ?></span>.
    </p>
  </div>

  <div id="alertPlaceholder"></div>

  <div class="row g-4">

    <!-- ================= STUDENT DASHBOARD ================= -->
    <?php if ($role === 'student'): ?>
      <div class="row g-4 mb-4">
        <div class="col-md-4">
          <div class="card text-center h-100 border-0 shadow-sm p-3">
            <i class="bi bi-journal-check fs-1 text-primary mb-3"></i>
            <h5 class="fw-semibold" style="font-family: Arial, sans-serif;">My Grades</h5>
            <p class="text-muted small mb-3" style="font-family: Arial, sans-serif;">View your grades for completed courses.</p>
            <a href="<?= site_url('student/grades') ?>" class="btn btn-outline-primary btn-sm">View Grades</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-center h-100 border-0 shadow-sm p-3">
            <i class="bi bi-file-earmark-text fs-1 text-warning mb-3"></i>
            <h5 class="fw-semibold" style="font-family: Arial, sans-serif;">Assignments</h5>
            <p class="text-muted small mb-3" style="font-family: Arial, sans-serif;">Check your upcoming assignments.</p>
            <a href="<?= site_url('student/assignments') ?>" class="btn btn-outline-warning btn-sm">View</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-center h-100 border-0 shadow-sm p-3">
            <i class="bi bi-calendar3 fs-1 text-success mb-3"></i>
            <h5 class="fw-semibold" style="font-family: Arial, sans-serif;">Calendar</h5>
            <p class="text-muted small mb-3" style="font-family: Arial, sans-serif;">See your schedule and important dates.</p>
            <a href="<?= site_url('student/calendar') ?>" class="btn btn-outline-success btn-sm">Open</a>
          </div>
        </div>
      </div>

      <!-- Downloadable Materials -->
      <div class="card mb-4 shadow-sm p-4 border-0">
        <h5 class="fw-bold text-primary mb-3" style="font-family: Arial, sans-serif;">📚 Downloadable Materials</h5>
        <?php if (!empty($materials)): ?>
          <ul class="list-group list-group-flush">
            <?php foreach ($materials as $material): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center" style="font-family: Arial, sans-serif;">
                <div><i class="bi bi-file-earmark-text text-primary me-2"></i><?= esc($material['file_name']) ?></div>
                <a href="<?= base_url('materials/download/' . $material['id']) ?>" class="btn btn-sm btn-outline-primary">Download</a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted mb-0" style="font-family: Arial, sans-serif;">No materials uploaded yet.</p>
        <?php endif; ?>
      </div>

      <!-- Enrolled Courses -->
      <div class="mb-5">
        <h4 class="fw-bold mb-3" style="font-family: Arial, sans-serif;">Enrolled Courses</h4>
        <ul class="list-group">
          <?php if (!empty($enrolledCourses)): ?>
            <?php foreach ($enrolledCourses as $ec): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center" style="font-family: Arial, sans-serif;">
                <?= esc($ec['course_name']) ?>
                <span class="badge bg-primary rounded-pill">Enrolled</span>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-center text-muted py-4" style="font-family: Arial, sans-serif;">
              <i class="bi bi-book fs-2 d-block mb-2 text-secondary"></i>
              You haven't enrolled in any courses yet.<br>
              <span class="text-primary fw-semibold">Start by choosing from the available courses below!</span>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Available Courses -->
      <div class="mb-5">
        <h4 class="fw-bold mb-3" style="font-family: Arial, sans-serif;">Available Courses</h4>
        <ul class="list-group">
          <?php if (!empty($availableCourses)): ?>
            <?php foreach ($availableCourses as $course): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center" style="font-family: Arial, sans-serif;">
                <?= esc($course['course_name']) ?>
                <button class="btn btn-sm btn-outline-success enroll-btn" data-course-id="<?= esc($course['id']) ?>">Enroll</button>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-center text-muted py-4" style="font-family: Arial, sans-serif;">
              <i class="bi bi-plus-circle fs-2 d-block mb-2 text-secondary"></i>
              No courses available at the moment.<br>
              <span class="text-secondary">Please check back later.</span>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- ================= TEACHER DASHBOARD ================= -->
    <?php if ($role === 'teacher'): ?>
      <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0" style="font-family: Arial, sans-serif;">My Students</h5>
        </div>
        <div class="card-body">
          <?php if (!empty($students)): ?>
            <div class="row g-3">
              <?php foreach ($students as $s): ?>
                <div class="col-md-4">
                  <div class="border rounded p-3 h-100" style="font-family: Arial, sans-serif;">
                    <h6 class="fw-bold mb-1"><?= esc($s['username'] ?? $s['name'] ?? '') ?></h6>
                    <p class="text-muted mb-2"><?= esc($s['email'] ?? '') ?></p>
                    <span class="badge bg-success">Enrolled</span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="text-center py-4 text-muted" style="font-family: Arial, sans-serif;">
              <i class="bi bi-people fs-1"></i>
              <p class="mt-2">No students enrolled yet.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Teacher Courses & Upload -->
      <div class="mb-5">
        <h5 class="mb-4 text-primary fw-bold" style="font-family: Arial, sans-serif;">📘 Your Courses & Upload Materials</h5>
        <?php if (!empty($teacherCourses) && is_array($teacherCourses)): ?>
          <div class="row g-3">
            <?php foreach ($teacherCourses as $course): ?>
              <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm p-3 border-0" style="font-family: Arial, sans-serif;">
                  <h6 class="card-title"><i class="bi bi-book text-primary me-2"></i><?= esc($course['course_name']) ?></h6>
                  <p class="card-text text-muted mb-3">Manage and upload materials for this course.</p>
                  <a href="<?= site_url('admin/course/' . esc($course['id']) . '/upload') ?>" class="btn btn-primary btn-sm">Upload Material</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- ================= ADMIN DASHBOARD ================= -->
    <?php if ($role === 'admin'): ?>
      <div class="mb-5">
        <h5 class="mb-3 text-primary fw-bold" style="font-family: Arial, sans-serif;">📘 Manage Courses & Upload Materials</h5>
        <?php if (!empty($adminCourses)): ?>
          <ul class="list-group">
            <?php foreach ($adminCourses as $course): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center" style="font-family: Arial, sans-serif;">
                <div><i class="bi bi-book text-primary me-2"></i><?= esc($course['course_name']) ?></div>
                <a href="<?= base_url('admin/course/' . $course['id'] . '/upload') ?>" class="btn btn-primary btn-sm">Upload Material</a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="text-muted mb-0" style="font-family: Arial, sans-serif;">No courses available for upload.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>
</div>


<!-- ================= AJAX ENROLLMENT SCRIPT ================= -->
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
