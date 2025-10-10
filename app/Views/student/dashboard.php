<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="card p-4 shadow-lg border-0 rounded-4">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Welcome, <?= esc($username) ?>!</h2>
      <p class="text-muted">
        You are logged in as <span class="fw-semibold text-primary"><?= esc($role) ?></span>.
      </p>
    </div>

    <div id="alertPlaceholder"></div>

    <div class="row g-4">
      <!-- Student Cards -->
      <div class="col-md-3 mb-4">
        <div class="card text-center shadow-sm border-0 h-100">
          <div class="card-body">
            <i class="bi bi-mortarboard fs-1 text-info mb-3"></i>
            <h5 class="card-title">Courses</h5>
            <p class="text-muted small">View available and enrolled courses.</p>
            <a href="#availableCoursesSection" class="btn btn-outline-info btn-sm">View Courses</a>
          </div>
        </div>
      </div>

      <!-- Enrolled Courses -->
      <div class="col-12 mt-5" id="enrolledCoursesSection">
        <ul id="enrolledList" class="list-group">
          <?php if (!empty($enrolledCourses)): ?>
            <?php foreach ($enrolledCourses as $ec): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= esc($ec['course_title']) ?>
                <span class="badge bg-primary rounded-pill">Enrolled</span>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Available Courses -->
      <div class="col-12 mt-5" id="availableCoursesSection">
        <div class="row" id="availableCoursesContainer">
          <?php if (!empty($availableCourses)): ?>
            <?php foreach ($availableCourses as $course): ?>
              <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?= esc($course['course_title']) ?></h5>
                    <p class="text-muted small"><?= esc($course['description'] ?? 'No description available.') ?></p>
                    <button class="btn btn-outline-success enroll-btn btn-sm" data-course-id="<?= esc($course['id']) ?>">Enroll</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- AJAX Enrollment Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.enroll-btn').click(function(e) {
    e.preventDefault();
    let button = $(this);
    let courseId = button.data('course-id');
    let courseTitle = button.closest('.card-body').find('.card-title').text();

    $.post("<?= site_url('course/enroll') ?>", { course_id: courseId, course_title: courseTitle }, function(response) {
      if (response.status === 'success') {
        $('#alertPlaceholder').html(`
          <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            Successfully enrolled in <strong>${courseTitle}</strong>!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        `);
        button.prop('disabled', true).text('Enrolled')
              .removeClass('btn-outline-success').addClass('btn-success');
        $('#enrolledList').append(`
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${courseTitle}
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
