<?php
//--------------------------------------------------------------------------------------
/// メッセージクラス
//--------------------------------------------------------------------------------------
class cmessage extends crecord
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
    @brief  指定されたルームIDのメッセージを取得する
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $room_id    ルームID
    @return 配列（2次元配列になる）空の場合はfalse
    */
    //--------------------------------------------------------------------------------------
    public function get_room_messages($debug, $room_id)
    {
        if (!cutil::is_number($room_id) || $room_id < 1) {
            return false;
        }

        $arr = array(); // 配列を初期化

        $query = <<< END_BLOCK
SELECT m.*,
CASE
WHEN m.sender_type = 'user' THEN u.name
ELSE c.name
END AS sender_name
FROM messages m 
LEFT JOIN users u ON m.sender_id = u.id AND m.sender_type = 'user'
LEFT JOIN clients c ON m.sender_id = c.id AND m.sender_type = 'client'
WHERE m.room_id = :room_id 
ORDER BY m.created_at ASC
END_BLOCK;

        $prep_arr = array(
            ':room_id' => (int)$room_id
        );

        // クエリの実行結果をチェック
        if (!$this->select_query($debug, $query, $prep_arr)) {
            return false; // クエリが失敗した場合は false を返す
        }

        while ($row = $this->fetch_assoc()) {
            $arr[] = $row;
        }

        // メッセージが存在しない場合は空の配列を返す
        return !empty($arr) ? $arr : array();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief  メッセージを追加する
    @param[in]  $debug  デバッグ出力をするかどうか
    @param[in]  $dataarr    追加するデータの配列
    @return 挿入されたメッセージのID
    */
    //--------------------------------------------------------------------------------------
    public function insert_message($debug, $dataarr)
    {
        if (!is_array($dataarr)) {
            //falseを返す
            return false;
        }
        //親クラスのinsert_core()メンバ関数を呼ぶ
        return $this->insert_core($debug, 'messages', $dataarr);
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
