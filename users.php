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
              <div class="col col-7">
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
                            <a href="#"><i class="fa fa-pencil"></i> Edit</a>
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
            
            
          </div>
        </div>
      </div>
    </div>
    <script src="js/sidebarToggle.js"></script>
    <script>
      function script() {
        this.initialize = function() {
          this.registerEvents(); // this will hold the events that the current page will have
        },
        this.registerEvents = function() {
          document.addEventListener('click', function(event) {
            targetElement = event.target;
            classList = targetElement.classList;
            // console.log(classList);
            
              if(classList.contains('delUser')) {
                event.preventDefault();
                userid = targetElement.dataset.userid;
                lname = targetElement.dataset.lname;
                fname = targetElement.dataset.fname;
                fullName = fname + ' ' + lname;
                // console.log(userid);

                if(window.confirm("Are you sure you want to delete " + fullName + "?")) {
                  fetch('database/delete-user.php', {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                      user_id: userid,
                      l_name: lname,
                      f_name: fname,
                    })
                  })
                  .then(response => {
                    if(!response.ok) throw new Error("Network error!");
                    return response.json();
                  })
                  .then(data => {
                    if(data.success) {
                          if(window.confirm(data.message)) {
                            location.reload();
                          }
                        } else window.confirm(data.message)
                  })
                  .catch(error => {
                    console.error("There was a problem: ", error);
                  });
                } else {
                  console.log("Do not delete user.");
                }
              }
            })
        }
      }

      var script = new script;
      script.initialize();
    </script>
  </body>
</html>
