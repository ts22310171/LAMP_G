<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メッセージ一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">メッセージ一覧</h1>
        <div class="bg-white rounded-lg shadow-md">
            <ul class="divide-y divide-gray-200">
                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                    <a href="message_detail.html?id=1" class="block">
                        <div class="flex justify-between">
                            <p class="font-semibold">アドバイザー山田</p>
                            <p class="text-sm text-gray-500">2024-07-11 14:30</p>
                        </div>
                        <p class="text-gray-600 truncate">断捨離のアドバイスについて...</p>
                    </a>
                </li>
                <li class="p-4 hover:bg-gray-50 cursor-pointer">
                    <a href="message_detail.html?id=2" class="block">
                        <div class="flex justify-between">
                            <p class="font-semibold">サポート担当</p>
                            <p class="text-sm text-gray-500">2024-07-10 09:15</p>
                        </div>
                        <p class="text-gray-600 truncate">プラン変更の確認が完了しました...</p>
                    </a>
                </li>
                <!-- 他のメッセージアイテム -->
            </ul>
        </div>
    </div>
</body>

</html>