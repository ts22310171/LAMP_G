<?php
 
//ライブラリをインクルード
require_once("../common/libs.php");
 
 
$err_array = array();
$err_flag = 0;
$page_obj = null;
 
 
//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode {
    //--------------------------------------------------------------------------------------
    /*!
    @brief  コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct() {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
   
    //--------------------------------------------------------------------------------------
    /*!
    @brief  本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute(){
        global $err_array;
        global $err_flag;
        global $page_obj;
        if(is_null($page_obj)){
            return;
        }
        if(isset($_POST['func'])){
            switch($_POST['func']){
                case "del":
                    //削除操作
                    $this->deljob();
                    //再読み込みのためにリダイレクト
                    cutil::redirect_exit($_SERVER['PHP_SELF']);
                break;
                default:
                    echo 'エラー';
                    exit();
                break;
            }
        }
        //データの読み込み
        $this->readdata();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  構築時の処理(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function create(){
    }
 
 
 
    //--------------------------------------------------------------------------------------
    /*!
    @brief  表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display(){
//PHPブロック終了
?>
<!-- コンテンツ　-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>よくある質問</title>

    <!-- フォント -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- スタイルシート -->
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../common/tailwind.config.js"></script>
</head>

<body class="bg-main">
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/header.php"); ?>
    <div class="p-6 max-w-3xl mx-auto mt-20 mb-20">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">よくあるお問い合わせ（FAQ）</h1>
        <p class="mb-6">当ページでは、お客様からよく寄せられる質問とその回答を掲載しています。必要な情報が見つからない場合は、お気軽にお問い合わせください。</p>

        <nav class="mb-8">
            <ul class="flex flex-wrap space-x-4">
                <li><a href="#general" class="text-blue-600 hover:underline">一般</a></li>
                <li><a href="#products" class="text-blue-600 hover:underline">製品について</a></li>
                <li><a href="#orders" class="text-blue-600 hover:underline">注文について</a></li>
                <li><a href="#payment" class="text-blue-600 hover:underline">支払いについて</a></li>
                <li><a href="#account" class="text-blue-600 hover:underline">アカウントについて</a></li>
            </ul>
        </nav>

        <div id="general" class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">一般</h2>
            <div class="space-y-4">
                <div>
                    <p class="font-bold">Q1: 営業時間は何時ですか？</p>
                    <p>A1: 当社の営業時間は月曜日から金曜日の午前9時から午後6時までです。</p>
                </div>
                <div>
                    <p class="font-bold">Q2: サポートセンターの連絡先を教えてください。</p>
                    <p>A2: サポートセンターの電話番号は0120-123-456です。メールでのお問い合わせはDummyWIZ@example.comまでお願いいたします。</p>
                </div>
            </div>
        </div>

        <div id="products" class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">製品について</h2>
            <div class="space-y-4">
                <div>
                    <p class="font-bold">Q1: 新製品の発売日はいつですか？</p>
                    <p>A1: 新製品の発売日は公式ウェブサイトおよびニュースレターで随時お知らせしております。</p>
                </div>
                <div>
                    <p class="font-bold">Q2: 製品の保証期間はどれくらいですか？</p>
                    <p>A2: 製品の保証期間は購入日から1年間です。詳細は製品に同梱されている保証書をご覧ください。</p>
                </div>
            </div>
        </div>

        <div id="orders" class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">注文について</h2>
            <div class="space-y-4">
                <div>
                    <p class="font-bold">Q1: 注文のキャンセルは可能ですか？</p>
                    <p>A1: 注文のキャンセルは発送前であれば可能です。ご希望の場合は、サポートセンターまでご連絡ください。</p>
                </div>
                <div>
                    <p class="font-bold">Q2: 配送状況を確認する方法を教えてください。</p>
                    <p>A2: 配送状況は、マイアカウントの「注文履歴」から確認できます。また、発送時にお送りするメールにも追跡情報が記載されています。</p>
                </div>
            </div>
        </div>

        <div id="payment" class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">支払いについて</h2>
            <div class="space-y-4">
                <div>
                    <p class="font-bold">Q1: 支払い方法にはどのようなものがありますか？</p>
                    <p>A1: クレジットカード、デビットカード、銀行振込、代金引換がご利用いただけます。</p>
                </div>
                <div>
                    <p class="font-bold">Q2: 領収書の発行は可能ですか？</p>
                    <p>A2: はい、可能です。ご注文の際に「領収書を希望する」にチェックを入れてください。</p>
                </div>
            </div>
        </div>

        <div id="account" class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">アカウントについて</h2>
            <div class="space-y-4">
                <div>
                    <p class="font-bold">Q1: パスワードを忘れた場合はどうすればよいですか？</p>
                    <p>A1: パスワードを忘れた場合は、「パスワードをお忘れですか？」リンクから再設定してください。</p>
                </div>
                <div>
                    <p class="font-bold">Q2: アカウント情報を更新する方法を教えてください。</p>
                    <p>A2: マイアカウントの「プロフィール編集」から情報を更新できます。</p>
                </div>
            </div>
        </div>

        <p>ご質問が解決しない場合は、<a href="#" class="text-blue-600 hover:underline">こちら</a>からお問い合わせください。</p>
    </div>
    <?php include("/home/d202425/public_html/LAMP_G/sources/common/footer.php"); ?>
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
    public function __destruct(){
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}
 
//ページを作成
$page_obj = new cnode();
//ヘッダ追加
$page_obj->add_child(cutil::create('cheader'));
//本体追加
$page_obj->add_child($cmain_obj = cutil::create('cmain_node'));
//フッタ追加
$page_obj->add_child(cutil::create('cfooter'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$cmain_obj->execute();
//ページ全体を表示
$page_obj->display();
 
?>
 
