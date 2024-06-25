<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/css/app.css" />

  <!-- Script -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="tailwind.config.js"></script>
</head>

<body class="bg-main">
  <header>
    <div class="bg-main h-20 flex justify-between items-center fixed top-0 left-0 w-full z-10 h-16">
      <div class="flex items-center">
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/index.php" class="flex items-center">
          <img src="http://wiz.developluna.jp/~d202425/LAMP_G/sources/images/GarbaGe favicon2.png" width="60" height="60" class="ml-4" />
          <div class="-ml-2 text-2xl text-blackcolor font-bold">
            Garba<span class="text-sub">Ge</span>
          </div>
        </a>
      </div>
      <div>
        <a href="http://wiz.developluna.jp/~d202425/LAMP_G/sources/user/login.php" class="text-base text-blackcolor font-bold mr-5">
          ログイン
        </a>
      </div>
      <div class="container">
        <button class="btn" id="btn">
          Dropdown
          <i class="bx bx-chevron-down" id="arrow"></i>
        </button>

        <div class="dropdown" id="dropdown">
          <a href="#create">
            <i class="bx bx-plus-circle"></i>
            Create New
          </a>
          <a href="#draft">
            <i class="bx bx-book"></i>
            All Drafts
          </a>
          <a href="#move">
            <i class="bx bx-folder"></i>
            Move To
          </a>
          <a href="#profile">
            <i class="bx bx-user"></i>
            Profile Settings
          </a>
          <a href="#notification">
            <i class="bx bx-bell"></i>
            Notification
          </a>
          <a href="#settings">
            <i class="bx bx-cog"></i>
            Settings
          </a>
        </div>
      </div>
    </div>
  </header>
  <script>
    const dropdownBtn = document.getElementById("btn");
    const dropdownMenu = document.getElementById("dropdown");
    const toggleArrow = document.getElementById("arrow");

    // Toggle dropdown function
    const toggleDropdown = function() {
      dropdownMenu.classList.toggle("show");
      toggleArrow.classList.toggle("arrow");
    };

    // Toggle dropdown open/close when dropdown button is clicked
    dropdownBtn.addEventListener("click", function(e) {
      e.stopPropagation();
      toggleDropdown();
    });

    // Close dropdown when dom element is clicked
    document.documentElement.addEventListener("click", function() {
      if (dropdownMenu.classList.contains("show")) {
        toggleDropdown();
      }
    });
  </script>
</body>

</html>