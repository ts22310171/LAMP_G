<?php

/********************************

auth_member.php

メンバーログイン認証
認証が必要なページはこのファイルをインクルードする
すでにlibs.phpがインクルードされている必要がある
 *複数のサイトが同居またはユーザー管理と混同しないため
$_SESSIONは多次元配列にする

             2024/5/20 Y.YAMANOI
 *********************************/
if (!isset($_SESSION)) {
    session_start();
}

require_once("../common/auth_user.php");
$user_id = $_SESSION['user']['id'];

$room_obj = new croom();

// ユーザーのすべてのルームを取得
$active_room = $room_obj->get_active_room(false, $user_id);

// 現在の日時を取得
$current_date = date('Y-m-d');

if ($active_room !== false) {
    var_dump($active_room);
    // ルームの有効期限をチェック
    if ($active_room['expiry_date'] <= $current_date) { // 期限が切れている場合、ステータスを "expired" に更新
        if ($active_room['status'] !== 'closed') {
            $room_obj->update_room_status(false, $active_room['id'], 'closed');
            $active_room['status'] = 'closed'; // 更新後のステータスを反映
        }
    } else {
        cutil::redirect_exit(ABSOLUTE_URL . "/sources/user/message_list.php");
    }
}
