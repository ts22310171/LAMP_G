<?php
/*!
@file config.php
@brief DB接続変数と、エンコードの定義
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/
////////////////////////////////////
//実行ブロック
//データベースマネージメント
define('DB_RDBMS','mysql');
//MySQLの場合のキャラ設定にSET NAMESを使用するかどうか
define('DB_MYSQL_SET_NAMES','1');
//ホスト(ローカルの場合は'localhost'と記述)
define('DB_HOST','localhost');
//ユーザー
define('DB_USER','d202425db');
//パスワード
define('DB_PASS','NRPiH7UKpNBsxjXB');
//DB名
define('DB_NAME','d202425db');
//DBのキャラセット
define('DB_CHARSET','utf8');
//PHPのキャラセット
define('PHP_CHARSET','UTF-8');
//暗号化のキー
define('MY_AES_KEY','phpbase_key');
//絶対URLの共通部分
define('ABSOLUTE_URL','http://wiz.developluna.jp/~d202425/LAMP_G');
//絶対パスの共通部分
define('ABSOLUTE_PATH','/home/d202425/public_html/LAMP_G');