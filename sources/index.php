<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Script -->
    <link rel="stylesheet" href="css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="common/tailwind.config.js"></script>
</head>

<body class="bg-main">
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="flex flex-col items-center justify-center min-h-screen py-8">
        <p class="mb-4 text-center">チャット相談でお部屋を片付けませんか？</p>
        <button class="px-4 py-2 mb-8 text-white bg-blue-500 rounded hover:bg-blue-600">ログイン</button>
        <div class="flex flex-wrap justify-center gap-4">
            <img class="w-48 h-48" src="images/plan_detail1.png" alt="画像1">
            <img class="w-48 h-48" src="images/plan_detail2.png" alt="画像2">
            <img class="w-48 h-48" src="images/plan_detail3.png" alt="画像3">
            <img class="w-48 h-48" src="images/plan_detail4.png" alt="画像4">
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>

</html>