<?php 
  session_start();

  if(!isset($_SESSION['user'])) header('Location: ./'); 
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
        <?php include('components/topnav.php')?>
        
        <div class="dashboardContent">
          <div class="contentMain"></div>
        </div>
      </div>
    </div>
    <script src="js/sidebarToggle.js"></script>
  </body>
</html>
