// タブ切り替えの簡単な実装
const activeTabBtn = document.getElementById("activeTabBtn");
const expiredTabBtn = document.getElementById("expiredTabBtn");
const activeMessages = document.getElementById("activeMessages");
const expiredMessages = document.getElementById("expiredMessages");
const newConsultationBtn = document.querySelector(
  'a[href="message_detail.html?new=1"]'
);
const renewPlanBtn = document.getElementById("renewPlanBtn");

activeTabBtn.addEventListener("click", () => {
  activeTabBtn.classList.replace("bg-gray-300", "bg-blue-500");
  activeTabBtn.classList.replace("text-gray-700", "text-white");
  expiredTabBtn.classList.replace("bg-blue-500", "bg-gray-300");
  expiredTabBtn.classList.replace("text-white", "text-gray-700");
  activeMessages.classList.remove("hidden");
  expiredMessages.classList.add("hidden");
  newConsultationBtn.classList.remove("hidden");
  renewPlanBtn.classList.add("hidden");
});

expiredTabBtn.addEventListener("click", () => {
  expiredTabBtn.classList.replace("bg-gray-300", "bg-blue-500");
  expiredTabBtn.classList.replace("text-gray-700", "text-white");
  activeTabBtn.classList.replace("bg-blue-500", "bg-gray-300");
  activeTabBtn.classList.replace("text-white", "text-gray-700");
  expiredMessages.classList.remove("hidden");
  activeMessages.classList.add("hidden");
  newConsultationBtn.classList.add("hidden");
  renewPlanBtn.classList.remove("hidden");
});
document.addEventListener("DOMContentLoaded", function () {
  const activeTabBtn = document.getElementById("activeTabBtn");
  const expiredTabBtn = document.getElementById("expiredTabBtn");
  const activeMessages = document.getElementById("activeMessages");
  const expiredMessages = document.getElementById("expiredMessages");

  activeTabBtn.addEventListener("click", function () {
    activeMessages.classList.remove("hidden");
    expiredMessages.classList.add("hidden");
    activeTabBtn.classList.add("bg-blue-500", "text-white");
    activeTabBtn.classList.remove("bg-gray-300", "text-gray-700");
    expiredTabBtn.classList.add("bg-gray-300", "text-gray-700");
    expiredTabBtn.classList.remove("bg-blue-500", "text-white");
  });

  expiredTabBtn.addEventListener("click", function () {
    activeMessages.classList.add("hidden");
    expiredMessages.classList.remove("hidden");
    expiredTabBtn.classList.add("bg-blue-500", "text-white");
    expiredTabBtn.classList.remove("bg-gray-300", "text-gray-700");
    activeTabBtn.classList.add("bg-gray-300", "text-gray-700");
    activeTabBtn.classList.remove("bg-blue-500", "text-white");
  });

  document.querySelectorAll(".close-room-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const roomId = this.getAttribute("data-room-id");
      fetch("close_room.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          room_id: roomId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            location.reload();
          } else {
            alert("ルームを閉じることができませんでした。");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          alert("ルームを閉じることができませんでした。");
        });
    });
  });
});
