<?php

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ入力</title>

    <!-- フォント -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- スタイルシート -->
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../common/tailwind.config.js"></script>
</head>

<body class="bg-main">
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="p-6 max-w-3xl mx-auto mt-20 mb-20">
        <?php if ($mode == "input") : ?>
            <div>
                <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
                    お問い合わせ詳細
                </h1>
                <div>お問い合わせをいただく前に、<a href="">よくあるご質問をご確認ください。</a></div>
                <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前<span class="text-alarm">*</span></label>
                        <input type="text" name="name" value="<?php echo $name ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス<span class="text-alarm">*</span></label>
                        <input type="email" name="email" value="<?php echo $email ?>" required class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                        <input type="tel" name="phone" value="<?php echo $phone ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容<span class="text-alarm">*</span></label>
                        <textarea name="message" value="<?php echo $message ?>" rows="12" required class="text-sm mt-1 block w-full p-4 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main"></textarea>
                    </div>
                    <div class="">
                        <button type="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                            送信する
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif ($mode == "confirm") : ?>
            <div>
                <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前<span class="text-alarm">*</span></label>
                        <input type="text" name="name" value="<?php echo $name ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス<span class="text-alarm">*</span></label>
                        <input type="email" name="email" value="<?php echo $email ?>" required class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                        <input type="tel" name="phone" value="<?php echo $phone ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容<span class="text-alarm">*</span></label>
                        <textarea name="message" value="<?php echo $message ?>" rows="12" required class="text-sm mt-1 block w-full p-4 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main"></textarea>
                    </div>
                    <div class="">
                        <button type="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                            送信する
                        </button>
                    </div>
                </form>
            </div>
        <?php else : ?>
            <div>
                <h1>お問い合わせありがとうございます</h1>
                <p>
                    お問い合わせありがとうございました
                    スタッフがお問い合わせいただいた内容を確認させていただきます。
                    必ずしも返信を伴うわけではないこと、ご了承いただきますようよろしくお願いいたします。<br />担当者より折り返しご連絡いたします。
                </p>
                <a href="/" class="button">ホームへ戻る</a>
            </div>
        <?php endif; ?>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>

</html>