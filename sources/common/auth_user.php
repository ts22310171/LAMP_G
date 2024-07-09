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
session_start();
if ((!isset($_SESSION['user']['name']))
    || (!isset($_SESSION['user']['email']))
) {
    cutil::redirect_exit(ABSOLUTE_URL . "/sources/user/login.php");
}
$user = new cuser();
$row = $user->get_tgt_login(false, $_SESSION['user']['email']);
if ($row === false || !isset($row['email'])) {
    cutil::redirect_exit(ABSOLUTE_URL . "/sources/user/login.php");
}

if ($row['email'] != $_SESSION['user']['email']) {
    cutil::redirect_exit(ABSOLUTE_URL . "/sources/user/login.php");
}


function get_member_name()
{
    if (isset($_SESSION['user']['name'])) {
        return $_SESSION['user']['name'];
    } else {
        return '';
    }
}
