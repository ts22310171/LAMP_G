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
        <!-- コンテンツ　-->
        <!DOCTYPE html>
        <html lang="ja">

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
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">断捨離相談メッセージ</h1>

                <!-- タブ切り替え -->
                <div class="mb-4">
                    <button id="activeTabBtn" class="bg-blue-500 text-white px-4 py-2 rounded-l-lg focus:outline-none">有効なプラン</button>
                    <button id="expiredTabBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-r-lg focus:outline-none">期限切れのプラン</button>
                </div>

                <!-- メッセージ一覧 -->
                <div class="bg-white rounded-lg shadow-md overflow-y-auto" style="height: 70vh;">
                    <!-- 有効なプランのメッセージ -->
                    <div id="activeMessages" class="divide-y divide-gray-200">
                        <a href="message_detail.html?id=1" class="block p-4 hover:bg-gray-50">
                            <p class="font-semibold">断捨離の始め方について</p>
                            <p class="text-sm text-gray-500">2024-07-11 14:30</p>
                            <p class="text-xs text-green-600">有効期限: 2024-08-11</p>
                        </a>
                        <!-- 他のアクティブなメッセージ -->
                    </div>

                    <!-- 期限切れのプランのメッセージ (初期状態では非表示) -->
                    <div id="expiredMessages" class="hidden divide-y divide-gray-200">
                        <a href="message_detail.html?id=2" class="block p-4 hover:bg-gray-50 opacity-50">
                            <p class="font-semibold">過去の断捨離相談</p>
                            <p class="text-sm text-gray-500">2024-06-01 10:00</p>
                            <p class="text-xs text-red-600">期限切れ: 2024-07-01</p>
                        </a>
                        <!-- 他の期限切れメッセージ -->
                    </div>
                </div>

                <!-- 新しい相談ボタン (アクティブなプランがある場合のみ表示) -->
                <a href="message_detail.html?new=1" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">新しい相談を始める</a>

                <!-- プラン更新ボタン (期限切れの場合に表示) -->
                <a href="renew_plan.html" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 hidden" id="renewPlanBtn">プランを更新する</a>
            </div>
            <script src="../js/message_list.js"></script>
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

// ページを作成
$page_obj = new cnode();
// サイドバー追加
$page_obj->add_child(cutil::create('cmain_header'));
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