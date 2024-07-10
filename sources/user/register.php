<?php
session_start();

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
        global $err_array;
        global $err_flag;
        global $page_obj;
        global $member_id;

        $this->display();
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

    public function register()
    {
        global $member_id;
        $change_obj = new crecord();
        $dataarr = array();
        //パスワードが変更さえているかを確認する
        if ($member_id > 0) {
            if ($_POST['enc_password'] != '') {
                //パスワードに入力があった（変更された）
                $dataarr['enc_password'] = cutil::pw_encode($_POST['enc_password']);
            }
        } else {
            //新規（パスワード必須）
            $dataarr['enc_password'] = cutil::pw_encode($_POST['enc_password']);
        }
        $dataarr['member_name'] = (string)$_POST['member_name'];
        $dataarr['member_login'] = (string)$_POST['member_login'];
        $dataarr['main_image'] = (string)$_POST['main_image'];
        $dataarr['prefecture_id'] = (int)$_POST['prefecture_id'];
        $dataarr['member_address'] = (string)$_POST['member_address'];
        $dataarr['member_comment'] = (string)$_POST['member_comment'];
        if ($member_id > 0) {
            $where = 'member_id = :member_id';
            $wherearr[':member_id'] = (int)$member_id;
            $change_obj->update_core(false, 'member', $dataarr, $where, $wherearr, false);
            cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $member_id);
        } else {
            $mid = $change_obj->insert_core(false, 'member', $dataarr, false);
            cutil::redirect_exit($_SERVER['PHP_SELF'] . '?mid=' . $mid);
        }
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
        <!DOCTYPE html>
        <html lang="ja">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>会員登録</title>

            <!-- Fonts -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- Script -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body>
            <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="w-full bg-white rounded-lg border border-graycolor md:mt-4 sm:max-w-md xl:p-0">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="flex justify-center text-xl font-bold text-blackcolor md:text-2xl">
                            会員登録
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="px-6">
                                <label class="block mb-2 text-base font-bold text-blackcolor">ユーザー名</label>
                                <input type="text" name="user_name" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none  focus:border-explain block w-full p-2" placeholder="garbageさん" required>
                            </div>
                            <div class="px-6">
                                <label class="block mb-2 text-base font-bold text-blackcolor">メールアドレス</label>
                                <input type="email" name="user_email" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none  focus:border-explain block w-full p-2" placeholder="mail@example.com" required>
                            </div>
                            <div class="px-6">
                                <label class="block mb-2 text-base font-bold text-blackcolor">パスワード</label>
                                <label class="block mb-2 text-xs text-explain">8文字以上の半角英数記号</label>
                                <input type="password" name="user_password" class="bg-thingreen border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none  focus:border-explain block w-full p-2" required>
                            </div>
                            <div class="px-6">
                                <button type="submit" class="w-full text-whitecolor bg-sub hover:bg-subhover rounded-lg py-2.5 text-center">登録</button>
                            </div>
                            <div class="border-t border-graycolor my-4"></div>
                            <p class="flex justify-center text-sm font-light text-gray-500 ">
                                <a href="login.php" class="font-medium text-primary-600 underline hover:text-explain">ログイン</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
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