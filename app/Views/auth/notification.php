<?php include(APPPATH . 'Views/templates/header.php'); ?>

<!-- ===================== 🔔 Notification Dropdown (Top) ===================== -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded-3 px-4 mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="#">Dashboard</a>
    <ul class="navbar-nav ms-auto align-items-center">
      <!-- Notification Bell -->
      <li class="nav-item dropdown me-3">
        <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-bell" style="font-size: 1.4rem;"></i>
          <span id="notificationCount" class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill" style="display:none;">0</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="width: 320px;">
          <li class="dropdown-header fw-bold">Notifications</li>
          <li><hr class="dropdown-divider"></li>
          <div id="notificationListDropdown" class="px-3" style="max-height: 300px; overflow-y: auto;">
            <p class="text-center text-muted small mb-2">No new notifications</p>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<!-- ===================== 🔔 End Notification Dropdown ===================== -->

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

    <!-- Notifications Section -->
    <div class="alert alert-info mt-3" id="notificationsBox" style="display:none;">
      <h6 class="fw-bold mb-2">🔔 Notifications</h6>
      <ul id="notificationList" class="list-group list-group-flush"></ul>
    </div>

    <!-- =================== DASHBOARD CONTENTS (student / teacher / admin) =================== -->
    <!-- Your original role-based dashboard sections remain unchanged -->
    <?= $this->renderSection('dashboard_content'); ?>

  </div>
</div>

<!-- ===================== SCRIPTS ===================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

  // =================== FETCH NOTIFICATIONS (Dropdown + Box) ===================
  function loadNotifications() {
    $.get('<?= base_url('/notifications') ?>', function(response) {
      if (response.success) {
        const count = response.count;
        const notifications = response.notifications;

        // Update badge count
        if (count > 0) {
          $('#notificationCount').text(count).show();
        } else {
          $('#notificationCount').hide();
        }

        // Dropdown list
        let dropdownHTML = '';
        // Box list (optional lower section)
        let boxHTML = '';

        if (notifications.length > 0) {
          notifications.forEach(n => {
            dropdownHTML += `
              <div class="alert alert-info d-flex justify-content-between align-items-center mb-2">
                <div>${n.message}</div>
                <button class="btn btn-sm btn-outline-secondary mark-read" data-id="${n.id}">&check;</button>
              </div>`;
            boxHTML += `
              <li class="list-group-item d-flex justify-content-between align-items-center">
                ${n.message}
                <small class="text-muted">${n.created_at}</small>
              </li>`;
          });
        } else {
          dropdownHTML = '<p class="text-center text-muted small mb-2">No new notifications</p>';
        }

        $('#notificationListDropdown').html(dropdownHTML);
        $('#notificationList').html(boxHTML);

        if (notifications.length > 0) {
          $('#notificationsBox').show();
        } else {
          $('#notificationsBox').hide();
        }
      }
    }, 'json');
  }

  // =================== MARK AS READ ===================
  $(document).on('click', '.mark-read', function() {
    const id = $(this).data('id');
    $.post('<?= base_url('/notifications/mark_read') ?>/' + id, function(response) {
      if (response.success) {
        loadNotifications();
      }
    });
  });

  // =================== ENROLLMENT (existing) ===================
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

        loadNotifications(); // refresh notifications after enrolling
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

  // =================== AUTO REFRESH NOTIFICATIONS ===================
  loadNotifications();
  setInterval(loadNotifications, 30000);
});
</script>

</body>
</html>
