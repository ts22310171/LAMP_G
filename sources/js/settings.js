// settings.js

document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('deleteModal');
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');
    const closeDeleteModalBtn = document.querySelectorAll('[onclick="closeDeleteModal()"]');
    const openDeleteModalBtn = document.querySelectorAll('[onclick="openDeleteModal()"]');

    openDeleteModalBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            deleteModal.classList.remove('hidden');
        });
    });

    closeDeleteModalBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
        });
    });

    deleteAccountBtn.addEventListener('click', () => {
        // アカウント削除の処理をここに追加
        alert('アカウントが削除されました！');
        deleteModal.classList.add('hidden');
    });

    window.addEventListener('click', (event) => {
        if (event.target == deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });
});

function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
