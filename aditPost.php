<?php 
require_once __DIR__ . '/inc/connection.php';

require_once __DIR__ . '/inc/header.php';

if (!isset($_GET['id'])) {
    header('location: /index.php');
    exit;
}

$id = (int)$_GET['id'];

$query = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
} else {
    $post = null;
}
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-box">
                <span class="badge bg-primary-subtle text-primary badge-category mb-3"
                    data-i18n="editBadge"><?php echo $language['editBadge'] ?? 'Edit article'; ?></span>
                <h1 class="mb-4" data-i18n="editTitle"><?php echo $language['editTitle'] ?? 'Update existing story'; ?></h1>

                <?php if ($post) { ?>
                <form method="POST" action="/handle/handleUpdate.php?id=<?php echo $post['id']; ?>" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleTitle"><?php echo $language['articleTitle'] ?? 'Article-title'; ?></label>
                            <input type="text" class="form-control" name="badge" value="<?php echo htmlspecialchars($post['badge']); ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleSummary"><?php echo $language['articleSummary'] ?? 'Summary'; ?></label>
                            <textarea class="form-control" name="title" rows="3"><?php echo htmlspecialchars($post['title']); ?></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleContent"><?php echo $language['articleContent'] ?? 'Article content'; ?></label>
                            <textarea class="form-control" name="body" rows="8"><?php echo htmlspecialchars($post['body']); ?></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label d-block"
                                data-i18n="addImage"><?php echo $language['addImage'] ?? 'Add image'; ?></label>
                            <input type="file" class="form-control mb-3" name="image">
                            
                            <img src="/assets/image/postImage/<?php echo htmlspecialchars($post['image']); ?>"
                                class="img-thumbnail w-25" alt="Current Image">
                        </div>

                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-lg"><?php echo $language['saveChanges'] ?? 'Save Changes'; ?></button>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                
                <img src="/assets/image/notFound.png" alt="No post found" class="w-100 h-100 object-fit-cover">
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>
