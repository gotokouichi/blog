<?php
session_start();
require_once('../utils/pdo.php');

$userId = $_SESSION['id'];
$blogId = filter_input(INPUT_POST, 'blog_id', FILTER_VALIDATE_INT);
$commenterName = filter_input(INPUT_POST, 'commenter_name', FILTER_SANITIZE_SPECIAL_CHARS);
$commentContent = filter_input(INPUT_POST, 'comment_content', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "INSERT INTO comments(user_id, blog_id, commenter_name, comments)VALUES(:user_id, :blog_id, :commenter_name, :comments)";
try {
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindValue(':blog_id', $blogId, PDO::PARAM_INT);
    $statement->bindValue(':commenter_name', $commenterName, PDO::PARAM_STR);
    $statement->bindValue(':comments', $commentContent, PDO::PARAM_STR);
    $statement->execute();
    header("Location: ../post/detail.php?id=" . $blogId);
    exit;
} catch (PDOException $e) {
    $_SESSION['errors'][] = 'コメントの投稿に失敗しました。';
    header("Location: ../post/detail.php?id=" . $blogId);
    exit;
}
