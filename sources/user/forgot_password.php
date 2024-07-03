<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD:sources/user/forgot-password.html
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="../css/repassword.css">
=======
    <title>パスワード忘れ</title>
    <link rel="stylesheet" href="css/repassword.css">
>>>>>>> develop:sources/forgot-password.html
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="container">
        <div class="reset-box">
        <form action="/send-reset-email" method="POST" class="reset-form">
            <h1>パスワード再設定メールを送る</h1>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="メールアドレス" required>
                    <p class="note">※登録済みのメールアドレスを入力してください。</p>
                </div>
                <button type="submit">メールを送信</button>
        </form>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
