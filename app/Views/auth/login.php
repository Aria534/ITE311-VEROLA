<!-- app/Views/auth/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: "Arial Rounded MT Bold", "Helvetica Rounded", Arial, sans-serif; }
        h3 { font-weight: bold; }
        .btn-primary { font-weight: bold; }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <!--Success Message -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!--Error Message -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <input type="email" 
                           name="email" 
                           value="<?= old('email') ?>" 
                           class="form-control" 
                           placeholder="Email" 
                           required>
                </div>

                <div class="mb-3">
                    <input type="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Password" 
                           required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>

            <p class="mt-3 text-center">
                <a href="<?= base_url('/register') ?>">Don't have an account? Register</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>
