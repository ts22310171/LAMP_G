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
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">マイページ</h1>

            <!-- ユーザープロフィール -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">プロフィール</h2>
                <div class="flex items-center">
                    <img src="user-avatar.jpg" alt="User Avatar" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <p class="font-medium">ユーザー名</p>
                        <p class="text-gray-600">メールアドレス</p>
                    </div>
                </div>
            </div>

            <!-- 断捨離の進捗状況 -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">断捨離の進捗</h2>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600">全体の45%完了</p>
            </div>

            <!-- プラン購入履歴 -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">プラン購入履歴</h2>
                <ul class="divide-y divide-gray-200">
                    <li class="py-4">プレミアムプラン（1年間）- 2024/05/01</li>
                    <li class="py-4">ベーシックプラン（3ヶ月）- 2024/01/15</li>
                </ul>
            </div>

            <!-- メッセージ履歴 -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">メッセージ履歴</h2>
                <ul class="divide-y divide-gray-200">
                    <li class="py-4">
                        <p class="font-medium">アドバイザー：書籍の整理について</p>
                        <p class="text-sm text-gray-600">2024/07/15 10:30</p>
                    </li>
                    <li class="py-4">
                        <p class="font-medium">ユーザー：クローゼットの片付け方を教えて</p>
                        <p class="text-sm text-gray-600">2024/07/10 15:45</p>
                    </li>
                </ul>
            </div>

            <!-- カテゴリー別統計 -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">カテゴリー別統計</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-100 p-4 rounded">
                        <p class="font-medium">衣類</p>
                        <p class="text-2xl font-bold">75%</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded">
                        <p class="font-medium">書籍</p>
                        <p class="text-2xl font-bold">30%</p>
                    </div>
                    <!-- 他のカテゴリーも同様に追加 -->
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