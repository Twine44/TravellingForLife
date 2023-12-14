<?php
session_start();
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');
$price = 1;
$personCount = 1;
$location = "";
$nights = 1;

if (isset($_COOKIE['price'])) {
  $price = $_COOKIE['price'];
} else {
  error_log("Cookie price not set");
}

if (isset($_COOKIE['person-count'])) {
  $personCount = $_COOKIE['person-count'];
} else {
  error_log("Cookie personCount not set");
}
if (isset($_COOKIE['location'])) {
  $location = $_COOKIE['location'];
} else {
  error_log("Cookie location not set");
}
if (isset($_COOKIE['nights'])) {
  $nights = $_COOKIE['nights'];
} else {
  error_log("Cookie nights not set");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $userJson = file_get_contents('users.json');
  $users = json_decode($userJson, true);

  $loggedInUser = $_SESSION['username'];

  foreach ($users as &$user) {
    if ($user['username'] === $loggedInUser) {
      $newBooking = array(
        'location' => $location,
        'price' => $price * $personCount,
        'nights' => $nights,
        'personcount' => $personCount
      );
      $user['bookings'][$location] = $newBooking;
      break;
    }
  }
  if (!$loggedInUser) {
    error_log('Could not find current user in JSON');
    exit;
  }

  $newUserJson = json_encode($users, JSON_PRETTY_PRINT);
  file_put_contents('users.json', $newUserJson);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="../css/bookingpage.css" />
  <link rel="icon" type="image/png" href="/Travelling/images/travel.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />
  <title>Booking</title>
</head>

<body>
  <header class="header">
    <nav>
      <a href="home.php" id="logo">T4life</a>
      <ul id="navlinks">
        <li><a href="home.php">Home</a></li>
        <li><a href="bookings.php" id="current-page">Browse</a></li>
        <?php
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
  <div class="main-wrapper">
    <section id="mainsection" class="main-info">
      <h1 id="header1">A random Place</h1>
      <h2 id="header2">In a random hotel</h2>
      <div id="slider" class="slider">
        <div class="slide animate">
          <img src="/Travelling/images/placeholder.jpg" id="img1" alt="firstpic" />
        </div>

        <div class="slide">
          <img src="/Travelling/images/placeholder.jpg" id="img2" alt="secondpic" />
        </div>

        <div class="slide">
          <img src="/Travelling/images/placeholder.jpg" id="img3" alt="thirdpic" />
        </div>

        <div class="slide">
          <img src="/Travelling/images/placeholder.jpg" id="img4" alt="fourthpic" />
        </div>

        <button class="btn btn-next">></button>
        <button class="btn btn-prev">&lt;</button>
      </div>
      <article>
        <h2 class="articleheader">Description</h2>
        <p class="articletext" id="article1">placeholder 1</p>
        <p class="articletext" id="article2">placeholder 2</p>
      </article>
    </section>
    <aside class="bookingbox">
      <h2 class="bookingheader">Booking info</h2>
      <div class="infogrid">
        <p class="staticinfo">Time Period</p>
        <p id="period">period</p>
        <p class="staticinfo">Hotel name</p>
        <p id="hotel">hotel</p>
        <p class="staticinfo">Price per person</p>
        <p id="price">x HUF</p>
        <p class="staticinfo">Available rooms</p>
        <p id="rooms">x Rooms</p>
      </div>
      <form method="post">
        <div>
          <label for="person-count"> How many of you are coming?</label>
          <select id="person-count" name="person-count">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
        <button type="submit" class="bookingbutton">Book this place!</button>
      </form>
    </aside>
  </div>
  <script src="../JS/bookingpage.js"></script>
  <script src="../JS/bookingpageslider.js"></script>
 
</body>

</html>