<?php require "inc/header.php";

if (isset($_POST['submit'])) {
    $msg;
    $msg_class;

    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $body = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($author) || empty($title) || empty($body)) {
        $msg = 'All fields are required';
        $msg_class = 'err';
    }

    if (empty($msg)) {
        $sql = "INSERT INTO posts (author, title, body) VALUES ('$author', '$title', '$body')";

        if ($conn->query($sql)) {
            $msg = 'Post was added!';
            $msg_class = 'success';
            header("location:" . ROOT_URL);
        } else {
            $msg = "Post wasn't added";
            $msg_class = 'err';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add posts</title>
</head>

<body>

    <main class="add-posts-container">
        <h2>Add Posts</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="add-post-input">
                <label for="author">Author:</label><br>
                <input type="text" name="author">
            </div>

            <div class="add-post-input">
                <label for="title">Title:</label><br>
                <input type="text" name="title">
            </div>

            <div class="add-post-input">
                <label for="post">Post:</label><br>
                <textarea name="post" id="post" cols="30" rows="10"></textarea>
            </div>

            <div class="add-post-input">
                <input type="submit" value="submit" name="submit">
            </div>
        </form>
        </>



        <?php if (isset($_POST['submit'])) : ?>
            <div class='<?php echo "add-post-msg $msg_class"; ?>'>
                <p><?php echo $msg; ?></p>
            </div>
        <?php endif; ?>

        <?php include "inc/footer.php"; ?>
</body>

</html>