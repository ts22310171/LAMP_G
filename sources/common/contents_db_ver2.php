<?php
class cadmin_master extends crecord {
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
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_all_count($debug){
		//プレースホルダつき
		$query = <<< END_BLOCK
select
count(*)
from
admin_master
where
1
END_BLOCK;
		//空のデータ
		$prep_arr = array();
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		if($row = $this->fetch_assoc()){
			//取得した個数を返す
			return $row['count(*)'];
		}
		else{
			return 0;
		}
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	すべての配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug){
		$arr = array();
		//プレースホルダつき
		$query = <<< END_BLOCK
select
admin_master.*
from
admin_master
where
1
order by
admin_master.admin_master_id asc
END_BLOCK;
		//空のデータ
		$prep_arr = array();
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		//順次取り出す
		while($row = $this->fetch_assoc()){
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug,$id){
		if(!cutil::is_number($id)
		||  $id < 1){
			//falseを返す
			return false;
		}
		//プレースホルダつき
		$query = <<< END_BLOCK
select
admin_master.*
from
admin_master
where
admin_master.admin_master_id = :admin_master_id
END_BLOCK;
		$prep_arr = array(
				':admin_master_id' => (int)$id
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたログインIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$loginid		ログインID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt_login($debug,$loginid){
		if($loginid == ''){
			//falseを返す
			return false;
		}
		//プレースホルダつき
		$query = <<< END_BLOCK
select
admin_master.*
from
admin_master
where
admin_login = :admin_login
END_BLOCK;
		$prep_arr = array(
				':admin_login' => (string)$loginid
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
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