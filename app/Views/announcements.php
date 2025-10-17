<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .page-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-header i {
            font-size: 1.8rem;
            color: #0d6efd;
        }
        .announcement-card {
            border: none;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .announcement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        }
        .announcement-title {
            color: #0d6efd;
            font-weight: 600;
        }
        .announcement-date {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="text-center mb-4">
        <div class="page-header justify-content-center">
            <i class="bi bi-megaphone-fill"></i>
            <h3 class="fw-bold mb-0">Latest Announcements</h3>
        </div>
        <p class="text-muted mt-2">Stay updated with the latest news and updates</p>
    </div>

    <?php if (!empty($announcements)): ?>
        <div class="row g-3">
            <?php foreach ($announcements as $announcement): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card announcement-card p-3 h-100">
                        <h5 class="announcement-title mb-2"><?= esc($announcement['title']) ?></h5>
                        <p class="text-secondary mb-3"><?= esc($announcement['content']) ?></p>
                        <p class="announcement-date mb-0">
                            <i class="bi bi-calendar-event"></i>
                            <?= date('F j, Y, g:i a', strtotime($announcement['created_at'])) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center shadow-sm border-0">
            <i class="bi bi-info-circle"></i> No announcements available at the moment.
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
