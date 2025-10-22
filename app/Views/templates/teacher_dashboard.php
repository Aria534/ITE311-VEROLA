<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php
$role = session()->get('role') ?? 'teacher';
$username = session()->get('username') ?? 'Teacher';
include APPPATH . 'Views/templates/header.php';
?>

<div class="container mt-4">
    <div class="bg-primary text-white p-3 rounded-top d-flex align-items-center">
        <i class="bi bi-person-workspace fs-3 me-2"></i>
        <h3 class="m-0">Teacher Dashboard</h3>
    </div>

    <div class="bg-white p-4 rounded-bottom shadow-sm">
        <p class="mb-4">Welcome, <strong><?= esc($username) ?></strong>!</p>

        <div class="row g-4">
            <!-- Manage Classes -->
            <div class="col-md-3">
                <div class="card bg-light text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="d-inline-flex justify-content-center align-items-center bg-primary text-white rounded-circle" 
                                  style="width:60px; height:60px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold mb-3">Manage Classes</h5>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Classes</a>
                    </div>
                </div>
            </div>

            <!-- Grade Submissions -->
            <div class="col-md-3">
                <div class="card bg-light text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="d-inline-flex justify-content-center align-items-center bg-info text-white rounded-circle" 
                                  style="width:60px; height:60px;">
                                <i class="bi bi-card-checklist fs-4"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold mb-3">Grade Submissions</h5>
                        <a href="#" class="btn btn-outline-info btn-sm">Check Grades</a>
                    </div>
                </div>
            </div>

            <!-- Upload Materials -->
            <div class="col-md-3">
                <div class="card bg-light text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="d-inline-flex justify-content-center align-items-center bg-warning text-white rounded-circle" 
                                  style="width:60px; height:60px;">
                                <i class="bi bi-upload fs-4"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold mb-3">Upload Materials</h5>
                        <a href="<?= site_url('materials/upload') ?>" class="btn btn-outline-warning btn-sm">Upload</a>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="col-md-3">
                <div class="card bg-light text-center border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle" 
                                  style="width:60px; height:60px;">
                                <i class="bi bi-calendar-event fs-4"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold mb-3">Calendar</h5>
                        <a href="#" class="btn btn-outline-success btn-sm">Open Calendar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
