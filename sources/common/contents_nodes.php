<?php
/*!
@file contents_node.php
@brief 共有するノード
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

////////////////////////////////////


//--------------------------------------------------------------------------------------
///	ヘッダノード
//--------------------------------------------------------------------------------------
class cheader extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/css/app.css" />

  <!-- Script -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="tailwind.config.js"></script>
</head>
<body>
  <header>
    <div class="bg-main h-20 flex justify-between items-center fixed top-0 left-0 w-full z-10 h-16">
      <div class="flex items-center">
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/index.php" class="flex items-center mr-10">
          <img src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/images/GarbaGe favicon2.png" width="60" height="60" class="ml-4" />
          <div class="-ml-2 text-2xl text-black font-bold">
            Garba<span class="text-sub">Ge</span>
          </div>
        </a>
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/" class="pt-1 px-2">よくある質問</a>
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/" class="pt-1 px-2">お問い合わせ</a>
      </div>
      <div class="flex">
        <?php if (isset($_SESSION['name'])) : ?>
          <div class="relative">
            <div class="rounded shadow bg-whitecolor p-2">
              <button class="text-blackcolor" id="btn">
                <?php echo $_SESSION['name']; ?>
                <i class="fa-solid fa-chevron-down text-explain" id="arrow"></i>
              </button>
            </div>
            <div class="dropdown hidden absolute right-0 mt-2 py-2 w-48 bg-white border rounded shadow-xl" id="dropdown">
              <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-0"><i class="fa-solid fa-user"></i>マイページ</a>
              <a href="" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-1"><i class="fa-solid fa-comment"></i>チャットルーム</a>
              <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/settigs.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>設定</a>
              <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/logout.php" class="block px-4 py-2 text-sm text-explain" role="menuitem" tabindex="-1" id="menu-item-2"><i class="fa-solid fa-gear"></i>ログアウト</a>
            </div>
          </div>
        <?php else : ?>
          <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/login.php" class=" text-black mr-5">
            ログイン
          </a>
        <?php endif; ?>
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/"><i class="fa-solid fa-cart-shopping mx-5"></i></a>
      </div>
    </div>
  </header>
  <script src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/js/header.js"></script>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	メンバーヘッダノード
//--------------------------------------------------------------------------------------
class cmember_header extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHPBase2サンプル</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!-- 全体コンテナ　-->
<div class="container">
<header class="d-flex justify-content-center py-3 border-dark border-bottom">
<ul class="nav nav-pills">
<li class="nav-item"><a href="index.php" class="nav-link link-success">メインメニュー</a></li>
<li class="nav-item"><a href="login.php" class="nav-link link-success">ログアウト</a></li>
</ul>
</header>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	ログインヘッダノード
//--------------------------------------------------------------------------------------
class clogin_header extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHPBase2サンプル</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<!-- 全体コンテナ　-->
<div class="container">
<header class="d-flex justify-content-center py-3 border-dark border-bottom">
</header>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}


//--------------------------------------------------------------------------------------
///	メンバーログインヘッダノード
//--------------------------------------------------------------------------------------
class cmember_login_header extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHPBase2サンプル</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!-- 全体コンテナ　-->
<div class="container">
<header class="d-flex justify-content-center py-3 border-dark border-bottom">
</header>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	サイドバー付きヘッダノード
//--------------------------------------------------------------------------------------
class cside_header extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>サンプルサイト</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!-- 全体コンテナ　-->
<div class="container-fluid">
<header class="navbar sticky-top bg-secondary-subtle flex-md-nowrap p-0 shadow" >
<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-dark" href="#">サイト名</a>
</header>
	<!-- 行　-->
	<div class="row">
		<div class="sidebar border col-md-3 col-lg-2 p-1 bg-body-tertiary">
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="index.php">
						<span class="bi"></span>
						メインメニュー
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="prefecture_list.php">
						<span class="bi"></span>
						都道府県管理
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="member_list.php">
						<span class="bi"></span>
						メンバー管理
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="member_list_custom.php">
						<span class="bi"></span>
						メンバー管理（カスタムノード）
					</a>
				</li>
			</ul>
			<hr class="my-1">
			<ul class="nav flex-column mb-auto">
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="hinagata.php">
						<span class="bi"></span>
						雛形ファイル
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link d-flex align-items-center gap-2" href="hinagata2.php">
						<span class="bi"></span>
						雛形ファイル（サイドバー付き）
					</a>
				</li>
			</ul>
		</div>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	フッターノード
//--------------------------------------------------------------------------------------
class cfooter extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<footer class="bottom-0 w-full mt-auto">
    <div class="bg-thingreen">
      <div class="flex items-center">
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/index.php" class="flex items-center">
          <img src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/images/GarbaGe favicon3.png" width="60" height="60" class="ml-4" />
          <h1 class="-ml-2 text-2xl font-bold text-blackcolor font-bold">
            Garba<span class="text-sub">Ge</span>
          </h1>
        </a>
      </div>
      <div class="mx-auto w-full max-w-screen-xl flex-col p-4 md:flex md:items-center md:justify-between">
        <ul class="mt-3 flex flex-wrap items-center text-base sm:mb-10 text-explain">
          <li>
            <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/privacy.html" class="hover:underline"> プライバシーポリシー</a>
          </li>
          <li>
          <li>
            /
          </li>
          <a href="#" class="ml-1 hover:underline"> お問い合わせ</a>
          </li>
          <li>
            /
          </li>
          <li>
            <a href="#" class="ml-1 hover:underline">利用規約</a>
          <li>
            /
          </li>
          </li>
          <li>
            <a href="#" class="ml-1 hover:underline"> ヘルプ</a>
          </li>
        </ul>
        <span class="text-xs text-explain sm:text-center">© 2024 GarbaGe Inc.
        </span>
      </div>
    </div>
  </footer>

</body>

</html>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	サイドバー付きフッターノード
//--------------------------------------------------------------------------------------
class cside_footer extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

		<footer class="py-3 my-4 border-dark border-top">
			<p class="text-center text-body-secondary">&copy; 2024 サイト名</p>
		</footer>
	</div>
	<!--/ 行　-->
</div>
<!-- /全体コンテナ　-->
	<div class="b-divider"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	メンバーフッターノード
//--------------------------------------------------------------------------------------
class cmember_footer extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
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
		$echo_str = <<< END_BLOCK

<footer class="py-3 my-4 border-dark border-top">
<p class="text-center text-body-secondary">&copy; 2024 PHPBase2</p>
</footer>
</div>
<!-- /全体コンテナ　-->
<div class="b-divider"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}




//--------------------------------------------------------------------------------------
///	住所ノード
//--------------------------------------------------------------------------------------
class caddress extends cnode {
	public $param_arr;
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct($param_arr) {
		$this->param_arr = $param_arr;
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	パラメータのチェック
	@return	なし（エラーの場合はエラーフラグを立てる）
	*/
	//--------------------------------------------------------------------------------------
	public function paramchk(){
		global $err_array;
		global $err_flag;
		if($this->param_arr['cntl_header_name'] == 'par' && $_POST['member_minor'] == 0 ){
			//保護者は未成年の時だけ必須
			return;
		}
		/// 名前の存在と空白チェック
		if(cutil_ex::chkset_err_field($err_array,"{$this->param_arr['cntl_header_name']}_name","{$this->param_arr['head']}名",'isset_nl')){
			$err_flag = 1;
		}
		/// 都道府県チェック
		if(cutil_ex::chkset_err_field($err_array,"{$this->param_arr['cntl_header_name']}_prefecture_id","{$this->param_arr['head']}都道府県",'isset_num_range',1,47)){
			$err_flag = 1;
		}
		/// 住所の存在と空白チェック
		if(cutil_ex::chkset_err_field($err_array,"{$this->param_arr['cntl_header_name']}_address","{$this->param_arr['head']}市区郡町村以下",'isset_nl')){
			$err_flag = 1;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	public function create(){
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  POST変数のデフォルト値をセット
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function post_default(){
		cutil::post_default("{$this->param_arr['cntl_header_name']}_prefecture_id",0);
		cutil::post_default("{$this->param_arr['cntl_header_name']}_name",'');
		cutil::post_default("{$this->param_arr['cntl_header_name']}_address",'');
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	名前コントロールの取得
	@return	名前コントロール
	*/
	//--------------------------------------------------------------------------------------
	function get_name(){
		global $err_array;
		$ret_str = '';
		$tgt = new ctextbox("{$this->param_arr['cntl_header_name']}_name",
				$_POST["{$this->param_arr['cntl_header_name']}_name"],'size="70"');
		$ret_str = $tgt->get($_POST['func'] == 'conf');
		if(isset($err_array["{$this->param_arr['cntl_header_name']}_name"])){
			$ret_str .=  '<br /><span class="text-danger">' 
			. cutil::ret2br($err_array["{$this->param_arr['cntl_header_name']}_name"]) 
			. '</span>';
		}
		return $ret_str;
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	都道府県プルダウンの取得
	@return	都道府県プルダウン文字列
	*/
	//--------------------------------------------------------------------------------------
	function get_prefecture_select(){
		global $err_array;
		//都道府県の一覧を取得
		$prefecture_obj = new cprefecture();
		$allcount = $prefecture_obj->get_all_count(false);
		$prefecture_rows = $prefecture_obj->get_all(false,0,$allcount);
		$tgt = new cselect("{$this->param_arr['cntl_header_name']}_prefecture_id");
		$tgt->add(0,'選択してください',$_POST["{$this->param_arr['cntl_header_name']}_prefecture_id"] == 0);
		foreach($prefecture_rows as $key => $val){
			$tgt->add($val['prefecture_id'],$val['prefecture_name'],
			$val['prefecture_id'] == $_POST["{$this->param_arr['cntl_header_name']}_prefecture_id"]);
		}
		$ret_str = $tgt->get($_POST['func'] == 'conf');
		if(isset($err_array["{$this->param_arr['cntl_header_name']}_prefecture_id"])){
			$ret_str .=  '<br /><span class="text-danger">' 
			. cutil::ret2br($err_array["{$this->param_arr['cntl_header_name']}_prefecture_id"]) 
			. '</span>';
		}
		return $ret_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	住所の取得
	@return	住所文字列
	*/
	//--------------------------------------------------------------------------------------
	function get_address(){
		global $err_array;
		$tgt = new ctextbox("{$this->param_arr['cntl_header_name']}_address",
				$_POST["{$this->param_arr['cntl_header_name']}_address"],'size="80"');
		$ret_str = $tgt->get($_POST['func'] == 'conf');
		if(isset($err_array["{$this->param_arr['cntl_header_name']}_address"])){
			$ret_str .=  '<br /><span class="text-danger">' 
			. cutil::ret2br($err_array["{$this->param_arr['cntl_header_name']}_address"]) 
			. '</span>';
		}
		return $ret_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  表示(継承して使用)
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function display(){
		$name_str = "{$this->param_arr['head']}名";
		$prefec_str = "{$this->param_arr['head']}都道府県";
		$address_str = "{$this->param_arr['head']}市区郡町村以下";
//PHPブロック終了
?>
<tr>
<th class="text-center"><?= $name_str ?></th>
<td width="70%"><?= $this->get_name(); ?></td>
</tr>
<tr>
<th class="text-center"><?= $prefec_str ?></th>
<td width="70%"><?= $this->get_prefecture_select(); ?></td>
</tr>
<tr>
<th class="text-center"><?= $address_str ?></th>
<td width="70%"><?= $this->get_address(); ?></td>
</tr>
<?php 
//PHPブロック再開
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}



