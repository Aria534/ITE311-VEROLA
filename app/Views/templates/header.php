<?php include('app\Views\template.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'LMS') ?></title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php $role = session()->get('role'); ?>


<?php if (session()->get('isLoggedIn')): ?>
  <?php if ($role === 'student'): ?>
    <!-- Student Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/dashboard') ?>">Student Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStudent">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarStudent">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/home') ?>"><i class="bi bi-house"></i> Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/classes') ?>"><i class="bi bi-journal-text"></i> My Schedule</a></li>

            <!-- 🔔 Notification Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-5"></i>
                <span id="notificationBadge" class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill d-none">0</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="notificationDropdown" style="width: 320px;">
                <li class="dropdown-header fw-bold text-center bg-light">Notifications</li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <div id="notificationList" class="p-2" style="max-height: 300px; overflow-y: auto;">
                    <p class="text-muted text-center my-2">No notifications yet</p>
                  </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li class="text-center">
                  <!-- ✅ FIXED: lowercase URL -->
                  <a href="<?= base_url('/notifications') ?>" class="text-decoration-none small">View all notifications</a>
                </li>
              </ul>
            </li>

            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php elseif ($role === 'teacher'): ?>
    <!-- Teacher Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/dashboard') ?>">Teacher Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTeacher">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarTeacher">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

  <?php elseif ($role === 'admin'): ?>
    <!-- Admin Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="<?= base_url('/dashboard') ?>">Admin Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
          <i class="bi bi-list fs-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarAdmin">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/users') ?>"><i class="bi bi-person-gear"></i> Manage Users</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/settings') ?>"><i class="bi bi-gear"></i> System Settings</a></li>

            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif; ?>
<?php endif; ?>


<!-- ================== JS SCRIPTS ================== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {

  // 🔁 Load Notifications
  function loadNotifications() {
    $.get("<?= base_url('/notifications') ?>", function(response) {
      if (!response.success) return;

      const badge = $('#notificationBadge');
      const list = $('#notificationList');
      list.empty();

      if (response.count > 0) {
        badge.text(response.count).removeClass('d-none');
      } else {
        badge.addClass('d-none');
      }

      if (response.notifications.length === 0) {
        list.html('<p class="text-muted text-center my-2">No notifications</p>');
      } else {
        response.notifications.forEach(n => {
        // Convert string "0"/"1" to boolean
        const isRead = n.is_read == 1 || n.is_read === true;

        const alertClass = isRead ? 'alert-secondary' : 'alert-info';
        const buttonLabel = isRead ? 'Read' : 'Mark as Read';
        const html = `
          <div class="alert ${alertClass} d-flex justify-content-between align-items-center p-2 mb-2 rounded-3">
            <div class="me-2 flex-grow-1">${n.message}</div>
            <button 
              class="btn btn-sm ${isRead ? 'btn-outline-secondary' : 'btn-outline-primary'}"
              onclick="markAsRead(${n.id})"
              ${isRead ? 'disabled' : ''}
            >
              ${buttonLabel}
            </button>
          </div>
        `;
        list.append(html);
      });
      }
    }).fail(() => {
      console.error('❌ Failed to load notifications (check route or server).');
    });
  }

  // ✅ Mark as read
  window.markAsRead = function(id) {
    $.post("<?= base_url('/notifications/mark_read') ?>/" + id, function(response) {
      if (response.success) loadNotifications();
    }).fail(() => {
      console.error('❌ Failed to mark notification as read.');
    });
  }

  // 🕒 Load initially + auto refresh every 30 seconds
  loadNotifications();
  setInterval(loadNotifications, 30000);
});
</script>

</body>
</html>
