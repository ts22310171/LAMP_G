<?php
//--------------------------------------------------------------------------------------
///	メンバークラス
//--------------------------------------------------------------------------------------
class cuser extends crecord
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
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
    //--------------------------------------------------------------------------------------
    public function get_all_count($debug)
    {
        //プレースホルダつき
        $query = <<< END_BLOCK
select
count(*)
from
member,prefecture
where
member.prefecture_id = prefecture.prefecture_id
END_BLOCK;
        //空のデータ
        $prep_arr = array();
        //親クラスのselect_query()メンバ関数を呼ぶ
        $this->select_query(
            $debug,            //デバッグ表示するかどうか
            $query,            //プレースホルダつきSQL
            $prep_arr        //データの配列
        );
        if ($row = $this->fetch_assoc()) {
            //取得した個数を返す
            return $row['count(*)'];
        } else {
            return 0;
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
	@brief	指定された範囲の配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$from	抽出開始行
	@param[in]	$limit	抽出数
	@return	配列（2次元配列になる）
	*/
    //--------------------------------------------------------------------------------------
    public function get_all($debug, $from, $limit)
    {
        $arr = array();
        //プレースホルダつき
        $query = <<< END_BLOCK
select
member.*,prefecture.*
from
member,prefecture
where
member.prefecture_id = prefecture.prefecture_id
order by
member.member_id asc
limit :from, :limit
END_BLOCK;
        $prep_arr = array(
            ':from' => (int)$from,
            ':limit' => (int)$limit
        );
        //親クラスのselect_query()メンバ関数を呼ぶ
        $this->select_query(
            $debug,            //デバッグ表示するかどうか
            $query,            //プレースホルダつきSQL
            $prep_arr        //データの配列
        );
        //順次取り出す
        while ($row = $this->fetch_assoc()) {
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
    public function get_tgt($debug, $id)
    {
        if (
            !cutil::is_number($id)
            ||  $id < 1
        ) {
            //falseを返す
            return false;
        }
        //プレースホルダつき
        $query = <<< END_BLOCK
select
member.*,prefecture.*
from
member,prefecture
where
member.prefecture_id = prefecture.prefecture_id
and
member.member_id = :member_id
END_BLOCK;
        $prep_arr = array(
            ':member_id' => (int)$id
        );
        //親クラスのselect_query()メンバ関数を呼ぶ
        $this->select_query(
            $debug,            //デバッグ表示するかどうか
            $query,            //プレースホルダつきSQL
            $prep_arr        //データの配列
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
    public function get_tgt_login($debug, $loginid)
    {
        if ($loginid == '') {
            //falseを返す
            return false;
        }
        //プレースホルダつき
        $query = <<< END_BLOCK
select
users.*
from
users
where
member_login = :member_login
END_BLOCK;
        $prep_arr = array(
            ':member_login' => (string)$loginid
        );
        //親クラスのselect_query()メンバ関数を呼ぶ
        $this->select_query(
            $debug,            //デバッグ表示するかどうか
            $query,            //プレースホルダつきSQL
            $prep_arr        //データの配列
        );
        return $this->fetch_assoc();
    }
    public function create_user()
    {
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
