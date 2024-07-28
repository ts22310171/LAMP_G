<?php
if (!isset($_SESSION)) {
    session_start();
}

//ライブラリをインクルード
require_once("../common/libs.php");

$page_obj = null;
if (isset($_GET['room_id'])) {
    $_SESSION['user']['room_id'] = (int)$_GET['room_id'];
}

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    public $room;
    public $messages;
    public $error_message = "";
    public $success_message = "";

    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
        $this->room = null;
        $this->messages = array();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief メッセージを送信する
    @param[in] $content メッセージの内容
    @param[in] $image アップロードされた画像（オプション）
    @return bool 送信成功時はtrue、失敗時はfalse
    */
    //--------------------------------------------------------------------------------------
    private function send_message($content, $image = null)
    {
        $message_db = new cmessage();
        $user_id = $_SESSION['user']['id'];
        $room_id = $_SESSION['user']['room_id'];

        $data = array(
            'room_id' => $room_id,
            'sender_id' => $user_id,
            'sender_type' => 'user',
            'content' => $content,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($image !== null && $image['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            $upload_file = $upload_dir . basename($image['name']);
            if (move_uploaded_file($image['tmp_name'], $upload_file)) {
                $data['image'] = $upload_file;
            }
        }

        $result = $message_db->insert_message(false, $data);
        return $result !== false;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $room_id = $_SESSION['user']['room_id'] ?? null;

        if (!$user_id || !$room_id) {
            $this->error_message = "ユーザーIDまたはルームIDが設定されていません。";
            return;
        }

        // POSTリクエストの処理（メッセージ送信）
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? '';
            $image = $_FILES['image'] ?? null;

            if (!empty($content)) {
                if ($this->send_message($content, $image)) {
                    $this->success_message = "メッセージが送信されました。";
                    // リダイレクトして再読み込み
                    header("Location: " . $_SERVER['PHP_SELF'] . "?room_id=" . $room_id);
                    exit();
                } else {
                    $this->error_message = "メッセージの送信に失敗しました。";
                }
            } else {
                $this->error_message = "メッセージを入力してください。";
            }
        }

        // メッセージDBクラスのインスタンスを作成
        $message_db = new cmessage();

        // アクティブなルームを取得
        $room_db = new croom();
        $this->room = $room_db->get_active_room(false, $user_id);

        if (!$this->room) {
            $this->error_message = "アクティブなルームがありません。";
            return;
        }

        // メッセージを取得
        $this->messages = $message_db->get_room_messages(false, $room_id);

        if ($this->messages === false) {
            $this->messages = []; // 空の配列を設定して、foreach のエラーを防ぐ
        }
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display()
    {
        //PHPブロック終了
?>
        <!-- コンテンツ　-->
        <!doctype html>
        <html lang="ja">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>断捨離相談メッセージボックス</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">
            <div class="container mx-auto p-4 mt-30">
                <div class="rounded-lg bg-white p-6 shadow-md">
                    <h1 class="mb-4 text-2xl font-bold">メッセージボックス</h1>

                    <?php if ($this->error_message) : ?>
                        <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
                            <?= htmlspecialchars($this->error_message) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->success_message) : ?>
                        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                            <?= htmlspecialchars($this->success_message) ?>
                        </div>
                    <?php endif; ?>

                    <!-- メッセージ表示エリア -->
                    <div class="mb-4 h-96 overflow-y-auto rounded bg-gray-50 p-4">
                        <?php if (empty($this->messages)) : ?>
                            <p>メッセージはありません。</p>
                        <?php else : ?>
                            <?php foreach ($this->messages as $message) : ?>
                                <?php if ($message['sender_type'] == 'client') : ?>
                                    <!-- クライアントのメッセージ -->
                                    <div class="mb-4 flex justify-start">
                                        <div class="max-w-md">
                                            <p class="text-sm text-gray-600">From: <?= htmlspecialchars($message['sender_name']) ?> | <?= $message['created_at'] ?></p>
                                            <div class="mt-1 rounded-lg bg-blue-100 p-3">
                                                <p class="text-sm"><?= htmlspecialchars($message['content']) ?></p>
                                                <?php if (!empty($message['image'])) : ?>
                                                    <img src="<?= htmlspecialchars($message['image']) ?>" alt="添付画像" class="mt-2 max-w-full h-auto">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <!-- アドバイザー（ユーザー）のメッセージ -->
                                    <div class="mb-4 flex justify-end">
                                        <div class="max-w-md">
                                            <p class="text-right text-sm text-gray-600">From: <?= htmlspecialchars($message['sender_name']) ?> | <?= $message['created_at'] ?></p>
                                            <div class="mt-1 rounded-lg bg-green-100 p-3">
                                                <p class="text-sm"><?= htmlspecialchars($message['content']) ?></p>
                                                <?php if (!empty($message['image'])) : ?>
                                                    <img src="<?= htmlspecialchars($message['image']) ?>" alt="添付画像" class="mt-2 max-w-full h-auto">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- メッセージ入力フォーム -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="mt-4">
                        <input type="hidden" name="room_id" value="<?= htmlspecialchars($_SESSION['user']['room_id']) ?>">
                        <div class="flex items-start space-x-4">
                            <div>
                                <label for="image-upload" class="mb-2 block text-sm font-medium text-gray-700">画像をアップロード</label>
                                <input type="file" id="image-upload" name="image" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none" />
                            </div>
                            <textarea name="content" placeholder="メッセージを入力" class="mb-2 w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <button type="submit" class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">送信</button>
                        </div>
                    </form>
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
    @brief デストラクタ
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