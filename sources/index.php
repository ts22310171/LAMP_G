<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
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
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/sources/common/header.php"); ?>
    <div class="container">
        <p>チャット相談でお部屋を片付けませんか？</p>
        <button>ログイン</button>

    </div>
    <div class="image-gallery">
        <img src="images/plan_detail1.png" alt="画像1">
        <img src="images/plan_detail2.png" alt="画像2">
        <img src="images/plan_detail3.png" alt="画像3">
        <img src="images/plan_detail4.png" alt="画像4">
    </div>

</body>

</html>