<?php

//ライブラリをインクルード
require_once("common/libs.php");

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
            <title>会員登録</title>

            <!-- Fonts -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- Script -->
            <link rel="stylesheet" href="css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="common/tailwind.config.js"></script>
        </head>

        <body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">プラン一覧</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">プラン名</th>
                        <th class="py-2 px-4 border-b border-gray-200">説明</th>
                        <th class="py-2 px-4 border-b border-gray-200">値段</th>
                        <th class="py-2 px-4 border-b border-gray-200">有効期限</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    if (isset($_SESSION['planList'])) {
                        $planList = $_SESSION['planList'];

                        // 取得したデータをテーブルに表示する
                        foreach ($planList as $plan) {
                            echo "<tr>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . htmlspecialchars($plan['name'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . htmlspecialchars($plan['description'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . htmlspecialchars($plan['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-200'>" . htmlspecialchars($plan['duration'], ENT_QUOTES, 'UTF-8') . "</td>";
                            echo "</tr>";
                        }

                        // セッションデータを削除
                        unset($_SESSION['planList']);
                    } else {
                        echo "<tr><td colspan='4' class='py-2 px-4 border-b border-gray-200'>データが見つかりません。</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
//ページ全体を表示
$page_obj->display();

?>