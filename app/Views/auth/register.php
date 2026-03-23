<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
=======
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6

    <style>
        body { font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif; }
        h3 { font-weight: bold; }
        .btn-primary { font-weight: bold; }
<<<<<<< HEAD

        .role-selector { display: flex; gap: 10px; }
        .role-option { flex: 1; }
        .role-option input[type="radio"] { display: none; }
        .role-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 12px 8px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fff;
            font-size: 0.82rem;
            font-weight: bold;
            color: #6c757d;
            gap: 5px;
        }
        .role-card i { font-size: 1.4rem; }
        .role-option input[type="radio"]:checked + .role-card {
            border-color: #0d6efd;
            background-color: #e8f0fe;
            color: #0d6efd;
        }
        .role-card:hover {
            border-color: #0d6efd;
            color: #0d6efd;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-4">
=======
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6

<div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-4">Register</h3>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="post">
                <?= csrf_field() ?>

<<<<<<< HEAD
=======
                <!-- FIXED: use "username" instead of "name" -->
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= old('username') ?>" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= old('email') ?>" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
                </div>

<<<<<<< HEAD
                <!-- Role Selection -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">Select Role</label>
                    <div class="role-selector">

                        <label class="role-option">
                            <input type="radio" name="role" value="student"
                                <?= old('role', 'student') === 'student' ? 'checked' : '' ?> required>
                            <div class="role-card">
                                <i class="bi bi-person-fill"></i>
                                Student
                            </div>
                        </label>

                        <label class="role-option">
                            <input type="radio" name="role" value="teacher"
                                <?= old('role') === 'teacher' ? 'checked' : '' ?>>
                            <div class="role-card">
                                <i class="bi bi-mortarboard-fill"></i>
                                Teacher
                            </div>
                        </label>

                        <label class="role-option">
                            <input type="radio" name="role" value="admin"
                                <?= old('role') === 'admin' ? 'checked' : '' ?>>
                            <div class="role-card">
                                <i class="bi bi-shield-fill"></i>
                                Admin
                            </div>
                        </label>

                    </div>
                </div>

=======
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>

            <p class="mt-3 text-center">
                <a href="<?= base_url('login') ?>">Already have an account? Login</a>
            </p>
        </div>
    </div>
</div>

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 395ac66e141a3657ff7a8add8b095e1954f277b6
