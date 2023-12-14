<?php
session_start();
$file = 'users.json';
$data = file_get_contents($file);
$users = json_decode($data, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $birthday = $_POST['birthday'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $repassword = $_POST['repassword'];

  $errors = array();
  if (empty($name)) {
    $errors[] = "Name is required";
  }
  if (empty($birthday)) {
    $errors[] = "Birthday is required";
  }
  if (empty($email)) {
    $errors[] = "Email is required";
  }
  if (empty($username)) {
    $errors[] = "Username is required";
  } else if (strlen($username) < 4) {
    $errors[] = "Username must be at least 4 characters long";
  }
  if (empty($password)) {
    $errors[] = "Password is required";
  } else if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long";
  }
  $taken = false;
  foreach ($users as $user) {
    if ($user['username'] === $username) {
      $taken = true;
    }
  }
  if ($taken) {
    $errors[] = "Username already taken";
  }
  if ($password !== $repassword) {
    $errors[] = "Passwords don't match";
  }

  if (empty($errors)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $user = [
      'name' => $name,
      'birthday' => $birthday,
      'email' => $email,
      'username' => $username,
      'password' => $hashedPassword,
    ];

    $users[] = $user;

    $json = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $json);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
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
        <h1 id="logreg-title">Registration</h1>
      </div>
      <form method="POST" >
        <label id="name"
          >name
          <input type="text" class="long-input" id="name-input" name="name" required />
        </label>
        <label id="bday"
          >birthday
          <input
            type="date"
            class="long-input"
            id="bday-input"
            name="birthday"
            required
          />
        </label>
        <label id="email"
          >email
          <input
          required
            type="email"
            class="long-input"
            id="email-input"
            name="email"
          />
        </label>
        <label
          >username
          <input type="text" class="long-input" name="username" required />
        </label>
        <label 
          >password
          <input type="password" class="long-input" name="password" required/>
        </label>
        <label class="repassword"
          >password again
          <input type="password" class="long-input" name="repassword" required/>
        </label>
        <div id="req"><img src="../images/question-mark-button-svgrepo-com.png" alt="qmark" id="qmark-icon">
        
          <p class="reginfotext">The username has to be minimum 4 characters long.
            The password has to be minimum 8 characters long.</p></div>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($errors)): ?>
              <div class="error-box">
                <h3>Error</h3>
                  <div>
                 <?php foreach ($errors as $error): ?>
                        <p class="errortext"><?php echo $error; ?></p>
                   <?php endforeach; ?>
                  </div>
              </div>
     <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
              <div class="error-box successbox">
                 <p class="errortext successtext">Registration successful!</p>
             </div>
    <?php endif; ?>
        <div id="regbtn-box">
          <button class="form-btn" type="submit">Sign up</button>
          <button type="reset" class="form-btn">Reset</button>
          <p id="signup-text"></p>
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
