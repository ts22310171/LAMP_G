<?php
if (!isset($_SESSION)) {
    session_start();
}
//ライブラリをインクルード
require_once("../common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;
$user_id = null;
$user_data = null;

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
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
        global $user_id, $user_data;
        $user_id = $_SESSION['user']['id'];
        $user = new cuser();
        $user_data = $user->get_tgt(true, $user_id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['update_name_email'])) {
                $name = $_POST['username'];
                $email = $_POST['email'];
                $dataarr = array(
                    'name' => $name,
                    'email' => $email,
                );
                $user->update_user_info(false, $user_id, $dataarr);
                header("Location:" . ABSOLUTE_URL . "/sources/user/settings.php");
                exit;
            } elseif (isset($_POST['update_password'])) {
                $new_password = $_POST['new-password'];
                $user->update_password(false, $user_id, $new_password);
                header("Location:" . ABSOLUTE_URL . "/sources/user/settings.php");
                exit;
            } elseif (isset($_POST['delete_account'])) {
                $user->delete_account(false, $user_id);
                session_destroy();
                header("Location:" . ABSOLUTE_URL . "/sources/index.php");
                exit;
            }
        }
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  構築時の処理(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function create()
    {
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display()
    {
        //PHPブロック終了
?>
        <!-- コンテンツ　-->
        <!DOCTYPE html>
        <html lang="ja">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>設定</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
                <h1 class="text-3xl font-extrabold text-gray-900 mt-24 mb-8">アカウント設定</h1>

                <!-- ユーザー情報セクション -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">ユーザー情報</h2>
                        <div class="mb-6">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">ユーザー名</label>
                            <input type="text" id="username" name="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">メールアドレス</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <button type="submit" name="update_name_email" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow-md transition duration-150 ease-in-out">
                            更新
                        </button>
                    </div>
                </form>

                <!-- パスワード更新セクション -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">パスワード更新</h2>
                        <div class="mb-6">
                            <label for="current-password" class="block text-sm font-medium text-gray-700 mb-2">現在のパスワード</label>
                            <input type="password" id="current-password" name="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <div class="mb-6">
                            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">新しいパスワード</label>
                            <input type="password" id="new-password" name="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <div class="mb-6">
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">新しいパスワード（確認）</label>
                            <input type="password" id="confirm-password" name="confirm-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <button type="submit" name="update_password" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow-md transition duration-150 ease-in-out">
                            パスワード更新
                        </button>
                    </div>
                </form>

                <!-- アカウント削除セクション -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-red-800 mb-4">アカウント削除</h2>
                    <p class="mb-6 text-red-600">アカウントを削除すると、すべてのデータが永久に失われます。この操作は取り消せません。</p>
                    <button class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md shadow-md transition duration-150 ease-in-out" onclick="openDeleteModal()">
                        アカウント削除
                    </button>
                </div>
            </div>

            <!-- 削除確認モーダル（非表示） -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-8 border w-full max-w-md shadow-lg rounded-lg bg-white">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">アカウント削除の確認</h3>
                    <p class="mb-6 text-gray-600">本当にアカウントを削除しますか？この操作は取り消せません。</p>
                    <form method="POST">
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">パスワード</label>
                            <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-6 rounded-md mr-4 transition duration-150 ease-in-out" onclick="closeDeleteModal()">
                                キャンセル
                            </button>
                            <button type="submit" name="delete_account" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-md shadow-md transition duration-150 ease-in-out">
                                削除する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <script src="../js/settings.js"></script>
        </body>

        </html>

        <!-- /コンテンツ　-->
<?php
        //PHPブロック再開
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  デストラクタ
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
//ヘッダ追加
$page_obj->add_child(cutil::create('cmain_header'));
//本体追加
$page_obj->add_child($cmain_obj = cutil::create('cmain_node'));
//フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$cmain_obj->execute();
//ページ全体を表示
$page_obj->display();
?>