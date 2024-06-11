<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="../css/app.css">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="common/tailwind.config.js"></script>

</head>

<body class="bg-main">
  <header>
    <nav class="bg-main shadow-md h-16 flex justify-between items-center ">
      <div class="flex items-center">
        <a href="/index.php" class="flex items-center">
          <img src="images/GarbaGe favicon2.png" width="60" height="60" class="ml-4">
          <div class="-ml-2 text-2xl text-blackcolor font-bold">Garba<span class="text-sub">Ge</span></div>
        </a>
      </div>
      <div>
        <button onclick="location.href='../user/auth/login.php'" class="text-base text-blackcolor font-bold mr-5">ログイン</button>
      </div>
    </nav>
  </header>
</body>

</html>