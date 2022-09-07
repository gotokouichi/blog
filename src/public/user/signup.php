<?php
session_start();
$errors = $_SESSION['errors'] ?? []; //$_SESSION[errors]がnullだったら？？初期化する
unset($_SESSION['errors']); //初期化する、（）の中消す　errorsのキーごと消す。
//特定の要素を削除する
//変数に入れたから、sessionから削除する
//usernameからでボタン押下→その後usernameを入れた状態でemailが空だったばあい、ふたつのエラーがまた表示されちゃう
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
</head>

<body>
  <div>
    <div>
      <h2>会員登録</h2>
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
      <form action="./signup_complete.php" method="POST">
        <p>
          <input placeholder="User name" type=“text” name="userName" required value="<?php if (
              isset($_SESSION['userName'])
          ) {
              echo $_SESSION['userName']; //アカウント作成ボタン押下後、失敗した時に入力した項目をフォームに表示させる
          } ?>">
        </p>
        <p><input placeholder="Email" type=“mail” name="email" required value="<?php if (
            isset($_SESSION['email'])
        ) {
            echo $_SESSION['email']; //ここの意味
        } ?>"></p>
        <p><input placeholder="Password" type="password" name="password"></p>
        <p><input placeholder="Password確認" type="password" name="confirmPassword"></p>
        <button type="submit">アカウント作成</button>
      </form>
      <a href="./signin.php">ログイン画面へ</a>
    </div>
  </div>
</body>

</html>