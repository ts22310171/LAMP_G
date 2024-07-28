document.addEventListener("DOMContentLoaded", function () {
  const imageUpload = document.getElementById("image-upload");
  const imagePreview = document.getElementById("image-preview");
  const contentInput = document.getElementById("content");
  const submitButton = document.querySelector('button[type="submit"]');

  function toggleSubmitButton() {
    const isDisabled =
      contentInput.value.trim() === "" && imageUpload.value === "";
    submitButton.disabled = isDisabled;
    submitButton.classList.toggle("cursor-not-allowed", isDisabled);
    submitButton.classList.toggle("opacity-50", isDisabled);
  }

  function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.innerHTML = `<img src="${e.target.result}" alt="プレビュー" class="mt-2 max-w-full h-auto rounded-lg">`;
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.innerHTML = "";
    }
    toggleSubmitButton();
  }

  imageUpload.addEventListener("change", handleImageUpload);
  contentInput.addEventListener("input", toggleSubmitButton);

  // 初期状態のチェック
  toggleSubmitButton();
});
