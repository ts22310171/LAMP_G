<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

//ライブラリをインクルード
require_once("../common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;


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
        $user_id = 1; // ログインしているユーザーIDを取得する方法に応じて変更
        // $this->message_history = get_message_history($user_id);
        // $this->purchase_history = get_purchase_history($user_id);
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
	@brief  表示(継承して使用)
	@return なし
	*/
    //--------------------------------------------------------------------------------------
    public function display()
    {
        //PHPブロック終了
?>
        <!-- コンテンツ -->
        <!doctype html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>マイページ</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">
            <div class="bg-gray-100 min-h-screen">
                <div class="container mx-auto px-4 py-8">
                    <div class="flex flex-col md:flex-row">
                        <!-- サイドメニュー -->
                        <!-- メインコンテンツエリア -->
                        <main class="w-full md:w-3/4 lg:w-4/5 md:pl-8">
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <!-- プロフィールセクション -->
                                <section id="profile" class="mb-8">
                                    <h3 class="text-xl font-bold mb-4">プロフィール</h3>
                                    <div class="flex items-center mb-4">
                                        <img src="user-avatar.jpg" alt="User Avatar" class="w-16 h-16 rounded-full mr-4">
                                        <div>
                                            <p class="font-medium">ユーザー名</p>
                                            <p class="text-gray-600">メールアドレス</p>
                                        </div>
                                    </div>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        プロフィールを編集
                                    </button>
                                </section>

                                <!-- 購入履歴セクション -->
                                <section id="purchases" class="mb-8 hidden">
                                    <h3 class="text-xl font-bold mb-4">購入履歴</h3>
                                    <ul class="divide-y divide-gray-200">
                                        <?php foreach ($this->purchase_history as $purchase) : ?>
                                            <li class="py-4"><?= htmlspecialchars($purchase['plan_name']) ?>（<?= htmlspecialchars($purchase['duration']) ?>）- <?= htmlspecialchars($purchase['purchase_date']) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>

                            </div>
                        </main>
                    </div>
                </div>
            </div>

            <!-- 次回のアドバイス予定 -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">次回のアドバイス</h2>
                <p class="text-lg">2024/07/20 14:00 - キッチン用品の整理について</p>
            </div>
            </div>
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
//ヘッダ追加
$page_obj->add_child(cutil::create('cmain_header'));
//サイドバー追加
$page_obj->add_child(cutil::create('cmain_sidebar'));
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