<?php
// session_start();
if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'en';
}

if ($lang == 'ar') {
    require_once __DIR__.'/../lang/languages_ar.php';
} else {
    require_once __DIR__.'/../lang/languages_en.php';
}

?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" dir="<?php echo $language['dir']; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsDaily | Latest Headlines</title>
    
    <link rel="stylesheet" href="/vender/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="topbar py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <span data-i18n="breaking"><?php echo $language['breaking']; ?></span>
            <span class="d-none d-md-inline" data-i18n="date"><?php echo date('l, j F Y'); ?></span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/index.php"> <?php echo $language['Newsdaily']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-3">
                    <li class="nav-item"><a class="nav-link active"
                            href="/index.php"><?php echo $language['home']; ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="/about.php"><?php echo $language['about']; ?></a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="/viewPost.php?id=1"><?php echo $language['featured']; ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/contact.php"><?php echo $language['contact']; ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/addPost.php"><?php echo $language['submit']; ?></a>
                    </li>
                </ul>

                <div class="nav-actions">
                    <div class="btn-group" role="group" aria-label="Language switcher">
                        <?php if (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ar') {?>
                        <a href="/inc/lang.php?lang=en" type="button" class="lang-btn active" data-lang="en">EN</a>
                        <?php } else {?>
                        <a href="/inc/lang.php?lang=ar" type="button" class="lang-btn" data-lang="ar">AR</a>
                        <?php } ?>
                    </div>

                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="/handle/handleLogout.php"
                        class="btn btn-light btn-sm"><?php echo $language['logout']; ?></a>
                    <?php } else { ?>
                    <a href="/login.php" class="btn btn-light btn-sm"><?php echo $language['login']; ?></a>
                    <a href="/register.php" class="btn btn-outline-light btn-sm"><?php echo $language['register']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>