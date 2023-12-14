<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="../css/bookings.css" />
  <link rel="icon" type="image/png" href="/Travelling/images/travel.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />
  <title>Browse bookings</title>
</head>

<body>
  <header class="header">
    <nav>
      <a href="home.php" id="logo">T4life</a>
      <ul id="navlinks">
        <li><a href="home.php">Home</a></li>
        <li><a href="bookings.php" id="current-page">Browse</a></li>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
          echo '<li><a href="userprofile.php"  class="nav-black">' . $_SESSION['username'] . '</a></li>';
        } else {
          echo '<li><a href="login.php"  class="nav-black">Login</a></li>';
        }
        ?>
      </ul>
    </nav>
    <hr id="nav-line" />
  </header>
  <div class="title">
    <h1>Find your perfect vacation place!</h1>
  </div>
  <div class="main-container">
    <h2>
      Discover endless possibilities for your next getaway with our wide range
      <br />
      of available bookings, all at your fingertips for easy browsing.
    </h2>
    <div id="bookingcontent" class="content-grid"></div>
  </div>
  <script src="../JS/createbooking.js"></script>
</body>

</html>