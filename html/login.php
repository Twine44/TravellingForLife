<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $file = 'users.json';
  $data = file_get_contents($file);
  $users = json_decode($data, true);

  $username = $_POST['username'];
  $password = $_POST['password'];

  foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      $_SESSION['username'] = $username;
      if (isset($_COOKIE['username'])) {
        session_start();
        header('Location: userprofile.php');
        exit;
      }
      setcookie('username', $username, time() + (30 * 24 * 60 * 60));

      header('Location: userprofile.php');
      exit;
    }
  }
  $isValidUsername = false;
  $errorMessage = '';

  foreach ($users as $user) {
    if ($user['username'] === $username) {
      $isValidUsername = true;
      break;
    }
  }

  if (!$isValidUsername) {
    $errorMessage = 'Invalid username';
  } else {
    $errorMessage = 'Invalid password';
  }

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" type="image/png" href="/Travelling/images/travel.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
    <nav>
      <a href="home.php" id="logo" class="nav-black">T4life</a>
      <ul id="navlinks">
        <li><a href="home.php" class="nav-black">Home</a></li>
        <li><a href="bookings.php" class="nav-black">Browse</a></li>
        <li>
          <a href="login.php" id="current-page" class="nav-black">Login</a>
        </li>
      </ul>
    </nav>
    <hr id="nav-line" />

    <div class="container">
      <div id="title-box">
        <h1 id="logreg-title">Login</h1>
      </div>
      <form method="POST">
        <label
          >username
          <input type="text" name="username" />
        </label>
        <label
          >password
          <input type="password" name="password" />
        </label>
        <?php if (isset($errorMessage)): ?>
                  <div class="error-box">
                    <div>
                    <p class="errortext"><?php
                    echo $errorMessage; ?></p>  
                    </div>
                    </div>
        <?php endif; ?>
        <div id="logbtn-box">
          <button type="submit" class="form-btn">Sign in</button>
          <p id="signup-text">
            If you don’t have an account
            <a href="registration.php" id="signup">Sign up</a> first.
          </p>
        </div>
      </form>
    </div>
    <footer>
      <div id="socialmedia">
        <h1>Follow us on Social Media</h1>
        <p>
          Follow us on our social media pages to stay up-to-date with the latest
          travel updates, destination guides, and insider tips. Join our
          community of fellow travelers and get inspired by the incredible
          places we share.
        </p>
      </div>
      <div id="information">
        <h1>Information</h1>
        <p>
          email: t4life@supportmail.com<br />phone: +1 646 980 4741<br />address:
          Albuquerque, New-Mexico 87121, United States
        </p>
      </div>
    </footer>
  </body>
</html>
