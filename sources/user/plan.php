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
<html>

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
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">プラン一覧</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="text-lg font-bold mb-2">¥<?php echo number_format($row['price']); ?></p>
                        <p class="text-sm text-gray-500 mb-4"><?php echo htmlspecialchars($row['duration_days']); ?>日間</p>
                        <a href="purchase.php?product_id=<?php echo $row['id']; ?>" class="block w-full bg-blue-500 text-white text-center py-2 px-4 rounded hover:bg-blue-600 transition duration-200">購入する</a>
                    </div>
                </div>
            <?php endwhile; ?>
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