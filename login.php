<?php 
include("database/connection.php"); // connects using PDO

if ($_POST) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Test query
    $query = 'SELECT * FROM users WHERE email = "'.$email.'" AND password = "'.$password.'"';

    $stmt = $conn->prepare($query);
    $result = $stmt->execute(['email'=>$email]);

    var_dump($stmt->rowCount());
    die();

    // try {
    //     $stmt = $conn->query($query); // use query() for basic testing (unsafe, but fine for local testing)
    //     $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetch data as associative array

    //     if (count($results) > 0) {
    //         echo "✅ Found user(s):<br>";
    //         foreach ($results as $row) {
    //             echo "🧑‍💻 Email: " . $row['email'] . "<br>";
    //         }
    //     } else {
    //         echo "❌ No matching user found.";
    //     }
    // } catch (PDOException $e) {
    //     echo "Database error: " . $e->getMessage();
    // }
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
