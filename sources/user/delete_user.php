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
        <div class="delete-box">
            <form action="/delete-account" method="POST" class="delete-form">
                <h1>アカウント削除確認</h1>
                <p>本当にアカウントを削除してもよいですか？この操作は元に戻せません。</p>
                <div class="input-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" placeholder="パスワードを入力してください" required>
                </div>
                <div class="forgot-password">
                    <a href="/reset-password">パスワードを忘れた場合</a>
                </div>
                <div class="button-group">
                    <button type="button" class="cancel-button" onclick="window.history.back()">キャンセル</button>
                    <button type="submit" class="delete-button">アカウントを削除する</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
