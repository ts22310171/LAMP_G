<?php
/*!
@file login.php
@brief メンバーログイン
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

//ライブラリをインクルード
require_once("../common/libs.php");

session_start();

/* 既にログインしている場合、ダッシュボードへリダイレクト */
if (isset($_SESSION['user']['name'])) {
  header('Location: ../index.php');
  exit();
}

$err_array = array();
$err_flag = 0;
$page_obj = null;

$ERR_STR = "";
$member_id = "";
$member_name = "";


//--------------------------------------------------------------------------------------
///	本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
  //--------------------------------------------------------------------------------------
  /*!
	@brief	コンストラクタ
	*/
  //--------------------------------------------------------------------------------------
  public function __construct()
  {
    //親クラスのコンストラクタを呼ぶ
    parent::__construct();
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief  本体実行（表示前処理）
	@return なし
	*/
  //--------------------------------------------------------------------------------------
  public function execute()
  {
    global $ERR_STR;
    global $member_id;
    global $member_name;
    if (isset($_SESSION['tmY2024_mem']['err']) && $_SESSION['tmY2024_mem']['err'] != "") {
      $ERR_STR = $_SESSION['tmY2024_mem']['err'];
    }
    //このセッションをクリア
    $_SESSION['tmY2024_mem'] = array();

    if (isset($_POST['member_login']) && isset($_POST['member_password'])) {
      if ($this->chk_member_login(
        strip_tags($_POST['member_login']),
        strip_tags($_POST['member_password'])
      )) {
        $_SESSION['tmY2024_mem']['member_login'] = strip_tags($_POST['member_login']);
        $_SESSION['tmY2024_mem']['member_id'] = $member_id;
        $_SESSION['tmY2024_mem']['member_name'] = $member_name;
        cutil::redirect_exit("index.php");
      }
    }
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	構築時の処理(継承して使用)
	@return	なし
	*/
  //--------------------------------------------------------------------------------------
  public function create()
  {
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	ログインのチェック
	@return	メンバーID
	*/
  //--------------------------------------------------------------------------------------
  function chk_member_login($member_login, $member_password)
  {
    global $ERR_STR;
    global $member_id;
    global $member_name;
    $user = new cuser();
    $row = $user->get_tgt_login(false, $member_login);
    if ($row === false || !isset($row['member_id'])) {
      $ERR_STR .= "ログイン名が不定です。\n";
      return false;
    }
    //暗号化によるパスワード認証
    if (!cutil::pw_check($member_password, $row['enc_password'])) {
      $ERR_STR .= "パスワードが違っています。\n";
      return false;
    }
    $member_id = $row['member_id'];
    $member_name = $row['member_name'];
    return true;
  }

  //--------------------------------------------------------------------------------------
  /*!
	@brief  表示(継承して使用)
	@return なし
	*/
  //--------------------------------------------------------------------------------------
}
//ページを作成
$page_obj = new cnode();
//本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();

?>
<!-- コンテンツ -->
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

<body class="bg-main flex flex-col min-h-screen">
  <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
  <div class="flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg border border-graycolor md:mt-4 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="flex justify-center text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
          ログイン
        </h1>

        <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="px-6">
            <label class="block mb-2 text-sm font-bold text-blackcolor">メールアドレス</label>
            <input type="email" name="email" value="<?php echo $email ?>" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-3/4 p-2" placeholder="mail@example.com" required>
          </div>
          <div class="px-6">
            <label class="block mb-2 text-sm font-bold text-blackcolor">パスワード</label>
            <input type="password" name="password" value="<?php echo $password ?>" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" required>
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
  <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
</body>

</html>