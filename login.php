<?php
session_start();
require_once __DIR__.'/inc/header.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="form-box">
                <span class="badge bg-primary-subtle text-primary badge-category mb-3">Login</span>
                <h1 class="mb-4">Welcome back</h1>

                <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                </div>
                <?php unset($_SESSION['success']);
                } ?>

                <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                </div>
                <?php unset($_SESSION['error']);
                } ?>


                <form class="form" action="/handle/handleLogin.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required
                            placeholder="Enter your password">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__.'/inc/footer.php'; ?>