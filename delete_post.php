<?php
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

// Delete only if post belongs to user
$conn->query("DELETE FROM posts WHERE id=$post_id AND user_id=$user_id");

header("Location: my_posts.php");
exit;
?>
