<?php
session_start();

require_once('../utils/pdo.php');

$userId = filter_input(INPUT_POST, 'blog_id', FILTER_VALIDATE_INT);
$blogTitle = filter_input(INPUT_POST, 'blog_title', FILTER_SANITIZE_SPECIAL_CHARS);
$contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE blogs SET title = :blogTitle, contents = :contents WHERE id = :userId";
try {
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':blogTitle', $blogTitle, PDO::PARAM_STR);
  $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
  $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
  $statement->execute();
  header("Location: ../user/mypage.php?id=" . $userId);
  exit;
} catch (PDOException $e) {
  $_SESSION['errors'][] = 'ブログ記事の編集に失敗しました。';
  header("Location: ./edit.php");
  exit;
}
