<?php
require_once __DIR__.'/inc/connection.php';
require_once __DIR__.'/inc/header.php';
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-box">
                <span class="badge bg-primary-subtle text-primary badge-category mb-3">
                    <?php echo $language['submitBadge'] ?? 'Submit article'; ?>
                </span>
                <h1 class="mb-4"><?php echo $language['submitTitle'] ?? 'Publish a new story'; ?></h1>

                <?php if (isset($_SESSION['errors'])) { ?>
                <?php foreach ($_SESSION['errors'] as $error) { ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php } ?>
                <?php unset($_SESSION['errors']); ?>
                <?php } ?>

                <!-- تعديل المسار ليكون مطلقاً تبدأ بـ / لضمان العمل على Vercel -->
                <form method="POST" action="/handle/handlePosts.php" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <label
                                class="form-label"><?php echo $language['articleTitle'] ?? 'Article title'; ?></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter headline">
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label"><?php echo $language['articleBadge'] ?? 'Article badge'; ?></label>
                            <input type="text" name="badge" class="form-control"
                                placeholder="Example: World, Tech, Politics">
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label"><?php echo $language['articleContent'] ?? 'Article content'; ?></label>
                            <textarea class="form-control" rows="7" name="body"
                                placeholder="Write the full story here..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="addImage"><?php echo $language['addImage'] ?? 'Add image'; ?></label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-lg"><?php echo $language['publishArticle'] ?? 'Publish article'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__.'/inc/footer.php'; ?>