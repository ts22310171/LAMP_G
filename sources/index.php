<?php
if (!isset($_SESSION)) {
    session_start();
}
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
    @brief  本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        $plan = new cplan();
        $_SESSION['products'] = $plan->get_all(false, 0, 10);  // パラメータは適宜変更
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
            <title>プラン一覧</title>

            <!-- Fonts -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- Script -->
            <link rel="stylesheet" href="css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="common/tailwind.config.js"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">
            <div class="container mx-auto">
                <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">プラン一覧</h2>
                    <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">GarbaGeは、テクノロジー、イノベーション、資本が長期的な価値を引き出し、経済成長を促進できる市場に焦点を当てています。</p>
                </div>
                <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">プラン一覧</h1>
                <div class="mt-20 space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                    <?php
                    if (isset($_SESSION['products'])) {
                        $productList = $_SESSION['products'];

                        foreach ($productList as $product) {
                    ?>
                            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-explain bg-lightsub rounded-lg border border-gray-100 shadow">
                                <h3 class="mb-4 text-2xl font-semibold"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400"><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <div class="flex justify-center items-baseline my-8">
                                    <span class="mr-2 text-5xl font-extrabold"><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>円</span>
                                </div>
                                <!-- List -->
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>期間: <span class="font-semibold"><?php echo htmlspecialchars($product['duration'], ENT_QUOTES, 'UTF-8'); ?></span><span class="ml-1">日間</span></span>
                                    </li>
                                </ul>
                                <a href="user/card_info.php?plan_id=<?php echo urlencode($product['id']); ?>" class="text-white bg-sub hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">購入する</a>
                            </div>
                    <?php
                        }

                        unset($_SESSION['products']);
                    } else {
                        echo "<p class='text-center text-gray-600'>データが見つかりません。</p>";
                    }
                    ?>
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
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>