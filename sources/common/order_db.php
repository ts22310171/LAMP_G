<?php
//--------------------------------------------------------------------------------------
///	注文クラス
//--------------------------------------------------------------------------------------
class corder extends crecord
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
orders
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
orders.*
from
orders
order by
orders.id asc
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
    public function get_tgt($debug, $user_id)
    {
        if (
            !cutil::is_number($user_id)
            ||  $user_id < 1
        ) {
            //falseを返す
            return false;
        }
        //プレースホルダつき
        $query = <<< END_BLOCK
select
orders.*
from
orders
where
id = :user_id
END_BLOCK;
        $prep_arr = array(
            ':user_id' => (int)$user_id
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
    @brief 注文情報を追加する
    @param[in] $debug デバッグ出力をするかどうか
    @param[in] $user_id ユーザーID
    @param[in] $product_id プロダクトID 
    @return bool 成功時はtrue、失敗時はfalse
    */
    //--------------------------------------------------------------------------------------
    public function process_purchase($debug, $user_id, $product_id)
    {
        if (!cutil::is_number($user_id) || $user_id < 1 || !cutil::is_number($product_id) || $product_id < 1) {
            return false;
        }

        $product = $this->get_product($debug, $product_id);
        if (!$product) {
            return false;
        }

        $purchase_date = date('Y-m-d');
        $expiry_date = date('Y-m-d', strtotime("+{$product['duration']} days -1 day"));

        $dataarr = array(
            'user_id' => (int)$user_id,
            'product_id' => (int)$product_id,
            'purchase_date' => $purchase_date,
            'expiry_date' => $expiry_date,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
        );

        $table = 'orders';

        return $this->insert_core($debug, $table, $dataarr);
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief  商品情報を取得する
    @param[in]  $debug      デバッグ出力をするかどうか
    @param[in]  $product_id 商品ID
    @return 商品情報の配列、存在しない場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_product($debug, $product_id)
    {
        if (!cutil::is_number($product_id) || $product_id < 1) {
            return false;
        }

        $query = "SELECT * FROM products WHERE id = :product_id";
        $prep_arr = array(':product_id' => (int)$product_id);

        $this->select_query($debug, $query, $prep_arr);
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
