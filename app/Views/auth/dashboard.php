<?php include(APPPATH . 'Views/templates/header.php'); ?>

<!-- Page Content Wrapper -->
<div class="container my-5">
  <div class="card p-4 shadow-lg border-0 rounded-4">

    <!-- Welcome Header -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Welcome, <?= esc($username) ?>!</h2>
      <p class="text-muted">
        You are logged in as 
        <span class="fw-semibold text-primary"><?= esc($role) ?></span>.
      </p>
    </div>

    <div class="row g-4">

      <?php if ($role === 'student'): ?>
        <!--STUDENT DASHBOARD-->
        
        <!-- My Grades -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-info text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-card-checklist"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">My Grades</h5>
              <a href="#" class="btn btn-outline-info btn-sm">View Grades</a>
            </div>
          </div>
        </div>

        <!-- Assignments -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-warning text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-journal-text"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Assignments</h5>
              <a href="#" class="btn btn-outline-warning btn-sm">Go to Assignments</a>
            </div>
          </div>
        </div>

        <!-- Calendar -->
        <div class="col-md-3">
          <div class="card border-0 bg-light shadow-sm h-100 text-center">
            <div class="card-body">
              <div class="mb-3">
                <span class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
                  <i class="bi bi-calendar-event"></i>
                </span>
              </div>
              <h5 class="fw-bold mb-3">Calendar</h5>
              <a href="#" class="btn btn-outline-success btn-sm">Open Calendar</a>
            </div>
          </div>
        </div>

        <!-- Attendance -->
<div class="col-md-3">
  <div class="card border-0 bg-light shadow-sm h-100 text-center">
    <div class="card-body">
      <div class="mb-3">
        <span class="d-inline-flex justify-content-center align-items-center bg-danger text-white rounded-circle" style="width:60px; height:60px; font-size:24px;">
          <i class="bi bi-clipboard-check"></i>
        </span>
      </div>
      <h5 class="fw-bold mb-3">Attendance</h5>
      <a href="#" class="btn btn-outline-danger btn-sm">View Attendance</a>
    </div>
  </div>
</div>
      <?php endif; ?>

      <?php if ($role === 'teacher'): ?>
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

</body>
</html>
