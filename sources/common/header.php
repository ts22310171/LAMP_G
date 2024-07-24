<?php

if (!isset($_SESSION)) {
  session_start();
}

//--------------------------------------------------------------------------------------
///	ヘッダーノード
//--------------------------------------------------------------------------------------
class cmain_header extends cnode
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
    <html>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <!-- Fonts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Stylesheet -->
      <link rel="stylesheet" href="<?php echo ABSOLUTE_URL; ?>/sources/css/app.css" />

      <!-- Script -->
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="tailwind.config.js"></script>
    </head>

    <body>
      <header>
        <div class="bg-main h-20 flex justify-between items-center fixed top-0 left-0 w-full z-50 h-16">
          <div class="flex items-center">
            <a href="<?php echo ABSOLUTE_URL; ?>/sources/index.php" class="flex items-center mr-10">
              <img src="<?php echo ABSOLUTE_URL; ?>/sources/images/GarbaGe favicon2.png" width="60" height="60" class="ml-4" />
              <div class="-ml-2 text-2xl text-black font-bold">
                Garba<span class="text-sub">Ge</span>
              </div>
            </a>
            <a href="<?php echo ABSOLUTE_URL; ?>/sources/" class="pt-1 px-2">よくある質問</a>
            <a href="<?php echo ABSOLUTE_URL; ?>/sources/" class="pt-1 px-2">お問い合わせ</a>
          </div>
          <div class="flex">
            <?php if (isset($_SESSION['user']['name'])) : ?>
              <div class="relative">
                <div class="rounded shadow bg-whitecolor p-2">
                  <button class="text-blackcolor" id="btn">
                    <?php echo $_SESSION['user']['name']; ?>
                    <i class="fa-solid fa-chevron-down text-explain" id="arrow"></i>
                  </button>
                </div>
                <div class="dropdown hidden absolute right-0 mt-2 py-2 w-48 bg-white border rounded shadow-xl" id="dropdown">
                  <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-0"><i class="fa-solid fa-user"></i>マイページ</a>
                  <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-1"><i class="fa-solid fa-comment"></i>チャットルーム</a>
                  <a href="<?php echo ABSOLUTE_URL; ?>/sources/user/settigs.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>設定</a>
                  <a href="<?php echo ABSOLUTE_URL; ?>/sources/user/logout.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>ログアウト</a>
                </div>
              </div>
            <?php else : ?>
              <a href="<?php echo ABSOLUTE_URL; ?>/sources/user/login.php" class=" text-black mr-5">
                ログイン
              </a>
            <?php endif; ?>
            <a href="<?php echo ABSOLUTE_URL; ?>/sources/"><i class="fa-solid fa-cart-shopping mx-5"></i></a>
          </div>
        </div>
      </header>
      <script src="<?php echo ABSOLUTE_URL; ?>/sources/js/header.js"></script>
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
?>