<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="css/repassword.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="container">
        <div class="reset-box">
        <form action="/send-reset-email" method="POST" class="reset-form">
            <h1>パスワード再設定</h1>
                <div class="input-group">
                    <input type="password" id="email" name="password" placeholder="新しいパスワードを入力" required>
                </div>
                <button type="submit">パスワードの更新</button>
        </form>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
