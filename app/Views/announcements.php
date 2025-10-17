<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #f9fafc);
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
        }
        .announcement-wrapper {
            max-width: 1000px;
            margin: 60px auto;
        }
        .announcement-header {
            background: #0d6efd;
            color: #fff;
            padding: 25px 30px;
            border-radius: 12px 12px 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .announcement-header i {
            font-size: 2rem;
        }
        .announcement-header h3 {
            margin: 0;
            font-weight: 600;
        }
        .announcement-body {
            background: #fff;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            padding: 30px;
        }
        .announcement-item {
            border-left: 4px solid #0d6efd;
            background: #f8faff;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .announcement-item:hover {
            transform: translateX(5px);
            background: #f1f6ff;
        }
        .announcement-item h5 {
            color: #0d6efd;
            font-weight: 600;
        }
        .announcement-item p {
            color: #444;
            margin-bottom: 5px;
        }
        .announcement-date {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .no-announcement {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .no-announcement i {
            font-size: 2rem;
            color: #adb5bd;
        }
    </style>
</head>
<body>

<div class="announcement-wrapper">
    <div class="announcement-header">
        <i class="bi bi-broadcast-pin"></i>
        <h3>Latest Announcements</h3>
    </div>

    <div class="announcement-body">
        <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement-item">
                    <h5><?= esc($announcement['title']) ?></h5>
                    <p><?= esc($announcement['content']) ?></p>
                    <div class="announcement-date">
                        <i class="bi bi-calendar3"></i>
                        <?= date('F j, Y, g:i a', strtotime($announcement['created_at'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-announcement">
                <i class="bi bi-info-circle"></i>
                <p>No announcements available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
