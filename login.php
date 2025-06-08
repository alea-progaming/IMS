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
          <form action="index.php" novalidate>
            <div class="input-form">
              <label for="username">Username</label>
              <input type="email" name="username" id="username" />
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
