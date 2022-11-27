<?php
require "inc/header.php";

if (isset($_POST['dlt'])) {
    $deleted_post_id = $_POST['dlt_id'];

    $sql_dlt = "DELETE FROM Posts WHERE id = $deleted_post_id";
    $conn->query($sql_dlt);
}

$sql = "SELECT * FROM Posts ORDER BY created_at DESC";
$result = $conn->query($sql);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$no_posts_msg;
$container_class;

if (empty($posts)) {
    $no_posts_msg = 'There are no posts.';
    $container_class = 'empty';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Posts</title>
</head>

<body>
    <main class="container">
        <h1>Posts</h1>

        <?php if (isset($no_posts_msg)) : ?>
            <p class="no-posts-msg"><?php echo $no_posts_msg; ?></p>
        <?php endif; ?>

        <div class="post-container <?php echo $container_class; ?>">
            <?php foreach ($posts as $post) : ?>
                <div class="post">

                    <div class="post-header">
                        <div class="post-header-tags">
                            <h3 class="post-title">
                                <?php echo $post['title']; ?>
                            </h3>
                            <span class="post-author">
                                <?php echo "by {$post['author']} at {$post['created_at']}"; ?>
                            </span>
                        </div>

                        <div class="edit-dlt-container">

                            <div class="post-header-edit">
                                <form action="<?php echo ROOT_URL; ?>editpost.php" method="post">

                                    <input type="hidden" name="edit_id" value="<?php echo $post['id']; ?>">

                                    <input type="submit" name="edit" value="edit" id="edit-btn">
                                </form>
                            </div>

                            <div class="post-header-dlt">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                                    <input type="hidden" name="dlt_id" value="<?php echo $post['id']; ?>">

                                    <input type="submit" name="dlt" value="delete" id="dlt-btn">
                                </form>
                            </div>
                        </div>
                    </div>

                    <p class="post-body">
                        <?php echo $post['body']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include "inc/footer.php"; ?>

</body>

</html>