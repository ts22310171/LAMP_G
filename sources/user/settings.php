<?php

//ライブラリをインクルード
require_once("../common/libs.php");


$err_array = array();
$err_flag = 0;
$page_obj = null;


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
            <title>ログイン</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body>

            <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-6">アカウント設定</h1>

                <!-- ユーザー情報セクション -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">ユーザー情報</h2>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">ユーザー名</label>
                        <input type="text" id="username" name="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                        <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        更新
                    </button>
                </div>

                <!-- パスワード更新セクション -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">パスワード更新</h2>
                    <div class="mb-4">
                        <label for="current-password" class="block text-sm font-medium text-gray-700">現在のパスワード</label>
                        <input type="password" id="current-password" name="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="new-password" class="block text-sm font-medium text-gray-700">新しいパスワード</label>
                        <input type="password" id="new-password" name="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700">新しいパスワード（確認）</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        パスワード更新
                    </button>
                </div>

                <!-- アカウント削除セクション -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">アカウント削除</h2>
                    <p class="mb-4 text-gray-600">アカウントを削除すると、すべてのデータが永久に失われます。この操作は取り消せません。</p>
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="openDeleteModal()">
                        アカウント削除
                    </button>
                </div>
            </div>

            <!-- 削除確認モーダル（非表示） -->
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <h3 class="text-lg font-bold mb-4">アカウント削除の確認</h3>
                    <p class="mb-4">本当にアカウントを削除しますか？この操作は取り消せません。</p>
                    <div class="flex justify-end">
                        <button class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded mr-2" onclick="closeDeleteModal()">
                            キャンセル
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            削除する
                        </button>
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