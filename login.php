<?php

session_start();
$err_msg = '';
if ($_POST) {
  include("database/connection.php"); // connects using PDO
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!$email || !$password) {
      $err_msg = "Please input a valid email and password";
    } else {
      // Test query
    $query = 'SELECT * FROM users WHERE email = "'.$email.'" AND password = "'.$password.'" LIMIT 1';
      // Prepare statement securely
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
            if ($password == $user['password']) {
                $err_msg = "✅ Login successful!";
            } else {
                $err_msg = "Incorrect email or password.";
            }
        } else {
            $err_msg = "Incorrect email or passwordaaa.";
        }
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
