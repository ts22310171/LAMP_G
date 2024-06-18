<?php
//フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$dsn = "mysql:host=localhost; dbname=xxx; charset=utf8";
$username = "xxx";
$password = "xxx";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

//フォームに入力されたemailがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$member = $stmt->fetch();
if ($member['email'] === $email) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO users(name, email, password) VALUES (:name, :email, :password)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="login.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="css/shinkitouroku.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo">GarbaGe</div>
            <ul class="nav-links">
                <li><a href="#login">ログイン</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="register-box">
            <h1>新規会員登録</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="ユーザー名" required>
                    <p class="note">※記号不可</p>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="メールアドレス" required>
                    <p class="note">※登録済みのメールアドレスは利用できません。</p>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="パスワード" required>
                    <p class="note">※半角英数8~16文字</p>
                </div>
                <button type="submit">登録</button>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; Wiz株式会社 team-G .2024</p>
    </footer>
</body>
</html>
