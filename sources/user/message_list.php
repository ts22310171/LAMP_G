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
        global $user_id; // ユーザーIDを適切に取得してください

        $room_obj = new croom();

        // アクティブなルームを取得
        $active_room = $room_obj->get_active_room(false, $user_id);

        // ユーザーのすべてのルームを取得
        $all_rooms = $room_obj->get_user_rooms(false, $user_id);

        $active_rooms = array();
        $expired_rooms = array();

        foreach ($all_rooms as $room) {
            if ($room['status'] === 'active') {
                $active_rooms[] = $room;
            } else {
                $expired_rooms[] = $room;
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
                        <?php foreach ($active_rooms as $room) : ?>
                            <a href="message_detail.php?room_id=<?php echo $room['id']; ?>" class="block p-4 hover:bg-gray-50">
                                <p class="font-semibold"><?php echo htmlspecialchars($room['name']); ?></p>
                                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($room['created_at']); ?></p>
                                <p class="text-xs text-green-600">有効期限: <?php echo htmlspecialchars($room['expiry_date']); ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- 期限切れのプランのメッセージ (初期状態では非表示) -->
                    <div id="expiredMessages" class="hidden divide-y divide-gray-200">
                        <?php foreach ($expired_rooms as $room) : ?>
                            <a href="message_detail.php?room_id=<?php echo $room['id']; ?>" class="block p-4 hover:bg-gray-50 opacity-50">
                                <p class="font-semibold"><?php echo htmlspecialchars($room['name']); ?></p>
                                <p class="text-sm text-gray-500"><?php echo htmlspecialchars($room['created_at']); ?></p>
                                <p class="text-xs text-red-600">期限切れ: <?php echo htmlspecialchars($room['expiry_date']); ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- 新しい相談ボタン (アクティブなプランがある場合のみ表示) -->
                <?php if (!empty($active_rooms)) : ?>
                    <a href="message_detail.php?new=1" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">新しい相談を始める</a>
                <?php endif; ?>

                <!-- プラン更新ボタン (期限切れの場合に表示) -->
                <?php if (empty($active_rooms)) : ?>
                    <a href="renew_plan.php" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600" id="renewPlanBtn">プランを更新する</a>
                <?php endif; ?>
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