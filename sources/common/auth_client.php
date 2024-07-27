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
if ((!isset($_SESSION['client']['name']))
    || (!isset($_SESSION['client']['login']))
) {

    cutil::redirect_exit(ABSOLUTE_URL . "/sources/client/login.php");

}
$client = new cclient();
$row = $client->get_tgt_login(false, $_SESSION['client']['login']);
if ($row === false || !isset($row['login'])) {

    cutil::redirect_exit(ABSOLUTE_URL . "/sources/client/login.php");
}

if ($row['login'] != $_SESSION['client']['login']) {
    cutil::redirect_exit(ABSOLUTE_URL . "/sources/client/login.php");

}


function get_member_name()
{
    if (isset($_SESSION['client']['name'])) {
        return $_SESSION['client']['name'];
    } else {
        return '';
    }
}
