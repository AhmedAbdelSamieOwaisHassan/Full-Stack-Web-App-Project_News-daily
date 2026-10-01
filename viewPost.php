<?php
require_once 'inc/header.php';
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
    <div class="row g-4">

        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm overflow-hidden">
                <?php if (mysqli_num_rows($result) > 0) {?>
                <div class="image-placeholder feature-image d-flex align-items-center justify-content-center">
                    <img src="assets/image/postImage/<?php echo $post['image']; ?>" alt="Post title"
                        class="img-fluid w-100 feature-image">
                </div>

                <div class="p-4 p-lg-5">

                    <span class="badge bg-primary-subtle text-primary badge-category mb-3">
                        <?php echo $post['badge']; ?>
                    </span>

                    <h1 class="fw-bold mb-3">
                        <?php echo $post['title']; ?>

                    </h1>

                    <div class="text-secondary small mb-4">
                        <?php echo $post['body']; ?>

                    </div>

                    <!-- <p class="lead text-secondary">
                       

                    </p> -->

                    <div class="article-body mt-4">
                        <p>
                            <?php echo $post['created_at']; ?>

                        </p>
                    </div>

                </div>
                <?php } else { ?>
                <img src="./assets/image/notFound.png" alt="No posts found" class="w-100 h-100 object-fit-cover">
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-box">

                <h4 class="fw-bold mb-3">More stories</h4>

                <div class="d-grid gap-3">

                    <a href="viewPost.php" class="text-decoration-none text-dark">
                        <div class="border rounded-3 p-3 bg-light">
                            <small class="text-primary fw-semibold">
                                <?php echo $post['badge']; ?>

                            </small>

                            <div class="fw-semibold mt-2">
                                <?php echo $post['title']; ?>

                            </div>
                        </div>
                    </a>

                    <a href="aditPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">
                        Edit Post
                    </a>

                    <a href="handle/handleDeletePost.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">
                        Delete Post
                    </a>

                </div>
            </div>
        </div>

    </div>
</main>