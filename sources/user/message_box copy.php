<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メッセージ詳細 / 新規作成</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <a href="messages.html" class="mb-4 inline-block text-blue-500 hover:underline">&larr; メッセージ一覧に戻る</a>

        <div class="rounded-lg bg-white p-6 shadow-md">
            <!-- 既存のメッセージ詳細 (新規作成の場合は非表示) -->
            <div id="messageDetails" class="mb-6">
                <h2 class="mb-2 text-xl font-bold">断捨離の始め方について</h2>
                <p class="mb-4 text-sm text-green-600">有効期限: 2024-08-11</p>
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
            </div>

            <!-- 新規メッセージ作成フォーム -->
            <form>
                <!-- 新規相談の場合のみ表示 -->
                <div id="newConsultation" class="mb-4 hidden">
                    <label for="title" class="mb-2 block font-bold text-gray-700">相談タイトル</label>
                    <input type="text" id="title" class="w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div class="mb-4">
                    <label for="message" class="mb-2 block font-bold text-gray-700">メッセージ</label>
                    <textarea id="message" rows="6" class="w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-between">
                    <button type="button" class="rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-gray-600">下書き保存</button>
                    <button type="submit" class="rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">送信</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // URLパラメータを取得して、新規作成モードかどうかを判断
        const urlParams = new URLSearchParams(window.location.search);
        const isNewMessage = urlParams.get('new') === '1';

        if (isNewMessage) {
            document.getElementById('messageDetails').style.display = 'none';
            document.getElementById('newConsultation').style.display = 'block';
        }
    </script>
</body>

</html>