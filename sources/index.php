<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/app.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="common/tailwind.config.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {

            background-color: #f9f9f9;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .image-gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
            /* 画像とボタンの間の間隔 */
        }

        .image-gallery img {
            width: 200px;
            height: 200px;
            margin-bottom: 20px;
            /* 画像と画像の間の間隔 */
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="flex flex-col">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <p>チャット相談でお部屋を片付けませんか？</p>
            <button>ログイン</button>
        </div>
        <div class="image-gallery">
            <img src="images/plan_detail1.png" alt="画像1">
            <img src="images/plan_detail2.png" alt="画像2">
            <img src="images/plan_detail3.png" alt="画像3">
            <img src="images/plan_detail4.png" alt="画像4">
        </div>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>

</html>