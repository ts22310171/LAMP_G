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
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $room_id = $_SESSION['user']['room_id'] ?? null;

        if (!$user_id || !$room_id) {
            $_SESSION['error_message'] = "ユーザーIDまたはルームIDが設定されていません。";
            return;
        }

        // POSTリクエストの処理（メッセージ送信）
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? '';
            $image = $_FILES['image'] ?? null;

            if (!empty($content) || ($image && $image['error'] === UPLOAD_ERR_OK)) {
                if ($this->send_message($content, $image)) {
                    $_SESSION['success_message'] = "メッセージが送信されました。";
                } else {
                    $_SESSION['error_message'] = "メッセージの送信に失敗しました。";
                }
            } else {
                $_SESSION['error_message'] = "メッセージまたは画像を入力してください。";
            }

            // リダイレクトして再読み込み
            header("Location: " . $_SERVER['PHP_SELF'] . "?room_id=" . $room_id);
            exit();
        }

        // メッセージの取得
        $message_db = new cmessage();
        $this->messages = $message_db->get_room_messages(false, $room_id);

        if ($this->messages === false) {
            $this->messages = [];
        }

        // セッションからメッセージを取得し、クリア
        $this->error_message = $_SESSION['error_message'] ?? "";
        $this->success_message = $_SESSION['success_message'] ?? "";
        unset($_SESSION['error_message'], $_SESSION['success_message']);

        // アクティブなルームを取得
        $room_db = new croom();
        $this->room = $room_db->get_active_room(false, $user_id);

        if (!$this->room) {
            $this->error_message = "アクティブなルームがありません。";
        }
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 画像のアップロードを処理する
    @param[in] $image アップロードされた画像
    @return mixed アップロードされたファイルパス（成功時）または false（失敗時）
    */
    //--------------------------------------------------------------------------------------
    private function handle_image_upload($image, $upload_dir)
    {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $image['type'];

        if (in_array($file_type, $allowed_types)) {
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $file_name = uniqid() . '.' . $file_extension;
            $upload_file = $upload_dir . $file_name;

            if (move_uploaded_file($image['tmp_name'], $upload_file)) {
                return $upload_file; // 絶対パスを返す
            }
        }
        return false;
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
            'content' => $content ?: null,  // 空文字列の場合は null を設定
            'image' => null,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($image !== null && $image['error'] === UPLOAD_ERR_OK) {
            $upload_dir = dirname(__DIR__) . '/uploads/messages/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $uploaded_image_path = $this->handle_image_upload($image, $upload_dir);
            if ($uploaded_image_path !== false) {
                $data['image'] = '/uploads/messages/' . basename($uploaded_image_path);
            } else {
                return false;
            }
        }

        // コンテンツか画像のどちらかが存在する場合のみメッセージを送信
        if (!empty($data['content']) || !empty($data['image'])) {
            $result = $message_db->insert_message(false, $data);
            return $result !== false;
        }

        return false;
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
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>メッセージボックス</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main flex flex-col min-h-screen">
            <div class="container mx-auto p-4 mt-20">
                <div class="max-w-full mx-auto rounded-lg bg-white p-6 shadow-md">
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
                    <div class="mb-4 h-64 md:h-96 overflow-y-auto rounded bg-gray-50 p-4">
                        <?php if (empty($this->messages)) : ?>
                            <p>メッセージはありません。</p>
                        <?php else : ?>
                            <?php foreach ($this->messages as $message) : ?>
                                <?php if ($message['sender_type'] == 'client') : ?>
                                    <!-- クライアントのメッセージ -->
                                    <div class="mb-4 flex justify-start">
                                        <div class="max-w-lg md:max-w-xl">
                                            <p class="text-xs md:text-sm text-gray-600">From: <?= htmlspecialchars($message['sender_name']) ?> | <?= $message['created_at'] ?></p>
                                            <div class="mt-1 rounded-r-3xl bg-blue-100 p-3">
                                                <p class="text-xs md:text-sm"><?= htmlspecialchars($message['content']) ?></p>
                                                <?php if (!empty($message['image'])) : ?>
                                                    <img src="<?= htmlspecialchars($message['image']) ?>" alt="添付画像" class="mt-2 max-w-full h-auto">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <!-- アドバイザー（ユーザー）のメッセージ -->
                                    <div class="mb-4 flex justify-end">
                                        <div class="max-w-lg md:max-w-xl">
                                            <p class="text-right text-xs md:text-sm text-gray-600">From: <?= htmlspecialchars($message['sender_name']) ?> | <?= $message['created_at'] ?></p>
                                            <div class="mt-1 rounded-l-3xl bg-green-100 p-3">
                                                <p class="text-right text-xs md:text-sm"><?= htmlspecialchars($message['content']) ?></p>
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
                    <div class="flex justify-center items-center">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="w-full max-w-3xl bg-white p-4 rounded-lg shadow">
                            <input type="hidden" name="room_id" value="<?= htmlspecialchars($_SESSION['user']['room_id']) ?>">
                            <div class="flex items-center space-x-2">
                                <!-- カメラアイコンボタン -->
                                <input type="file" id="image-upload" name="image" accept="image/*" class="hidden" />
                                <label for="image-upload" class="cursor-pointer p-2 bg-gray-300 rounded-lg text-gray-500 hover:bg-gray-400 flex items-center justify-center w-12 h-12">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <!-- テキストエリア -->
                                <textarea id="content" name="content" placeholder="メッセージを入力" class="flex-grow rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 h-12"></textarea>
                                <!-- 送信ボタン -->
                                <button type="submit" class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 h-12">送信</button>
                            </div>
                            <!-- 画像プレビュー表示エリア -->
                            <div id="image-preview" class="mt-4"></div>
                        </form>
                    </div>
                </div>
            </div>
            <script src="../js/message_box.js"></script>
        </body>



        </html>
<?php
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