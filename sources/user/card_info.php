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
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mt-20 mb-4">
                <div class="flex flex-wrap -mx-4">
                    <!-- プラン詳細 -->
                    <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">選択されたプラン</h2>
                        <div class="bg-gray-100 p-4 rounded">
                            <h3 class="text-xl font-semibold mb-2">プレミアムプラン</h3>
                            <ul class="list-disc list-inside mb-4">
                                <li>全機能へのアクセス</li>
                                <li>24時間サポート</li>
                                <li>無制限のストレージ</li>
                                <li>月次レポート</li>
                            </ul>
                            <p class="text-2xl font-bold text-blue-600">¥5,000 / 月</p>
                        </div>
                    </div>

                    <!-- クレジットカード情報 -->
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">クレジットカード情報</h2>
                        <form>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="card-number">
                                    カード番号
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card-number" type="text" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="card-name">
                                    カード名義人
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card-name" type="text" placeholder="TARO YAMADA">
                            </div>
                            <div class="flex mb-4">
                                <div class="w-1/2 pr-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry-date">
                                        有効期限
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry-date" type="text" placeholder="MM / YY">
                                </div>
                                <div class="w-1/2 pl-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">
                                        セキュリティコード
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cvv" type="text" placeholder="123">
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                    支払う
                                </button>
                            </div>
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