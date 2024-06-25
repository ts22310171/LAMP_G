<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Script -->
  <link rel="stylesheet" href="../css/app.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../common/tailwind.config.js"></script>
</head>

<body class="bg-main">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg border border-graycolor md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="flex justify-center text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
          ログイン
        </h1>
        <form class="space-y-4 md:space-y-6" action="" method="post">
          <div class="px-6">
            <label class="block mb-2 text-base font-bold text-blackcolor">メールアドレス</label>
            <input type="email" name="email" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none  focus:border-explain block w-full p-2" placeholder="mail@example.com" required>
          </div>
          <div class="px-6">
            <label class="block mb-2 text-base font-bold text-blackcolor">パスワード</label>
            <input type="password" name="password" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none  focus:border-explain block w-full p-2" required>
          </div>
          <div class="flex items-center justify-center ">
            <a href="#" class="text-sm font-medium text-sub hover:underline hover:text-subhover ">パスワードをお忘れですか？</a>
          </div>
          <div class="px-6">
            <button type="submit" class="w-full text-whitecolor bg-sub hover:bg-subhover rounded-lg py-2.5 text-center">ログイン</button>
          </div>
          <div class="border-t border-graycolor my-4"></div>
          <p class="flex justify-center text-sm font-light text-gray-500 ">
            <a href="register.php" class="font-medium text-primary-600 underline hover:text-explain">会員登録</a>
          </p>
        </form>
      </div>
    </div>
  </div>

</body>

</html>