blog_project/assets blog_project/assets/bootstrap.min.css blog_project/create_post.php blog_project/db.php blog_project/delete_post.php blog_project/edit_post.php blog_project/footer.php blog_project/header.php blog_project/index.php blog_project/login.php blog_project/logout.php blog_project/my_posts.php blog_project/profile.php blog_project/signup.php blog_project/view_post.php<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$post_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Ensure post belongs to logged-in user
$result = $conn->query("SELECT * FROM posts WHERE id=$post_id AND user_id=$user_id");

if ($result->num_rows == 0) {
    die("⚠️ You cannot edit this post.");
}

$post = $result->fetch_assoc();

// Update post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $conn->query("UPDATE posts SET title='$title', content='$content' WHERE id=$post_id AND user_id=$user_id");

    header("Location: my_posts.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Post</h2>
    <form method="POST">
        <input type="text" name="title" class="form-control mb-2" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        <textarea name="content" class="form-control mb-2" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="my_posts.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
