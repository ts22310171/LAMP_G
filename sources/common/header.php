<?php

session_start();

require('libs.php');

$user_name = $_SESSION['user_name'];


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/css/app.css" />

  <!-- Script -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="tailwind.config.js"></script>
</head>

<body class="bg-main">
  <header>
    <div class="bg-main h-20 flex justify-between items-center fixed top-0 left-0 w-full z-10 h-16">
      <div class="flex items-center">
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/index.php" class="flex items-center">
          <img src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/images/GarbaGe favicon2.png" width="60" height="60" class="ml-4" />
          <div class="-ml-2 text-2xl text-black font-bold">
            Garba<span class="text-sub">Ge</span>
          </div>
        </a>
      </div>

      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
        <div class="relative">
          <div class="rounded shadow bg-whitecolor p-2">
            <button class="text-blackcolor" id="btn">
              <?php echo h($user_name); ?>
              <i class="fa-solid fa-chevron-down text-explain" id="arrow"></i>
            </button>
          </div>
          <div class="dropdown hidden absolute right-0 mt-2 py-2 w-48 bg-white border rounded shadow-xl" id="dropdown">
            <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-0"><i class="fa-solid fa-user"></i>マイページ</a>
            <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-1"><i class="fa-solid fa-comment"></i>チャットルーム</a>
            <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/settigs.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>アカウント設定</a>
            <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/logout.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>ログアウト</a>
          </div>
        </div>
      <?php else : ?>
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/login.php" class="text-base text-black font-bold mr-5">
          ログイン
        </a>
      <?php endif; ?>
    </div>
  </header>
  <script src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/js/header.js"></script>
</body>

</html>