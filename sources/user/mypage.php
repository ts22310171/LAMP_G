<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";  // 自分の設定に変更
$password = "";  // 自分の設定に変更
$dbname = "mypage_db";

// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

// ユーザーIDを取得
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_id = $row['id'];

// チャット履歴を取得
$chat_sql = "SELECT * FROM chat_history WHERE user_id = $user_id ORDER BY created_at DESC";
$chat_result = $conn->query($chat_sql);

// 購入履歴を取得
$purchase_sql = "SELECT * FROM purchase_history WHERE user_id = $user_id ORDER BY purchased_at DESC";
$purchase_result = $conn->query($purchase_sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .history {
            margin-bottom: 30px;
        }
        .history h3 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .history p {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to your page, <?php echo $_SESSION['username']; ?>!</h2>

        <div class="history">
            <h3>Chat History</h3>
            <?php
            if ($chat_result->num_rows > 0) {
                while($chat_row = $chat_result->fetch_assoc()) {
                    echo "<p><strong>" . $chat_row['created_at'] . ":</strong> " . $chat_row['message'] . "</p>";
                }
            } else {
                echo "<p>No chat history.</p>";
            }
            ?>
        </div>

        <div class="history">
            <h3>Purchase History</h3>
            <?php
            if ($purchase_result->num_rows > 0) {
                while($purchase_row = $purchase_result->fetch_assoc()) {
                    echo "<p><strong>" . $purchase_row['purchased_at'] . ":</strong> " . $purchase_row['item_name'] . " - $" . $purchase_row['amount'] . "</p>";
                }
            } else {
                echo "<p>No purchase history.</p>";
            }
            ?>
        </div>

        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
