<?php
session_start();
if(isset($_SESSION['user'])) header('Location: admin.php');

$err_msg = '';

if ($_POST) {
  include("database/connection.php"); // connects using PDO
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

      // Prepare statement securely
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $users = $stmt->fetchAll();

    $user_exist = false;
    
    foreach ($users as $user) {
      $user_pass = $user['password'];
      if($password == $user_pass) {
        $user_exist = true;
        $_SESSION['user'] = $user;
        break;
      }
    }
    
    if ($user_exist) {
      header('Location: admin.php');
      exit;
    } else {
      $err_msg = "Please make sure that the email and password are correct.";
    } 
      

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IMS | Login</title>
    <link rel="stylesheet" href="./styles/styles.css" />
  </head>
  <body id="login">
    <center>
      <?php if (!empty($err_msg)) : ?>
      <div class="errorMessage">
        <p><strong>Error:</strong> <?= htmlspecialchars($err_msg) ?></p>
      </div>
    <?php endif ?>
      <main>
        
        <h1>IMS</h1>
        <h2>Inventory Management System</h2>
        <section class="login-box">
          <h3>LOG IN</h3>
          <form action="login.php" method="POST" novalidate>
            <div class="input-form">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" />
            </div>
            <div class="input-form">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" />
            </div>
            <div class="input-form">
              <button type="submit">Login</button>
            </div>
          </form>
        </section>
      </main>
    </center>
  </body>
</html>
