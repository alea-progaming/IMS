<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: admin.php');
    exit;
}

$err_msg = '';

if ($_POST) {
    include("database/connection.php");

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // check if the user inputs email and password
    if ($email && $password) {
          // ? prepares a statement for execution and return a statement object -- src:php.net
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
          // ? to safely bind $email to the prep query for the value of email in your database
        $stmt->bindParam(':email', $email);
          // ? this is only when the sql is run or executed
        $stmt->execute();

          // ? pull one row from the result set, if the fetch found a user with that email, it will return the associative array of the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

          // ! confirm user's email and verify password. Password hashing is safe protocol ALWAYS 
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: admin.php');
            exit;
        } else {
            $err_msg = "Please make sure that the email and password are correct.";
        }
    } else {
        $err_msg = "Invalid email or missing password.";
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
