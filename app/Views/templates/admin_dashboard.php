<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eef6ff, #f9fbff);
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            color: #000;
        }
        .dashboard-header {
            background: #0d6efd;
            color: #fff;
            padding: 25px 30px;
            border-radius: 12px 12px 0 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .dashboard-header i {
            font-size: 2rem;
            color: #fff;
        }
        .dashboard-header h3 {
            margin: 0;
            font-weight: 600;
            color: #fff;
        }
        .dashboard-body {
            background: #ffffff;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            color: #0d6efd;
            font-weight: 600;
        }
        .btn-outline-success {
            border-color: #198754;
            color: #198754;
        }
        .btn-outline-success:hover {
            background: #198754;
            color: #fff;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-outline-danger:hover {
            background: #dc3545;
            color: #fff;
        }
        .btn-outline-primary {
            border-color: #0d6efd;
            color: #0d6efd;
        }
        .btn-outline-primary:hover {
            background: #0d6efd;
            color: #fff;
        }
    </style>
</head>
<body>

<?php
$role = session()->get('role');
include APPPATH . 'Views/templates/header.php';
?>

<div class="container mt-4">
    <div class="dashboard-header">
        <h3>Admin Dashboard</h3>
    </div>

    <div class="dashboard-body">
        <p class="mb-4">Welcome, <?= esc($username) ?>!</p>

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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
