<?php

//ライブラリをインクルード
require_once("../common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;

// クエリパラメータからplan_idを取得
$plan_id = isset($_GET['plan_id']) ? intval($_GET['plan_id']) : 0;

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    private $plan;
    private $plan_id;

    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct($plan_id)
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
        $this->plan_id = $plan_id;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        // プラン情報を取得
        $plan = new cplan();
        $this->plan = $plan->get_tgt(false, $this->plan_id);
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
            <!-- ... (ヘッダー部分は変更なし) ... -->
        </head>

        <body>
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mt-20 mb-4">
                <div class="flex flex-wrap -mx-4">
                    <!-- プラン詳細 -->
                    <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">選択されたプラン</h2>
                        <div class="bg-gray-100 p-4 rounded">
                            <?php if ($this->plan) : ?>
                                <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($this->plan['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="mb-4"><?php echo htmlspecialchars($this->plan['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="text-2xl font-bold text-blue-600">¥<?php echo htmlspecialchars($this->plan['price'], ENT_QUOTES, 'UTF-8'); ?> / <?php echo htmlspecialchars($this->plan['duration'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <?php else : ?>
                                <p>プラン情報が見つかりません。</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- クレジットカード情報 -->
                    <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mt-20 mb-4">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800">クレジットカード情報</h2>
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
            </div>
        </body>

        </html>
        <!-- /コンテンツ　-->
<?php
        //PHPブロック再開
    }

    // ... (デストラクタは変更なし)
}

//ページを作成
$page_obj = new cnode();
//ヘッダ追加
$page_obj->add_child(cutil::create('cmain_header'));
//本体追加
$page_obj->add_child($main_obj = new cmain_node($plan_id));
//フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>