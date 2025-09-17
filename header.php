<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Blog</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php session_start(); ?>
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="create_post.php">➕ New Post</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">🚪 Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">🔑 Login</a></li>
          <li class="nav-item"><a class="nav-link" href="signup.php">📝 Signup</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
