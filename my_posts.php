<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM posts WHERE user_id = $user_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">📝 My Blog Posts</h2>

    <a href="create_post.php" class="btn btn-success mb-3">➕ Create New Post</a>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 150))); ?>...</p>
                <small class="text-muted">Posted on: <?php echo $row['created_at']; ?></small>
                <br><br>
                <a href="view_post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View</a>
                <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_post.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
            </div>
        </div>
    <?php } ?>
    <a href="index.php" class="btn btn-secondary mt-3">⬅ Back to Home</a>
</div>

</body>
</html>
