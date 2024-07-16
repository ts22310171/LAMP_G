<?php

//ライブラリをインクルード
require_once("../common/libs.php");


$err_array = array();
$err_flag = 0;
$page_obj = null;
$pageFlag  = 0;


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
            <title>お問い合わせ入力</title>

            <!-- フォント -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- スタイルシート -->
            <link rel="stylesheet" href="../css/app.css">
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="../common/tailwind.config.js"></script>
        </head>

        <body class="bg-main">
            <div class="p-6 max-w-3xl mx-auto mt-20 mb-20">
                <?php if ($pageFlag === 0) : ?>
                    <div>
                        <h1 class="mb-5 text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
                            お問い合わせ詳細
                        </h1>
                        <div>お問い合わせをいただく前に、<a href="">よくあるご質問をご確認ください。</a></div>
                        <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前<span class="text-alarm">*</span></label>
                                <input type="text" name="name" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス<span class="text-alarm">*</span></label>
                                <input type="email" name="email" required class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                                <input type="tel" name="phone" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容<span class="text-alarm">*</span></label>
                                <textarea name="message" rows="12" required class="text-sm mt-1 block w-full p-4 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main"></textarea>
                            </div>
                            <div class="">
                                <button type="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                                    確認する
                                </button>
                            </div>
                            <div class="">
                                <button type="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                                    確認する
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if ($pageFlag === 1) : ?>
                    <div>
                        <form class="space-y-4 md:space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">お名前<span class="text-alarm">*</span></label>
                                <input type="text" name="name" value="<?php echo $_POST['name'] ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">メールアドレス<span class="text-alarm">*</span></label>
                                <input type="email" name="email" value="<?php echo $_POST['email'] ?>" required class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block  mb-1 text-sm text-blackcolor font-bold">電話番号</label>
                                <input type="tel" name="phone" value="<?php echo $_POST['phone'] ?>" class="text-sm mt-1 block w-full p-2 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main">
                            </div>
                            <div>
                                <label class="block mb-1 text-sm text-blackcolor font-bold">お問い合わせ内容<span class="text-alarm">*</span></label>
                                <textarea name="message" value="<?php echo $_POST['message'] ?>" rows="12" required class="text-sm mt-1 block w-full p-4 rounded bg-whitecolor text-blackcolor focus:outline-none focus:border-main"></textarea>
                            </div>
                            <div class="">
                                <button type="submit" class="px-20 text-whitecolor bg-sub hover:bg-subhover rounded py-2.5 text-center">
                                    送信する
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if ($pageFlag === 2) : ?>
                    <div>
                        <h1>お問い合わせありがとうございます</h1>
                        <p>
                            お問い合わせありがとうございました
                            スタッフがお問い合わせいただいた内容を確認させていただきます。
                            必ずしも返信を伴うわけではないこと、ご了承いただきますようよろしくお願いいたします。<br />担当者より折り返しご連絡いたします。
                        </p>
                        <a href="/" class="button">ホームへ戻る</a>
                    </div>
                <?php endif; ?>
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