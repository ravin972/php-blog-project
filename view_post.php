<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$post_id = intval($_GET['id']); // security
$result = $conn->query("
    SELECT posts.*, users.name 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = $post_id
");

if ($result->num_rows == 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();

// ✅ Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $comment = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $post_id, $user_id, $comment);
        $stmt->execute();
        $stmt->close();

        // Refresh after comment
        header("Location: view_post.php?id=".$post_id);
        exit;
    }
}

// ✅ Fetch comments
$comments = $conn->query("
    SELECT comments.*, users.name 
    FROM comments 
    JOIN users ON comments.user_id = users.id 
    WHERE comments.post_id = $post_id
    ORDER BY comments.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <a href="index.php" class="btn btn-secondary mb-3">⬅ Back to Home</a>
    
    <!-- Blog Post -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p class="text-muted">✍️ By <?php echo htmlspecialchars($post['name']); ?> | 🕒 <?php echo $post['created_at']; ?></p>
            <hr>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>
    </div>

    <!-- Comment Form -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5>💬 Leave a Comment</h5>
                <form method="POST">
                    <textarea name="comment" class="form-control mb-2" rows="3" required></textarea>
                    <button type="submit" class="btn btn-primary btn-sm">Submit Comment</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            Please <a href="login.php">login</a> to comment.
        </div>
    <?php endif; ?>

    <!-- Show Comments -->
    <h4>📝 Comments</h4>
    <?php
    if ($comments->num_rows > 0) {
        while ($c = $comments->fetch_assoc()) {
            echo '<div class="card mb-2">';
            echo '<div class="card-body">';
            echo '<p>'.nl2br(htmlspecialchars($c['comment'])).'</p>';
            echo '<small class="text-muted">By <strong>'.htmlspecialchars($c['name']).'</strong> on '.$c['created_at'].'</small>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-muted">No comments yet. Be the first to comment!</p>';
    }
    ?>
</div>
</body>
</html>
