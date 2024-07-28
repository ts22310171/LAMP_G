document
  .getElementById("image-upload")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById("image-preview");

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        preview.innerHTML = `<img src="${e.target.result}" alt="プレビュー" class="mt-2 max-w-full h-auto rounded-lg">`;
      };

      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = "";
    }
  });
