<?php include 'header.php'; include 'db.php';

if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $title = $_POST['title'];
  $content = $_POST['content'];
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $title, $content, $user_id);
  $stmt->execute();
  header("Location: index.php");
}
?>

<h2>➕ Create New Post</h2>
<form method="POST" class="mt-3">
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control" rows="5" required></textarea>
  </div>
  <button type="submit" class="btn btn-success">Publish</button>
</form>

<?php include 'footer.php'; ?>
