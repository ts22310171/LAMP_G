<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>断捨離相談メッセージ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">断捨離相談メッセージ</h1>

        <!-- タブ切り替え -->
        <div class="mb-4">
            <button id="activeTabBtn" class="bg-blue-500 text-white px-4 py-2 rounded-l-lg focus:outline-none">有効なプラン</button>
            <button id="expiredTabBtn" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-r-lg focus:outline-none">期限切れのプラン</button>
        </div>

        <!-- メッセージ一覧 -->
        <div class="bg-white rounded-lg shadow-md overflow-y-auto" style="height: 70vh;">
            <!-- 有効なプランのメッセージ -->
            <div id="activeMessages" class="divide-y divide-gray-200">
                <a href="message_detail.html?id=1" class="block p-4 hover:bg-gray-50">
                    <p class="font-semibold">断捨離の始め方について</p>
                    <p class="text-sm text-gray-500">2024-07-11 14:30</p>
                    <p class="text-xs text-green-600">有効期限: 2024-08-11</p>
                </a>
                <!-- 他のアクティブなメッセージ -->
            </div>

            <!-- 期限切れのプランのメッセージ (初期状態では非表示) -->
            <div id="expiredMessages" class="hidden divide-y divide-gray-200">
                <a href="message_detail.html?id=2" class="block p-4 hover:bg-gray-50 opacity-50">
                    <p class="font-semibold">過去の断捨離相談</p>
                    <p class="text-sm text-gray-500">2024-06-01 10:00</p>
                    <p class="text-xs text-red-600">期限切れ: 2024-07-01</p>
                </a>
                <!-- 他の期限切れメッセージ -->
            </div>
        </div>

        <!-- 新しい相談ボタン (アクティブなプランがある場合のみ表示) -->
        <a href="message_detail.html?new=1" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">新しい相談を始める</a>

        <!-- プラン更新ボタン (期限切れの場合に表示) -->
        <a href="renew_plan.html" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 hidden" id="renewPlanBtn">プランを更新する</a>
    </div>

    <script>
        // タブ切り替えの簡単な実装
        const activeTabBtn = document.getElementById('activeTabBtn');
        const expiredTabBtn = document.getElementById('expiredTabBtn');
        const activeMessages = document.getElementById('activeMessages');
        const expiredMessages = document.getElementById('expiredMessages');
        const newConsultationBtn = document.querySelector('a[href="message_detail.html?new=1"]');
        const renewPlanBtn = document.getElementById('renewPlanBtn');

        activeTabBtn.addEventListener('click', () => {
            activeTabBtn.classList.replace('bg-gray-300', 'bg-blue-500');
            activeTabBtn.classList.replace('text-gray-700', 'text-white');
            expiredTabBtn.classList.replace('bg-blue-500', 'bg-gray-300');
            expiredTabBtn.classList.replace('text-white', 'text-gray-700');
            activeMessages.classList.remove('hidden');
            expiredMessages.classList.add('hidden');
            newConsultationBtn.classList.remove('hidden');
            renewPlanBtn.classList.add('hidden');
        });

        expiredTabBtn.addEventListener('click', () => {
            expiredTabBtn.classList.replace('bg-gray-300', 'bg-blue-500');
            expiredTabBtn.classList.replace('text-gray-700', 'text-white');
            activeTabBtn.classList.replace('bg-blue-500', 'bg-gray-300');
            activeTabBtn.classList.replace('text-white', 'text-gray-700');
            expiredMessages.classList.remove('hidden');
            activeMessages.classList.add('hidden');
            newConsultationBtn.classList.add('hidden');
            renewPlanBtn.classList.remove('hidden');
        });
    </script>
</body>

</html>