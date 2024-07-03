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
        <div class="credit-card-box">
            <form action="/submit-credit-card" method="POST" class="credit-card-form">
                <h1>クレジットカード情報入力</h1>
                <div class="input-row">
                    <div class="input-group">
                        <label for="card-number">カード番号</label>
                        <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="input-group">
                        <label for="card-holder">カード名義</label>
                        <input type="text" id="card-holder" name="card-holder" placeholder="TARO YAMADA" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label for="expiry-date">有効期限</label>
                        <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>
                    </div>
                    <div class="input-group">
                        <label for="cvv">セキュリティコード</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" required>
                    </div>
                </div>
                <button type="submit">送信</button>
            </form>
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>
</html>
