<?php

//--------------------------------------------------------------------------------------
///	フッターノード
//--------------------------------------------------------------------------------------
class cmain_footer extends cnode
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
      <title>フッター</title>

      <!-- Fonts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Stylesheet -->
      <link rel="stylesheet" href="<?php echo ABSOLUTE_URL; ?>/sources/css/app.css" />

      <!-- Tailwind CSS -->
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="tailwind.config.js"></script>
    </head>

    <body class="bg-main">
      <footer class="bottom-0 w-full mt-auto">
        <div class="bg-lightsub">
          <div class="flex items-center">
            <a href="<?php echo ABSOLUTE_URL; ?>/sources/index.php" class="flex items-center">
              <img src="<?php echo ABSOLUTE_URL; ?>/sources/images/GarbaGe favicon3.png" width="60" height="60" class="ml-4" />
              <h1 class="-ml-2 text-2xl font-bold text-blackcolor font-bold">
                Garba<span class="text-sub">Ge</span>
              </h1>
            </a>
          </div>
          <div class="mx-auto w-full max-w-screen-xl flex-col p-4 md:flex md:items-center md:justify-between">
            <ul class="mt-3 flex flex-wrap items-center text-base sm:mb-10 text-explain">
              <li>
                <a href="<?php echo ABSOLUTE_URL; ?>/sources/user/privacy.php" class="hover:underline"> プライバシーポリシー</a>
              </li>
              <li>
              <li>
                /
              </li>
              <a href="<?php echo ABSOLUTE_URL; ?>/sources/user/contact.php" class=" ml-1 hover:underline"> お問い合わせ</a>
              </li>
            </ul>
            <span class="text-xs text-explain sm:text-center">© 2024 GarbaGe Inc.
            </span>
          </div>
        </div>
      </footer>

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