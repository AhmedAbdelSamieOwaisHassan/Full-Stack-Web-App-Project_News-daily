<?php
require_once __DIR__.'/../inc/connection.php';
require_once __DIR__.'/../inc/header.php';

$numPostsQuery = 'SELECT COUNT(id) as total FROM posts';
$resQuery = mysqli_query($connection, $numPostsQuery);
$totalPosts = mysqli_fetch_assoc($resQuery)['total'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 5;
$offset = ($page - 1) * $limit;
$numberOfPages = ceil($totalPosts / $limit);

if ($page < 1) {
    header('location:index.php?page=1');
    exit;
} elseif ($page > $numberOfPages) {
    header("location:index.php?page=$numberOfPages");
    exit;
}

$query = "SELECT * FROM posts LIMIT 6 OFFSET $offset ";

$result = mysqli_query($connection, $query);
$numberOFposts = mysqli_num_rows($result);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<main>
    <section class="hero-wrap">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <div class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold mb-3">
                        <?php echo $language['TOPSTORY'] ?? 'Article content'; ?>
                    </div>
                    <h1 class="display-5 fw-bold mb-3"><?php echo $language['Global'] ?? 'Global'; ?></h1>
                    <p class="lead text-secondary mb-4"> <?php echo $language['Governments'] ?? 'Governments'; ?></p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <a href="viewPost.php?id=1" class="btn btn-primary btn-lg"
                            data-i18n="readFullStory"><?php echo $language['readFullStory'] ?? 'readFullStory'; ?></a>
                        <span class="text-secondary small"
                            data-i18n="updated"><?php echo $language['updated'] ?? 'updated'; ?></span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div
                        class="image-placeholder feature-image d-flex align-items-center justify-content-center rounded-4 shadow w-100 overflow-hidden">
                        <img src="/assets/image/NewsDaily.jpg" alt="News Daily" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0"><?php echo $language['Latest'] ?? 'Latest headlines'; ?></h2>
            <a href="viewPost.php?id=1"
                class="text-decoration-none fw-semibold"><?php echo $language['seeAll'] ?? 'See All'; ?></a>
        </div>
        <?php if (isset($_SESSION['success'])) {?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; ?>
        </div>

        <?php } unset($_SESSION['success']); ?>
        <?php if ($numberOFposts > 0) { ?>
        <div class="row g-4">
            <?php foreach ($posts as $post) { ?>
            <div class="col-md-6 col-xl-4">
                <article class="card news-card shadow-sm h-100">
                    <div class="image-placeholder d-flex align-items-center justify-content-center card-img-top">
                        <img class="w-100 h-100 object-fit-cover"
                            src="/assets/image/postImage/<?php echo htmlspecialchars($post['image']); ?>"
                            alt="<?php echo htmlspecialchars($post['title']); ?>">
                    </div>
                    <div class="card-body d-flex flex-column ">
                        <span class="badge bg-info-subtle text-info badge-category mb-3">
                            <?php echo htmlspecialchars($post['badge']); ?>
                        </span>
                        <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                        <p class="card-text text-secondary"><?php echo htmlspecialchars($post['body']); ?></p>
                        <span class="badge bg-info-subtle text-info badge-category mb-3">
                            <?php echo htmlspecialchars($post['created_at']); ?>
                        </span>
                        <a href="viewPost.php?id=<?php echo $post['id']; ?>"
                            class="btn btn-info mt-auto"><?php echo $language['View'] ?? 'View'; ?></a>
                    </div>
                </article>
            </div>
            <?php } ?>
        </div>
        <?php } else { ?>
        <img src="/assets/image/images.png" alt="No posts found" class="w-100 h-100 object-fit-cover">
        <?php } ?>
    </section>
    <nav aria-label="..." class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item <?php if ($page == 1) {
                echo 'disabled';
            } ?> "><a href="index.php?page=<?php echo $page - 1; ?>"
                    class="page-link"><?php echo $language['Previous'] ?? 'Previous'; ?></a>
            </li>

            <?php for ($i = 1; $i <= $numberOfPages; ++$i) { ?>
            <li class="page-item"><a class="page-link <?php if ($page == $i) {
                echo 'active';
            } ?>" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php } ?>
            <li class="page-item <?php if ($page == $numberOfPages) {
                echo 'disabled';
            } ?>"><a class="page-link"
                    href="index.php?page=<?php echo $page + 1; ?>"><?php echo $language['Next'] ?? 'Next'; ?></a></li>
        </ul>
    </nav>
    <section class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <h2 class="section-title mb-4"><?php echo $language['mostDiscussed'] ?? 'mostDiscussed'; ?></h2>
                <div class="list-group shadow-sm">
                    <a href="viewPost.php?id=5" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex justify-content-between gap-3">
                            <div>
                                <small class="text-primary fw-semibold">Politics</small>
                                <h6 class="mt-2 mb-1">Election campaigns intensify as local priorities dominate debate
                                </h6>
                            </div>
                            <small class="text-secondary">2h ago</small>
                        </div>
                    </a>
                    <a href="viewPost.php?id=6" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex justify-content-between gap-3">
                            <div>
                                <small class="text-primary fw-semibold">Health</small>
                                <h6 class="mt-2 mb-1">Public health agencies launch broader screening initiatives</h6>
                            </div>
                            <small class="text-secondary">5h ago</small>
                        </div>
                    </a>
                    <a href="viewPost.php?id=1" class="list-group-item list-group-item-action p-3">
                        <div class="d-flex justify-content-between gap-3">
                            <div>
                                <small class="text-primary fw-semibold">Economy</small>
                                <h6 class="mt-2 mb-1">Trade agreements create new opportunities for resilient supply
                                    chains</h6>
                            </div>
                            <small class="text-secondary">8h ago</small>
                        </div>
                    </a>
                </div>
            </div>

            <aside class="col-lg-4">
                <div class="sidebar-box">
                    <h4 class="fw-bold mb-3" data-i18n="trendingNow">Trending now</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><a href="viewPost.php?id=2" class="text-decoration-none">AI tools reshape
                                office productivity</a></li>
                        <li class="mb-3"><a href="viewPost.php?id=3" class="text-decoration-none">Retail growth returns
                                to urban centers</a></li>
                        <li class="mb-3"><a href="viewPost.php?id=4" class="text-decoration-none">New transit networks
                                reduce travel times</a></li>
                        <li class="mb-0"><a href="viewPost.php?id=5" class="text-decoration-none">Campaigns focus on
                                everyday concerns</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</main>

<?php include __DIR__.'/../inc/footer.php'; ?>