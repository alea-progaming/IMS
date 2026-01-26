<?php 
  session_start();

  if(!isset($_SESSION['user'])) header('Location: ./'); 
  $user = $_SESSION['user'];
  $users = include('database/show-users.php');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <div class="user-row">
              <div class="user-col user-col-5">
                <h1 class="section_header"><i class="fa fa-plus"></i>Create User</h1>
                <div class="userFormContainer">
                  <form action="database/add-user.php" method="POST" class="appForm">
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
              <div class="user-col user-col-7">
                <h1 class="section_header"><i class="fa fa-list"></i>List of Users</h1>
                <div class="section_content">
                  <div class="users">
                    <table>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>
                      </tr>
                      <tbody>
                        <?php foreach($users as $index => $user) { ?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td><?= $user['first_name'] ?></td>
                          <td><?= $user['last_name'] ?></td>
                          <td><?= $user['email'] ?></td>
                          <td><?= date('M d, Y @ H:i:s', strtotime($user['created_at'])); ?></td>
                          <td><?= date('M d, Y @ H:i:s', strtotime($user['updated_at'])); ?></td>
                          <td>
                            <a href="#" class="editUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>" data-email="<?= $user['email'] ?>"><i class="fa fa-pencil" "></i> Edit</a>
                            <a href="#" class="delUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <p class="userCount"><?= count($users) ?> Users</p>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form here from javascript -->
      </div>
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
    <script src="js/sidebarToggle.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/users.js"></script>
  </body>
</html>
