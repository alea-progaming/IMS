<?php 
  session_start();

  if(!isset($_SESSION['user'])) header('Location: ../'); 
  $_SESSION['table'] = 'users'; // * turns out i actually forgot to put this here
  $user = $_SESSION['user'];

?>

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
      <!-- // * Sidebar -->
      <?php include('components/sidebar.php')?>
    </div>
    <div class="dashboardContentContainer" id="dashboardContentContainer">
        <!-- // * Top Nav -->
        <?php include('components/topnav.php')?>
        
        <div class="dashboardContent">
          <div class="contentMain">
            <div class="userFormContainer">
              <form action="database/user-add.php" method="POST" class="appForm">
                <div class="appFormDiv">
                  <label for="fName">First Name</label>
                  <input type="text" class="formInput" name="fName" id="fName">
                </div>
                <div class="appFormDiv">
                  <label for="lName">Last Name</label>
                  <input type="text" class="formInput" name="lName" id="lName">
                </div>
                <div class="appFormDiv">
                  <label for="email">Email</label>
                  <input type="text" class="formInput" name="email" id="email">
                </div>
                <div class="appFormDiv">
                  <label for="pass">Password</label>
                  <input type="password" class="formInput" name="pass" id="pass">
                </div>
                <input type="hidden" name="table" value="users">
                <button type="submit"><i class="fa fa-plus"></i>Add user</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/sidebarToggle.js"></script>
  </body>
</html>
