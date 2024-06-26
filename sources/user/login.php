<?php
session_start();

require('../common/libs.php');

/* 既にログインしている場合、ダッシュボードへリダイレクト */
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: ../index.php');
    exit();
}

/* submitボタンが押されたときに動作する */
$error = [];
$email = '';
$password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    if ($email === '' || $password === '') {
        $error['login'] = 'blank';
    } else {
        // ログインチェック
        $db = dbconnect();
        // limit 1とすることでデータが全部出ていくことを防ぐ
        $stmt = $db->prepare('select id, user_name, password from users where email=? limit 1');
        if (!$stmt) {
            die($db->error);
        }
        $stmt->bind_param('s', $email);
        $success = $stmt->execute();
        if (!$success) {
            die($db->error);
        }

        $stmt->bind_result($id, $user_name, $hash);
        $stmt->fetch();

        if ($password == $hash) {
            // ログイン成功
            session_regenerate_id();
            $_SESSION['id'] = $id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['loggedin'] = true; // ログイン状態を記録
            header('Location: ../index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    }
}
?>
<!doctype html>
<html>

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
            <input type="email" name="email" value="<?php echo h($email)?>" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" placeholder="mail@example.com" required>
          </div>
          <div class="px-6">
            <label class="block mb-2 text-base font-bold text-blackcolor">パスワード</label>
            <input type="password" name="password" value="<?php echo h($password)?>" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" required>
          </div>
          <div class="flex items-center justify-center">
            <a href="#" class="text-sm font-medium text-sub hover:underline hover:text-subhover">パスワードを忘れた方</a>
          </div>
          <!-- エラーメッセージの表示 -->
          <?php if (!empty($error['login']) && $error['login'] === 'blank') : ?>
            <p class="text-red-500 text-center">メールアドレスとパスワードを入力してください。</p>
          <?php elseif (!empty($error['login']) && $error['login'] === 'failed') : ?>
            <p class="text-red-500 text-center">メールアドレスおよびパスワードをご確認ください</p>
          <?php endif; ?>
          <div class="px-6">
            <button type="submit" class="w-full text-whitecolor bg-sub hover:bg-subhover rounded-lg py-2.5 text-center">ログイン</button>
          </div>
          <div class="border-t border-graycolor my-4"></div>
          <p class="flex justify-center text-sm font-light text-gray-500">
            <a href="register.php" class="font-medium text-primary-600 underline hover:text-explain">会員登録</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>