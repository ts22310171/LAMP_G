<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>断捨離相談メッセージボックス</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="rounded-lg bg-white p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-bold">メッセージボックス</h1>

            <!-- メッセージ表示エリア -->
            <div class="mb-4 h-96 overflow-y-auto rounded bg-gray-50 p-4">
                <!-- メッセージ例 -->
                <div class="mb-4 border-b pb-2">
                    <p class="text-sm text-gray-600">From: 相談者 | 2024-07-11 10:30</p>
                    <div class="mt-1 rounded-lg bg-blue-100 p-3">
                        <p class="text-sm">断捨離を始めたいのですが、どこから手をつければいいでしょうか？</p>
                    </div>
                </div>
                <div class="mb-4 border-b pb-2">
                    <p class="text-sm text-gray-600">From: アドバイザー | 2024-07-11 14:45</p>
                    <div class="mt-1 rounded-lg bg-green-100 p-3">
                        <p class="text-sm">まずは、使用頻度の低いものから始めるのがおすすめです。例えば、クローゼットの中の服を見直してみましょう。</p>
                    </div>
                </div>
            </div>

            <!-- メッセージ入力フォーム -->
            <form class="mt-4">
                <textarea placeholder="メッセージを入力" class="mb-2 w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
                <div class="flex justify-between">
                    <button type="button" class="rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">下書き保存</button>
                    <button type="submit" class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">送信</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>