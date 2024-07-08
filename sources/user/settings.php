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
        <h1>設定画面</h1>
        
        <!-- アカウント情報セクション -->
        <div class="section">
            <h2>アカウント情報</h2>
            <form action="/update_account" method="post">
                <div class="form-group">
                    <label for="username">ユーザー名</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="button">保存</button>
                </div>
            </form>
        </div>
        
        <!-- パスワードの更新セクション -->
        <div class="section">
            <h2>パスワードの更新</h2>
            <form action="/update_password" method="post">
                <div class="form-group">
                    <label for="current_password">現在のパスワード</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">新しいパスワード</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">新しいパスワードの確認</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="button">更新</button>
                </div>
            </form>
        </div>
        
        <!-- アカウント削除セクション -->
        <div class="section">
            <h2>アカウント削除</h2>
            <form action="/delete_account" method="post">
                <div class="form-group">
                    <button type="submit" class="button delete-button">アカウント削除</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
