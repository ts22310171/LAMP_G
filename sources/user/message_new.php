<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規メッセージ作成</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">新規メッセージ作成</h1>
        <form class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-4">
                <label for="recipient" class="block text-gray-700 font-bold mb-2">宛先</label>
                <input type="text" id="recipient" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 font-bold mb-2">件名</label>
                <input type="text" id="subject" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-bold mb-2">メッセージ</label>
                <textarea id="message" rows="6" class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="flex justify-between">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">下書き保存</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">送信</button>
            </div>
        </form>
    </div>
</body>

</html>