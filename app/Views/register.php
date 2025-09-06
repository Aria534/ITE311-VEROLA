<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif;
        }
        h3 {
            font-weight: bold;
        }
        .btn-primary {
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-center mb-4">Register</h3>

                <?php if(session()->getFlashdata('register_success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('register_success') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('register_error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('register_error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('register') ?>" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-3">
                        <select name="role" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

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
</html>
