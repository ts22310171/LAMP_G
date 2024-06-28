<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

// データベース接続の作成
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
