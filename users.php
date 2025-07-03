<?php 
  session_start();

  if(!isset($_SESSION['user'])) header('Location: ../'); 
  $_SESSION['table'] = 'users'; // * turns out i actually forgot to put this here
  $user = $_SESSION['user'];
  $users = include('database/show-users.php');
    // var_dump($users);
    // die;
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
            <div class="row">
              <div class="col col-5">
                <h1 class="section_header"><i class="fa fa-plus"></i>Create User</h1>
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
                  <?php 
                    if(isset($_SESSION['shortPass'])) {
                      echo "<div><p class='responseMessage_error'>" . $_SESSION['shortPass'] . "</p></div>";
                      unset($_SESSION['shortPass']); // So it doesn’t stick forever
                    }

                    if (isset($_SESSION['invalidEmail'])) {
                      echo "<div><p class='responseMessage_error'>" . $_SESSION['invalidEmail'] . "</p></div>";
                      unset($_SESSION['invalidEmail']); // So it doesn’t stick forever
                    }

                    if(isset($_SESSION['response'])) {
                      $response_msg = $_SESSION['response']['message'];
                      $is_success = $_SESSION['response']['success' ];
                  ?>
                  <div class="responseMessage">
                    <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error' ?>">
                      <?= $response_msg ?>  
                    </p>
                  </div>
                  <?php unset($_SESSION['response']); } ?>
                </div>
              </div>
              <div class="col col-7">
                <h1 class="section_header"><i class="fa fa-list"></i>List of Users</h1>
                <div class="section_content">
                  <div class="users">
                    <table>
                      <tr>
                        <th>#</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                      </tr>
                      <tbody>
                        <?php foreach($users as $index => $user) { ?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td><?= $user['last_name'] ?></td>
                          <td><?= $user['first_name'] ?></td>
                          <td><?= $user['email'] ?></td>
                          <td><?= date('M d, Y @ H:i:s', strtotime($user['created_at'])); ?></td>
                          <td><?= date('M d, Y @ H:i:s', strtotime($user['updated_at'])); ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
    <script src="js/sidebarToggle.js"></script>
  </body>
</html>
