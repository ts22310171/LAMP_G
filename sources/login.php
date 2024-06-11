<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Script -->
  <link rel="stylesheet" href="../../css/app.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../../common/tailwind.config.js"></script>
</head>

<body class="bg-main">
  <?php include('common//header.php'); ?>
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-black md:text-2xl">
          ログイン
        </h1>
        <form class="space-y-4 md:space-y-6" action="#">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-black">メールアドレス</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[230px] p-2.5" placeholder="name@company.com" required="">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">パスワード</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[230px] p-2.5" required="">
          </div>
          <div class="flex items-center justify-between">
            <a href="#" class="text-sm font-medium text-primary-600 hover:underline ">パスワードをお忘れですか？</a>
          </div>
          <button type="submit" class="w-full text-white bg-sub hover:bg-subhover focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">ログイン</button>
          <p class="flex justify-center text-sm font-light text-gray-500 ">
            <a href="#" class="font-medium text-primary-600 hover:underline">会員登録</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>