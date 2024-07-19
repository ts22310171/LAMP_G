<?php
//--------------------------------------------------------------------------------------
///	メンバークラス
//--------------------------------------------------------------------------------------
class cplan extends crecord
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
products
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
products.*
from
products
order by
id asc
limit :from, :limit
END_BLOCK;
        $prep_arr = array(
            ':from' => (int)$from,
            ':limit' => (int)$limit
        );
        $this->select_query($debug, $query, $prep_arr);
        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }
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
    public function get_tgt($debug, $plan_id)
    {
        if (
            !cutil::is_number($plan_id)
            ||  $plan_id < 1
        ) {
            //falseを返す
            return false;
        }
        //プレースホルダつき
        $query = <<< END_BLOCK
select
products.*
from
products
where
id = :plan_id
END_BLOCK;
        $prep_arr = array(
            ':plan_id' => (int)$plan_id
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
    @brief	デストラクタ
	*/
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}
