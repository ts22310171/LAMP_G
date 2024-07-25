<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>断捨離相談メッセージボックス</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-main flex flex-col min-h-screen">
    <div class="container mx-auto p-4">
        <div class="rounded-lg bg-white p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-bold">メッセージボックス</h1>

            <!-- メッセージ表示エリア -->
            <div class="mb-4 h-96 overflow-y-auto rounded bg-gray-50 p-4">
                <?php foreach ($messages as $message) : ?>
                    <?php if ($message['sender_type'] == 'client') : ?>
                        <!-- クライアントのメッセージ -->
                        <div class="mb-4 flex justify-start">
                            <div class="max-w-md">
                                <p class="text-sm text-gray-600">From: <?= htmlspecialchars($message['client_name']) ?> | <?= $message['created_at'] ?></p>
                                <div class="mt-1 rounded-lg bg-blue-100 p-3">
                                    <p class="text-sm"><?= htmlspecialchars($message['content']) ?></p>
                                    <?php if ($message['image']) : ?>
                                        <img src="<?= htmlspecialchars($message['image']) ?>" alt="添付画像" class="mt-2 max-w-full h-auto">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- アドバイザー（ユーザー）のメッセージ -->
                        <div class="mb-4 flex justify-end">
                            <div class="max-w-md">
                                <p class="text-right text-sm text-gray-600">From: <?= htmlspecialchars($message['user_name']) ?> | <?= $message['created_at'] ?></p>
                                <div class="mt-1 rounded-lg bg-green-100 p-3">
                                    <p class="text-sm"><?= htmlspecialchars($message['content']) ?></p>
                                    <?php if ($message['image']) : ?>
                                        <img src="<?= htmlspecialchars($message['image']) ?>" alt="添付画像" class="mt-2 max-w-full h-auto">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- メッセージ入力フォーム -->
            <form action="send_message.php" method="post" enctype="multipart/form-data" class="mt-4">
                <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                <div class="flex items-start space-x-4">
                    <div>
                        <label for="image-upload" class="mb-2 block text-sm font-medium text-gray-700">画像をアップロード</label>
                        <input type="file" id="image-upload" name="image" accept="image/*" class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none" />
                    </div>
                    <textarea name="content" placeholder="メッセージを入力" class="mb-2 w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                </div>
                <div class="mt-4 flex justify-between">
                    <button type="submit" class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">送信</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>