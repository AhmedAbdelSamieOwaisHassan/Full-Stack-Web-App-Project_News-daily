<?php
require_once __DIR__.'/inc/connection.php';

require_once __DIR__.'/inc/header.php';

if (!isset($_GET['id'])) {
    header('location: /index.php');
    exit;
}

$id = (int) $_GET['id'];

$query = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
} else {
    $post = null;
}
?>

<main class="container py-5">
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm overflow-hidden">
                <?php if ($post) { ?>
                <div class="image-placeholder feature-image d-flex align-items-center justify-content-center">
                    <img src="/assets/image/postImage/<?php echo htmlspecialchars($post['image']); ?>" alt="Post title"
                        class="img-fluid w-100 feature-image">
                </div>

                <div class="p-4 p-lg-5">

                    <span class="badge bg-primary-subtle text-primary badge-category mb-3">
                        <?php echo htmlspecialchars($post['badge']); ?>
                    </span>

                    <h1 class="fw-bold mb-3">
                        <?php echo htmlspecialchars($post['title']); ?>
                    </h1>

                    <div class="text-secondary lead mb-4">
                        <?php echo htmlspecialchars($post['body']); ?>
                    </div>

                    <div class="article-body mt-4">
                        <small class="text-muted">
                            <?php echo htmlspecialchars($post['created_at']); ?>
                        </small>
                    </div>

                </div>
                <?php } else { ?>
                <img src="/assets/image/notFound.png" alt="No posts found" class="w-100 h-100 object-fit-cover">
                <?php } ?>
            </div>
        </div>

        <?php if ($post) { ?>
        <div class="col-lg-4">
            <div class="sidebar-box">

                <h4 class="fw-bold mb-3">Actions & Options</h4>

                <div class="d-grid gap-3">

                    <a href="/viewPost.php?id=<?php echo $post['id']; ?>" class="text-decoration-none text-dark">
                        <div class="border rounded-3 p-3 bg-light">
                            <small class="text-primary fw-semibold">
                                <?php echo htmlspecialchars($post['badge']); ?>
                            </small>

                            <div class="fw-semibold mt-2">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </div>
                        </div>
                    </a>


                    <a href="/editPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">
                        Edit Post
                    </a>


                    <a href="/handle/handleDeletePost.php?id=<?php echo $post['id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this post?');">
                        Delete Post
                    </a>

                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</main>

<?php require_once __DIR__.'/inc/footer.php'; ?>
