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
    private $pageFlag = 0;
    private $err_msg = "";
    private $contact_data = [];

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['confirm'])) {
                $this->pageFlag = 1;
                $this->validate_input();
            } elseif (isset($_POST['submit'])) {
                $this->pageFlag = 2;
                $this->validate_input(); // 再度バリデーションを行う
                if (empty($this->err_msg)) {
                    $this->process_submission();
                } else {
                    $this->pageFlag = 1; // エラーがある場合は確認画面に戻す
                }
            } elseif (isset($_POST['back'])) {
                $this->pageFlag = 0;
                $this->contact_data = $_POST;
            }
        } else {
            $this->pageFlag = 0;
            $this->contact_data = [];
        }
    }

    private function validate_input()
    {
        $this->contact_data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'message' => $_POST['message'] ?? ''
        ];

        if (empty($this->contact_data['name'])) {
            $this->err_msg .= "お名前を入力してください。<br>";
        }
        if (empty($this->contact_data['email']) || !filter_var($this->contact_data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->err_msg .= "有効なメールアドレスを入力してください。<br>";
        }
        if (empty($this->contact_data['message'])) {
            $this->err_msg .= "お問い合わせ内容を入力してください。<br>";
        }

        if (!empty($this->err_msg)) {
            $this->pageFlag = 0; // エラーがある場合は入力画面に戻す
        }
    }

    private function process_submission()
    {
        if (empty($this->contact_data['name']) || empty($this->contact_data['email']) || empty($this->contact_data['message'])) {
            $this->err_msg = "必要な情報が不足しています。もう一度入力してください。";
            $this->pageFlag = 0;
            return;
        }

        $register_obj = new crecord();
        $dataarr = array(
            'name' => $this->contact_data['name'],
            'email' => $this->contact_data['email'],
            'phone' => $this->contact_data['phone'],
            'message' => $this->contact_data['message'],
            'created_at' => date('Y-m-d H:i:s')
        );

        // データベースに挿入
        $insert_id = $register_obj->insert_core(false, 'contacts', $dataarr);

        if ($insert_id) {
            // 挿入成功
            $this->send_confirmation_email();
        } else {
            // 挿入失敗
            $this->err_msg = "お問い合わせの送信に失敗しました。もう一度お試しください。";
            $this->pageFlag = 1; // 確認画面に戻す
        }
    }

    private function send_confirmation_email()
    {
        // メール送信処理をここに実装
        // 例:
        $to = $this->contact_data['email'];
        $subject = "お問い合わせありがとうございます";
        $message = "以下の内容でお問い合わせを受け付けました。\n\n";
        $message .= "お名前: " . $this->contact_data['name'] . "\n";
        $message .= "メールアドレス: " . $this->contact_data['email'] . "\n";
        $message .= "電話番号: " . $this->contact_data['phone'] . "\n";
        $message .= "お問い合わせ内容:\n" . $this->contact_data['message'] . "\n";

        // メール送信の実装（PHPの mail() 関数を使用する場合）
        mail($to, $subject, $message);
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
            <title>お問い合わせ</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main">
            <div class="p-6 max-w-3xl mx-auto mt-20 mb-20">
                <?php if ($this->pageFlag === 0) : ?>
                    <?php $this->display_input_form(); ?>
                <?php elseif ($this->pageFlag === 1) : ?>
                    <?php $this->display_confirm_form(); ?>
                <?php elseif ($this->pageFlag === 2) : ?>
                    <?php $this->display_complete_page(); ?>
                <?php endif; ?>
            </div>
        </body>

        </html>
        <!-- /コンテンツ　-->
    <?php
        //PHPブロック再開
    }

    private function display_input_form()
    {
    ?>
        <div>
            <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
                お問い合わせ詳細
            </h1>
            <div>お問い合わせをいただく前に、<a href="">よくあるご質問をご確認ください。</a></div>
            <?php if (!empty($this->err_msg)) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($this->err_msg); ?></span>
                </div>
            <?php endif; ?>
            <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前<span class="text-alarm">*</span></label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($this->contact_data['name'] ?? ''); ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                </div>
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス<span class="text-alarm">*</span></label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($this->contact_data['email'] ?? ''); ?>" required class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                </div>
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                    <input type="tel" name="phone" value="<?php echo htmlspecialchars($this->contact_data['phone'] ?? ''); ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                </div>
                <div>
                    <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容<span class="text-alarm">*</span></label>
                    <textarea name="message" rows="12" required class="text-sm mt-1 block w-full p-4 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main"><?php echo htmlspecialchars($this->contact_data['message'] ?? ''); ?></textarea>
                </div>
                <div class="">
                    <button type="submit" name="confirm" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                        確認する
                    </button>
                </div>
            </form>
        </div>
    <?php
    }

    private function display_confirm_form()
    {
    ?>
        <div>
            <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
                お問い合わせ内容の確認
            </h1>
            <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前</label>
                    <p><?php echo htmlspecialchars($this->contact_data['name']); ?></p>
                    <input type="hidden" name="name" value="<?php echo htmlspecialchars($this->contact_data['name']); ?>">
                </div>
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス</label>
                    <p><?php echo htmlspecialchars($this->contact_data['email']); ?></p>
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($this->contact_data['email']); ?>">
                </div>
                <div>
                    <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                    <p><?php echo htmlspecialchars($this->contact_data['phone']); ?></p>
                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($this->contact_data['phone']); ?>">
                </div>
                <div>
                    <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容</label>
                    <p><?php echo nl2br(htmlspecialchars($this->contact_data['message'])); ?></p>
                    <input type="hidden" name="message" value="<?php echo htmlspecialchars($this->contact_data['message']); ?>">
                </div>
                <div class="flex space-x-4">
                    <button type="submit" name="back" class="px-20 text-whitecolor bg-gray-500 hover:bg-gray-600 rounded py-2.5 text-center">
                        戻る
                    </button>
                    <button type="submit" name="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                        送信する
                    </button>
                </div>
            </form>
        </div>
    <?php
    }

    private function display_complete_page()
    {
    ?>
        <div>
            <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">お問い合わせありがとうございます</h1>
            <p>
                お問い合わせありがとうございました。<br>
                スタッフがお問い合わせいただいた内容を確認させていただきます。<br>
                必ずしも返信を伴うわけではないこと、ご了承いただきますようよろしくお願いいたします。<br>
                担当者より折り返しご連絡いたします。
            </p>
            <a href="/" class="inline-block mt-4 px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">ホームへ戻る</a>
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