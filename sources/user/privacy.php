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
    <title>ログイン</title>

    <!-- フォント -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- スタイルシート -->
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../common/tailwind.config.js"></script>
</head>

<body>
    
    <div class="container mx-auto px-4 py-8 mt-20 mb-20">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">プライバシーポリシー</h1>
        <p class="mb-6">このプライバシーポリシーは、当サイト（以下、「当サイト」といいます。）の利用に関して適用されるものです。当サイトを利用することで、お客様は以下のプライバシーポリシーに同意したものとみなされます。</p>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">1. 個人情報の収集について</h2>
            <p>当サイトは、お客様が当サイトを利用する際に、必要に応じて個人情報を収集することがあります。個人情報には、お客様の名前、メールアドレス、電話番号などが含まれます。</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">2. 個人情報の利用目的について</h2>
            <p class="mb-2">当サイトで収集した個人情報は、以下の目的で利用します：</p>
            <ul class="list-disc pl-6">
                <li>お問い合わせに対する対応</li>
                <li>サービスの提供および改善</li>
                <li>新しいサービスやキャンペーンのご案内</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">3. 個人情報の第三者提供について</h2>
            <p>当サイトは、法令に基づく場合を除き、お客様の同意なく第三者に個人情報を提供することはありません。</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">4. 個人情報の管理について</h2>
            <p>当サイトは、お客様の個人情報を適切に管理し、不正アクセス、紛失、破壊、改ざんおよび漏洩から保護するために合理的な対策を講じます。</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">5. プライバシーポリシーの変更について</h2>
            <p>当サイトは、必要に応じてプライバシーポリシーを変更することがあります。変更後のプライバシーポリシーは、当サイトに掲載された時点から適用されます。</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">6. お問い合わせ</h2>
            <p class="mb-2">プライバシーポリシーに関するお問い合わせは、以下の連絡先までお願いします：</p>
            <p>Email: <a href="mailto:example@example.com" class="text-blue-600 hover:underline">example@example.com</a></p>
        </section>
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
    public function __destruct(){
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