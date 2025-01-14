<?php
if (!isset($_SESSION)) {
    session_start();
}
//ライブラリをインクルード
require_once("../common/libs.php");
//以下はセッション管理用のインクルード
require_once("../common/auth_room.php");


$err_array = array();
$err_flag = 0;
$page_obj = null;

// クエリパラメータからplan_idを取得
if (isset($_GET['plan_id'])) {
    $_SESSION['user']['plan_id'] = $_GET['plan_id'];
}

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
        // プラン情報を取得
        $plan = new cplan();
        $this->plan = $plan->get_tgt(false, $_SESSION['user']['plan_id']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['user']['id'];

            //注文管理
            $order = new corder();
            $result = $order->process_purchase(false, $user_id, $_SESSION['user']['plan_id']);

            if ($result) {
                // ルーム作成
                $room = new croom();
                $room_name = isset($_POST['name']) ? $_POST['name'] : 'デフォルトルーム';
                $client_id = isset($_SESSION['client']['id']) ? $_SESSION['client']['id'] : 1;
                $this->new_room = $room->create_room(false, $user_id, $client_id, $result, $room_name, $_SESSION['user']['plan_id']);

                if (!$this->new_room) {
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
            <?php if ($this->new_room) : ?>
                <?php $this->display_completion(); ?>
            <?php else : ?>
                <?php $this->display_payment_form(); ?>
            <?php endif; ?>
        </body>

        </html>
        <!-- /コンテンツ　-->
    <?php
        //PHPブロック再開
    }

    public function display_payment_form()
    {
    ?>
        <div class="max-w-4xl mx-auto bg-whitecolor shadow-lg rounded-lg px-8 pt-6 pb-8 mt-20 mb-4">
            <?php if ($this->error_message) : ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">エラー</p>
                    <p><?php echo htmlspecialchars($this->error_message, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php endif; ?>
            <div class="flex flex-wrap -mx-4">
                <!-- プラン詳細 -->
                <div class="w-full lg:w-1/2 px-4 mb-6">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">選択されたプラン</h2>
                    <div class="bg-whitehover p-6 rounded-lg shadow">
                        <?php if ($this->plan) : ?>
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($this->plan['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="mb-4 text-gray-600"><?php echo htmlspecialchars($this->plan['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="text-2xl font-bold text-blue-600 mb-2">料金：<span><?php echo htmlspecialchars($this->plan['price'], ENT_QUOTES, 'UTF-8'); ?></span>円</p>
                            <p class="text-gray-700">期間：<span class="font-bold"><?php echo htmlspecialchars($this->plan['duration'], ENT_QUOTES, 'UTF-8'); ?></span>日間</p>
                        <?php else : ?>
                            <p class="text-red-500">プラン情報が見つかりません。</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ルーム名とクレジットカード情報 -->
                <div class="w-full lg:w-1/2 px-4">
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" id="payment-form" class="bg-whitehover p-6 rounded-lg shadow">
                        <h2 class="text-2xl font-bold mb-6 text-gray-800">支払い情報</h2>

                        <!-- ルーム名 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="room-name">
                                ルーム名
                            </label>
                            <input type="text" id="room-name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- クレジットカード情報 -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="card-number">
                                カード番号
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card-number" type="text" placeholder="1234 5678 9012 3456" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="card-name">
                                カード名義人
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="card-name" type="text" placeholder="TARO YAMADA" required>
                        </div>
                        <div class="flex mb-6">
                            <div class="w-1/2 pr-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry-date">
                                    有効期限
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry-date" type="text" placeholder="MM / YY" required>
                            </div>
                            <div class="w-1/2 pl-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">
                                    セキュリティコード
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cvv" type="text" placeholder="123" required>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                支払う
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }

    public function display_completion()
    {
    ?>
        <div class="max-w-4xl mx-auto bg-whitecolor shadow-lg rounded-lg px-8 pt-6 pb-8 mt-20 mb-4">
            <?php if ($this->error_message) : ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">エラー</p>
                    <p><?php echo htmlspecialchars($this->error_message, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php else : ?>
                <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">購入完了</h1>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">購入が完了しました！</p>
                    <p>ご購入ありがとうございます。</p>
                </div>
                <div class="mb-6 bg-whitehover p-6 rounded-lg shadow">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">購入内容</h2>
                    <p class="mb-2"><span class="font-semibold">プラン名:</span> <?php echo htmlspecialchars($this->plan['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="mb-2"><span class="font-semibold">金額:</span> <?php echo htmlspecialchars($this->plan['price'], ENT_QUOTES, 'UTF-8'); ?>円</p>
                    <p><span class="font-semibold">期間:</span> <?php echo htmlspecialchars($this->plan['duration'], ENT_QUOTES, 'UTF-8'); ?>日間</p>
                </div>
                <div class="text-center">
                    <button type="button" onclick="location.href='<?php echo ABSOLUTE_URL . '/sources/user/message_list.php'; ?>'" class="bg-blue-500 text-white font-bold py-3 px-6 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        チャットを始める
                    </button>
                </div>
            <?php endif; ?>
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
$page_obj->add_child($main_obj = new cmain_node());
//フッタ追加
$page_obj->add_child(cutil::create('cmain_footer'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>