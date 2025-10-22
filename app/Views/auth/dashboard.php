<?php include(APPPATH . 'Views/templates/header.php'); ?>

<div class="container my-5">
  <div class="card p-4 shadow-lg border-0 rounded-4">
    <!-- Header -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Welcome, <?= esc($username) ?>!</h2>
      <p class="text-muted">
        You are logged in as 
        <span class="fw-semibold text-primary"><?= esc($role) ?></span>.
      </p>
    </div>

    <!-- Alert placeholder -->
    <div id="alertPlaceholder"></div>

    <div class="row g-4">
      <?php if ($role === 'student'): ?>
        <!-- ================= STUDENT DASHBOARD ================= -->

        <!-- ================= QUICK ACTION CARDS ================= -->
        <div class="row">
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

          <!-- Attendance -->
          <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm border-0 h-100">
              <div class="card-body">
                <i class="bi bi-clipboard-check fs-1 text-danger mb-3"></i>
                <h5 class="card-title fw-semibold">Attendance</h5>
                <p class="text-muted small mb-3">Track your attendance.</p>
                <a href="<?= site_url('student/attendance') ?>" class="btn btn-outline-danger btn-sm">View</a>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= ENROLLED COURSES ================= -->
        <div class="mt-5">
          <h4 class="fw-bold mb-3">Enrolled Courses</h4>
          <ul id="enrolledList" class="list-group">
            <?php if (!empty($enrolledCourses)): ?>
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

        <!-- ================= AVAILABLE COURSES ================= -->
        <div class="mt-5 mb-5">
          <h4 class="fw-bold mb-3">Available Courses</h4>
          <ul id="availableList" class="list-group">
            <?php if (!empty($availableCourses)): ?>
              <?php foreach ($availableCourses as $course): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= esc($course['course_name']) ?>
                  <button 
                    class="btn btn-sm btn-outline-success enroll-btn"
                    data-course-id="<?= esc($course['id']) ?>">
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

        <div class="container mt-4">
    <h4 class="mb-3">📚 Course Materials</h4>
    <?php if (!empty($materials)): ?>
        <ul class="list-group">
            <?php foreach ($materials as $mat): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= esc($mat['file_name']) ?>
                    <a href="<?= base_url('materials/download/' . $mat['id']) ?>" class="btn btn-sm btn-success">
                        <i class="bi bi-download"></i> Download
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No materials available for this course yet.</p>
    <?php endif; ?>
</div>

      <?php endif; ?>

      <?php if ($role === 'teacher'): ?>
        <!-- ================= TEACHER DASHBOARD ================= -->
        <!--TEACHER DASHBOARD-->

        <!-- Manage Classes -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-primary text-white rounded-circle" 
                      style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-people-fill" style="font-size:28px;"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Manage Classes</h5>
              <a href="#" class="btn btn-outline-primary btn-sm">View Classes</a>
            </div>
          </div>
        </div>

        <!-- Grade Submissions -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-info text-white rounded-circle" 
                      style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-card-checklist" style="font-size:28px;"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Grade Submissions</h5>
              <a href="#" class="btn btn-outline-info btn-sm">Check Grades</a>
            </div>
          </div>
        </div>

        <!-- Post Assignments -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-warning text-white rounded-circle" 
                      style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-upload" style="font-size:28px;"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Post Assignments</h5>
              <a href="#" class="btn btn-outline-warning btn-sm">Create Assignment</a>
            </div>
          </div>
        </div>

        <!-- Calendar -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle" 
                      style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-calendar-event" style="font-size:28px;"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Calendar</h5>
              <a href="#" class="btn btn-outline-success btn-sm">Open Calendar</a>
            </div>
          </div>
        </div>

      <?php endif; ?>
    </div>

    <?php if ($role === 'admin'): ?>
        <!-- ================= ADMIN DASHBOARD ================= -->
        <!-- ADMIN DASHBOARD-->
     <div class="row g-3"> 
  <!-- Reports -->
  <div class="col-md-4">
    <div class="card border-0 bg-light shadow-sm h-100 text-center">
      <div class="card-body">
        <div class="mb-3">
          <span class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
            <i class="bi bi-graph-up"></i>
          </span>
        </div>
        <h5 class="fw-bold mb-3">Reports</h5>
        <a href="#" class="btn btn-outline-success btn-sm">View Reports</a>
      </div>
    </div>
  </div>

  <!-- Analytics -->
  <div class="col-md-4">
    <div class="card border-0 bg-light shadow-sm h-100 text-center">
      <div class="card-body">
        <div class="mb-3">
          <span class="d-inline-flex justify-content-center align-items-center bg-danger text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
            <i class="bi bi-bar-chart"></i>
          </span>
        </div>
        <h5 class="fw-bold mb-3">Analytics</h5>
        <a href="#" class="btn btn-outline-danger btn-sm">View Analytics</a>
      </div>
    </div>
  </div>

  <!-- Content Management -->
  <div class="col-md-4">
    <div class="card border-0 bg-light shadow-sm h-100 text-center">
      <div class="card-body">
        <div class="mb-3">
          <span class="d-inline-flex justify-content-center align-items-center bg-primary text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
            <i class="bi bi-folder"></i>
          </span>
        </div>
        <h5 class="fw-bold mb-3">Content Management</h5>
        <a href="#" class="btn btn-outline-primary btn-sm">Manage Content</a>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
    </div>
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
        // ✅ Show success alert
        $('#alertPlaceholder').html(`
          <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            Successfully enrolled in <strong>${response.course_name}</strong>!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        `);

        // ✅ Disable button and change text
        button.prop('disabled', true)
              .text('Enrolled')
              .removeClass('btn-outline-success')
              .addClass('btn-success');

        // ✅ Add to enrolled list dynamically
        $('#enrolledList').append(`
          <li class="list-group-item d-flex justify-content-between align-items-center">
            ${response.course_name}
            <span class="badge bg-primary rounded-pill">Enrolled</span>
          </li>
        `);
      } else {
        // ❌ Error alert
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
