
<?php
//--------------------------------------------------------------------------------------
///	ルームクラス
//--------------------------------------------------------------------------------------
class croom extends crecord
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
    @brief  ルームを作成する
    @param[in]  $debug      デバッグ出力をするかどうか
    @param[in]  $user_id    ユーザーID
    @param[in]  $client_id  クライアントID
    @param[in]  $order_id   注文ID
    @param[in]  $name       ルーム名
    @return 作成されたルームのID、失敗時はfalse
    */
    //--------------------------------------------------------------------------------------
    public function create_room($debug, $user_id, $client_id, $order_id, $name)
    {
        if (
            !cutil::is_number($user_id) || $user_id < 1 ||
            !cutil::is_number($client_id) || $client_id < 1 ||
            !cutil::is_number($order_id) || $order_id < 1 ||
            empty($name)
        ) {
            return false;
        }

        $dataarr = array(
            'user_id' => (int)$user_id,
            'client_id' => (int)$client_id,
            'order_id' => (int)$order_id,
            'name' => $name,
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $table = 'rooms';

        $result = $this->insert_core($debug, $table, $dataarr);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  ルーム情報を取得する
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $id     ルームID
    @return ルーム情報の配列、存在しない場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_room($debug, $id)
    {
        if (!cutil::is_number($id) || $id < 1) {
            return false;
        }

        $query = "SELECT * FROM rooms WHERE id = :id";
        $prep_arr = array(':id' => (int)$id);

        $this->select_query($debug, $query, $prep_arr);
        return $this->fetch_assoc();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  ユーザーのすべてのルームを取得する
    @param[in]  $debug      デバッグ出力をするかどうか
    @param[in]  $user_id    ユーザーID
    @return ルーム情報の配列、存在しない場合は空の配列
    */
    //--------------------------------------------------------------------------------------
    public function get_user_rooms($debug, $user_id)
    {
        if (!cutil::is_number($user_id) || $user_id < 1) {
            return array();
        }

        $query = "SELECT * FROM rooms WHERE user_id = :user_id ORDER BY created_at DESC";
        $prep_arr = array(':user_id' => (int)$user_id);

        $this->select_query($debug, $query, $prep_arr);
        $result = array();

        while ($row = $this->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  ルームのステータスを更新する
    @param[in]  $debug      デバッグ出力をするかどうか
    @param[in]  $id         ルームID
    @param[in]  $status     新しいステータス
    @return 更新が成功した場合は更新された行数、失敗した場合は0
    */
    //--------------------------------------------------------------------------------------
    public function update_room_status($debug, $id, $status)
    {
        if (!cutil::is_number($id) || $id < 1 || empty($status)) {
            return 0;
        }

        $table = 'rooms';
        $dataarr = array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $where = 'id = :id';
        $wherearr = array(':id' => (int)$id);

        return $this->update_core($debug, $table, $dataarr, $where, $wherearr);
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
