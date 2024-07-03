<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>

  <!-- フォント -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- スタイルシート -->
  <link rel="stylesheet" href="../css/app.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../common/tailwind.config.js"></script>
</head>
<body>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="container">
        <div class="complete-box">
            <h1><br>パスワード再設定メールを</br>送信しました</h1>
            <p>入力されたメールアドレス宛にパスワード再設定のためのリンクを送信しました。メールをご確認ください。</p>
            <a href="/login" class="button">ログイン画面に戻る</a>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
