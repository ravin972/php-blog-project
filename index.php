<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include 'db.php'; // ✅ database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">MyBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_posts.php">📝 My Posts</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_post.php">Create Post</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white me-3">
                                👋 Welcome, <strong><?php echo $_SESSION['name']; ?></strong>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm me-2" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-success btn-sm" href="signup.php">Signup</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2 class="mb-4 text-center">📚 Latest Blog Posts</h2>

        <?php
        // ✅ Fetch posts with authors
        $result = $conn->query("
        SELECT posts.*, users.name 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC
    ");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3 shadow-sm">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">' . htmlspecialchars($row['title']) . '</h4>';

                // ✅ Short preview of content
                $preview = substr($row['content'], 0, 150);
                echo '<p class="card-text">' . nl2br(htmlspecialchars($preview)) . '...</p>';

                echo '<h6 class="text-muted">✍️ By: ' . htmlspecialchars($row['name']) . ' | 🕒 ' . $row['created_at'] . '</h6>';

                // ✅ Read More button
                echo '<a href="view_post.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm mt-2">Read More</a>';

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning">No blog posts found. Be the first to create one!</div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>