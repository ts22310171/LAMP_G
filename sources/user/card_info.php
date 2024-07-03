<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クレジットカード情報入力</title>
    <link rel="stylesheet" href="../css/card.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
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
