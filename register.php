<?php
session_start();
require_once __DIR__.'/inc/header.php';

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="form-box">
                <?php if (!empty($errors)) { ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error) { ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>

                <span class="badge bg-primary-subtle text-primary badge-category mb-3">Register</span>
                <h1 class="mb-4">Create your account</h1>


                <form class="form" action="/handle/handleRegister.php" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="name">Full name</label>
                        <input type="text" id="name" name="name" class="form-control" required
                            value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>"
                            placeholder="Enter your full name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required
                            value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required
                            value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>" placeholder="Enter your phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required
                            placeholder="Enter your password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="confirmPassword">Confirm password</label>
                        <input type="password" id="confirmPassword" name="confirm_password" class="form-control"
                            required placeholder="Re-enter your password">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the terms and conditions
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign up</button>

                    <p class="text-center text-secondary small mt-3 mb-0">
                        <span>Already have an account?</span>

                        <a href="/login.php" class="text-decoration-none">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__.'/inc/footer.php'; ?>