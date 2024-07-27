<?php
if (!isset($_SESSION)) {
    session_start();
}
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
    public $error_message = "";
    public $plan;
    public $plan_id;
    public $new_room = false;

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['user']['id'];

            //注文管理
            $order = new corder();
            $result = $order->process_purchase(false, $user_id, $this->plan_id);

            if ($result) {
                // ルーム作成
                $room = new croom();
                $room_name = isset($_POST['name']) ? $_POST['name'] : 'デフォルトルーム';
                $client_id = isset($_SESSION['client']['id']) ? $_SESSION['client']['id'] : 1;
                $new_room = $room->create_room(false, $user_id, $client_id, $result, $room_name);

                if (!$new_room) {
                    $this->error_message = "ルームの作成に失敗しました。";
                }
            } else {
                //エラー処理
                $this->error_message = "購入処理に失敗しました。";
            }
        }
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
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">

            <?php if ($this->new_room) :
                $this->display_completion();
            else :
                $this->display_payment_form();
            endif;
            ?>
        </body>

        </html>
        <!-- /コンテンツ　-->
    <?php
        //PHPブロック再開
    }
    public function display_payment_form()
    {
    ?>
        <div class="max-w-4xl mx-auto bg-whitecolor shadow-md rounded px-8 pt-6 pb-8 mt-20 mb-4">
            <div class="flex flex-wrap -mx-4">
                <!-- プラン詳細 -->
                <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">選択されたプラン</h2>
                    <div class="bg-whitehover p-4 rounded">
                        <?php if ($this->plan) : ?>
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($this->plan['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="mb-4"><?php echo htmlspecialchars($this->plan['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="text-2xl font-bold text-blue-600">料金：<span class="font-bold"><?php echo htmlspecialchars($this->plan['price'], ENT_QUOTES, 'UTF-8'); ?></span>円</p>
                            <p>期間：<span class="font-bold"><?php echo htmlspecialchars($this->plan['duration'], ENT_QUOTES, 'UTF-8'); ?></span>日間</p>
                        <?php else : ?>
                            <p>プラン情報が見つかりません。</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ルーム名 -->
                <div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" id="room" class="">
                        <label class="">ルーム名を入力してください</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" class="">
                    </form>
                </div>

                <!-- クレジットカード情報 -->
                <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">クレジットカード情報</h2>
                    <div class="bg-whitehover p-4 rounded">
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
                        <form class="flex items-center justify-between" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?plan_id=' . $this->plan_id); ?>" method="post">
                            <button type="submit" form="room" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                支払う
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
        //PHPブロック再開
    }
    public function display_completion()
    {
    ?>
        <div class="max-w-4xl mx-auto bg-whitecolor shadow-md rounded px-8 pt-6 pb-8 mt-20 mb-4">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">購入完了</h1>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">購入が完了しました！</p>
                <p>ご購入ありがとうございます。</p>
            </div>
            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">購入内容</h2>
                <p>プラン名: <?php echo htmlspecialchars($this->plan['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p>金額: <?php echo htmlspecialchars($this->plan['price'], ENT_QUOTES, 'UTF-8'); ?>円</p>
                <p>期間: <?php echo htmlspecialchars($this->plan['duration'], ENT_QUOTES, 'UTF-8'); ?>日間</p>
            </div>
            <a href="../index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            </a>
        </div>
<?php
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