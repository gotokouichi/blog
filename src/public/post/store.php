<?php
session_start();

require_once('../utils/pdo.php');

$userId = $_SESSION['id'];
$blogTitle = filter_input(INPUT_POST, 'blog_title', FILTER_SANITIZE_SPECIAL_CHARS);
$contents = filter_input(INPUT_POST, 'contents', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "INSERT INTO blogs(user_id, title, contents) VALUES(:userId, :blogTitle, :contents)";
try {
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
  $statement->bindValue(':blogTitle', $blogTitle, PDO::PARAM_STR);
  $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
  $statement->execute();
  header("Location: ../user/mypage.php");
  exit;
} catch (PDOException $e) {
  $_SESSION['errors'][] = 'ブログ記事の登録に失敗しました。';
  header("Location: ./create.php");
  exit;
}
