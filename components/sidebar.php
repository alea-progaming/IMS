<div class="sidebar" id="sidebar">
  <h3 class="sidebarLogo">IMS</h3>
  <div class="sidebarUser">
    <img src="https://th.bing.com/th/id/OIP.CsYrFeOAo4RCyVHZbTaMkAAAAA?w=400&h=400&rs=1&pid=ImgDetMain" alt="User image." />
    <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
  </div>
  <div class="sidebarMenus">
    <ul class="sidebarList">
      <!-- // * add this function: class="active" -->
      <li>
            <a href="./dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <li>
            <a href="./users.php"><i class="fa fa-user-o"></i> <span>Users</span></a>
      </li>
      <!-- <li>
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
      </li> -->
  </ul>
</div>