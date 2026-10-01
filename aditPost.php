<?php require_once 'inc/header.php';
require_once 'inc/connection.php';

if (!isset($_GET['id'])) {
    header('location:index.php');
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE  id=$id";

$result = mysqli_query($connection, $query);

$post = mysqli_fetch_assoc($result);

?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-box">
                <span class="badge bg-primary-subtle text-primary badge-category mb-3"
                    data-i18n="editBadge"><?php echo $language['editBadge'] ?? 'Edit article'; ?></span>
                <h1 class="mb-4" data-i18n="editTitle"><?php echo $language['editTitle'] ?? 'Update existing story'; ?>
                </h1>
                <?php if (mysqli_num_rows($result) > 0) {?>

                <form method="POST" action="handle/handleUpdate.php?id=<?php echo $post['id']; ?>"
                    enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleTitle"><?php echo $language['articleTitle'] ?? 'Article-title'; ?></label>
                            <input type="text" class="form-control" name="badge" value="<?php echo $post['badge']; ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleSummary"><?php echo $language['articleSummary'] ?? 'Summary'; ?></label>
                            <textarea class="form-control" name="title"
                                rows="3"><?php echo $post['title']; ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="articleContent"><?php echo $language['articleContent'] ?? 'Article content'; ?></label>
                            <textarea class="form-control" name="body" rows="8"><?php echo $post['body']; ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label"
                                data-i18n="addImage"><?php echo $language['addImage'] ?? 'Add image'; ?></label>
                            <input type="file" class="btn btn-secondary" name="image">
                            <img src="assets/image/postImage/<?php echo $post['image']; ?>" type="file"
                                class="btn btn-secondary w-25" name="image">
                        </div>
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-lg"><?php echo $language['saveChanges'] ?? 'saveChanges'; ?></button>
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                <img src="./assets/image/notFound.png" alt="No posts found" class="w-100 h-100 object-fit-cover">
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<?php include 'inc/footer.php'; ?>