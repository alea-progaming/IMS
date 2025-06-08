<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IMS | Admin</title>
    <link rel="stylesheet" href="./styles/styles.css" />
    <link
      rel="stylesheet"
      href="./assets/font-awesome-4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div id="dashboardMainContainer">
      <div class="sidebar" id="sidebar">
        <h3 class="sidebarLogo">IMS</h3>
        <div class="sidebarUser">
          <img
            src="https://th.bing.com/th/id/OIP.CsYrFeOAo4RCyVHZbTaMkAAAAA?w=400&h=400&rs=1&pid=ImgDetMain"
            alt="User image."
          />
          <span>Doe</span>
        </div>
        <div class="sidebarMenus">
          <ul class="sidebarList">
  <li class="active">
    <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
  </li>
  <li>
    <a href="#"><i class="fa fa-bullhorn"></i> <span>Campaigns</span></a>
  </li>
  <li>
    <a href="#"><i class="fa fa-usd"></i> <span>Revenue Management</span></a>
  </li>
  <li>
    <a href="#"><i class="fa fa-book"></i> <span>Accounts Receivable</span></a>
  </li>
  <li>
    <a href="#"><i class="fa fa-cogs"></i> <span>Configuration</span></a>
  </li>
  <li>
    <a href="#"><i class="fa fa-line-chart"></i> <span>Stats</span></a>
  </li>
</ul>

        </div>
      </div>
      <div class="dashboardContentContainer" id="dashboardContentContainer">
        <div class="dashboardTopNav">
          <a href="" id="toggleBtn"> <li class="fa fa-navicon"></li></a>
          <a href="" id="logoutBtn">
            <li class="fa fa-power-off"></li>
            Logout</a
          >
        </div>
        <div class="dashboardContent">
          <div class="contentMain"></div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleBtn");
        const sidebar = document.getElementById("sidebar");
        const dashboardContentContainer = document.getElementById(
          "dashboardContentContainer"
        );

        let isShrunk = false;

        toggleBtn.addEventListener("click", (event) => {
        event.preventDefault();
        isShrunk = !isShrunk;

        if (isShrunk) {
          sidebar.classList.add("shrink");
          sidebar.style.width = "12%";
          dashboardContentContainer.style.width = "88%";
        } else {
          sidebar.classList.remove("shrink");
          sidebar.style.width = "25%";
          dashboardContentContainer.style.width = "75%";
        }
        });

      });
    </script>
  </body>
</html>
