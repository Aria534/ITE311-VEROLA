<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latest Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eef6ff, #f9fbff);
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            color: #000; /* ✅ Make all default text black */
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
            color: #fff;
        }

        .announcement-header h3 {
            margin: 0;
            font-weight: 600;
            color: #fff;
        }

        .announcement-body {
            background: #ffffff;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .announcement-item {
            border-left: 4px solid #0d6efd;
            background: #f0f6ff;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .announcement-item:hover {
            transform: translateX(5px);
            background: #e5f0ff;
        }

        .announcement-item h5 {
            color: #000; /* ✅ Title font is black */
            font-weight: 600;
        }

        .announcement-item p {
            color: #000; /* ✅ Content font is black */
            margin-bottom: 5px;
        }

        .announcement-date {
            font-size: 0.85rem;
            color: #000; /* ✅ Date text also black */
        }

        .announcement-date i {
            color: #0d6efd;
            margin-right: 4px;
        }

        .no-announcement {
            text-align: center;
            padding: 40px;
            color: #000; /* ✅ Text black */
        }

        .no-announcement i {
            font-size: 2rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="announcement-wrapper">
    <div class="announcement-header">
        <i class="bi bi-megaphone-fill"></i>
        <h3>Latest Announcements</h3>
    </div>

    <div class="announcement-body">
        <?php 
        // 🔹 Temporary mock data (for display purposes)
        $announcements = [
            [
                'title' => 'System Maintenance Notice',
                'content' => 'Our system will undergo scheduled maintenance on October 20, 2025 from 12:00 AM to 3:00 AM. Please save your work before that time.',
                'created_at' => '2025-10-15 09:30:00'
            ],
            [
                'title' => 'New Library Books Available',
                'content' => 'The library has added over 200 new titles in Computer Science, Literature, and History. Visit the library or browse the online catalog!',
                'created_at' => '2025-10-14 14:15:00'
            ],
            [
                'title' => 'Midterm Exam Schedule Released',
                'content' => 'Midterm exams will begin on October 21, 2025. Check your student portal for your personalized exam schedule.',
                'created_at' => '2025-10-12 11:45:00'
            ],
            [
                'title' => 'Campus Clean-Up Drive',
                'content' => 'Join us for a campus-wide clean-up activity on October 25. Volunteers will receive community service hours.',
                'created_at' => '2025-10-10 08:00:00'
            ],
        ];
        ?>

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
