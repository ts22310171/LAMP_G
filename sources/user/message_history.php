<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

// ライブラリをインクルード
require_once("../common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;

// 本体ノード
class cmain_node extends cnode
{
    private $message_history;
    private $purchase_history;

    public function __construct()
    {
        parent::__construct();
    }

    public function execute()
    {
        $user_id = 1; // ログインしているユーザーIDを取得する方法に応じて変更

        // $this->message_history = get_message_history($user_id);
        // $this->purchase_history = get_purchase_history($user_id);

    }

    public function display()
    {
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
            <div class="container px-4 py-8 mt-20 ml-80 mx-30">
                <h1 class="text-3xl font-bold mb-8">メッセージ履歴</h1>
                <!-- メッセージ履歴 -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold mb-4">メッセージ履歴</h2>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($this->message_history as $message) : ?>
                            <li class="py-4">
                                <p class="font-medium"><?= htmlspecialchars($message['advisor']) ?>：<?= htmlspecialchars($message['message']) ?></p>
                                <p class="text-sm text-gray-600"><?= htmlspecialchars($message['created_at']) ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </body>

        </html>
<?php

    }

    public function create()
    {
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}

// ページを作成
$page_obj = new cnode();
// サイドバー追加
$page_obj->add_child(cutil::create('cmain_header_sidebar'));
// 本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
// フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
// 構築時処理
$page_obj->create();
// 本体実行（表示前処理）
$main_obj->execute();
// ページ全体を表示
$page_obj->display();


?>