<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="fw-bold mb-3">📣 Latest Announcements</h4>

            <?php if (!empty($announcements)): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($announcements as $announcement): ?>
                        <li class="list-group-item">
                            <h5 class="fw-bold"><?= esc($announcement['title']) ?></h5>
                            <p><?= esc($announcement['content']) ?></p>
                            <small class="text-muted">Posted on <?= date('F j, Y, g:i a', strtotime($announcement['created_at'])) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No announcements available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
