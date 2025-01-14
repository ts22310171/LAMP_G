<?php
/*!
@file login.php
@brief メンバーログイン
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/
if (!isset($_SESSION)) {
  session_start();
}

//ライブラリをインクルード
require_once("../common/libs.php");

/* 既にログインしている場合、ダッシュボードへリダイレクト */
if (isset($_SESSION['user']['name'])) {
  header('Location: ../index.php');
  exit();
}

$err_array = array();
$err_flag = 0;
$page_obj = null;

$ERR_STR = "";
$user_id = "";
$user_name = "";


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
    global $user_id;
    global $user_name;
    if (isset($_SESSION['user']['err']) && $_SESSION['user']['err'] != "") {
      $ERR_STR = $_SESSION['user']['err'];
    }
    //このセッションをクリア
    $_SESSION['user'] = array();

    if (isset($_POST['email']) && isset($_POST['password'])) {
      if ($this->chk_email(
        strip_tags($_POST['email']),
        strip_tags($_POST['password'])
      )) {
        $_SESSION['user']['email'] = strip_tags($_POST['email']);
        $_SESSION['user']['id'] = $user_id;
        $_SESSION['user']['name'] = $user_name;
        cutil::redirect_exit("../index.php");
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
  function chk_email($email, $password)
  {
    global $ERR_STR;
    global $user_id;
    global $user_name;
    $user = new cuser();
    $row = $user->get_tgt_login(false, $email);
    if ($row === false || !isset($row['email'])) {
      $ERR_STR .= "メールアドレスが不定です。\n";
      return false;
    }
    //暗号化によるパスワード認証
    if (!cutil::pw_check($password, $row['password'])) {
      $ERR_STR .= "パスワードが違っています。\n";
      return false;
    }
    $user_id = $row['id'];
    $user_name = $row['name'];
    return true;
  }

  //--------------------------------------------------------------------------------------
  /*!
	@brief  表示(継承して使用)
	@return なし
	*/
  //--------------------------------------------------------------------------------------
  public function display()
  {
    global $ERR_STR;
    //PHPブロック終了
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

      <div class="flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg border border-graycolor md:mt-4 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="flex justify-center text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
              ログイン
            </h1>
            <?php if (!empty($ERR_STR)) : ?>
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">エラー:</strong>
                <span class="block sm:inline"><?php echo nl2br(htmlspecialchars($ERR_STR)); ?></span>
              </div>
            <?php endif; ?>
            <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="px-6">
                <label class="block mb-2 text-sm font-bold text-blackcolor">メールアドレス</label>
                <input type="email" name="email" value="" class="bg-lightsub border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" placeholder="mail@example.com" required>
              </div>
              <div class="px-6">
                <label class="block mb-2 text-sm font-bold text-blackcolor">パスワード</label>
                <input type="password" name="password" value="" class="bg-lightsub border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" required>
              </div>
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
    <!-- /コンテンツ　-->
<?php
    //PHPブロック再開
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	デストラクタ
	*/
  //--------------------------------------------------------------------------------------
  public function __destruct()
  {
    //親クラスのデストラクタを呼ぶ
    parent::__destruct();
  }
}

//ページを作成
$page_obj = new cnode();
//ヘッダ追加(ログイン用)
$page_obj->add_child(cutil::create('cmain_header'));
//本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>