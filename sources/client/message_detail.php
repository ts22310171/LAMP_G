<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メッセージ詳細</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <a href="message_list.html" class="text-blue-500 hover:underline mb-4 inline-block">&larr; 一覧に戻る</a>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-bold">アドバイザー山田</h2>
                    <p class="text-sm text-gray-500">2024-07-11 14:30</p>
                </div>
                <p class="text-gray-700">断捨離のアドバイスについて、まずは使用頻度の低いものから始めることをおすすめします。例えば、クローゼットの中の服を見直してみましょう。1年以上着ていない服があれば、それは処分の候補になるかもしれません。</p>
            </div>
            <form>
                <textarea class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" rows="4" placeholder="返信を入力してください"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">返信する</button>
            </form>
        </div>
    </div>
</body>

</html>