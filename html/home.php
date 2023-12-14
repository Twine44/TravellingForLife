<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/Travelling/images/travel.png" />
  <title>Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
  <div id="banner">
    <nav>
      <a href="home.php" id="logo">T4life</a>
      <ul id="navlinks">
        <li><a href="home.php" id="current-page">Home</a></li>
        <li><a href="bookings.php">Browse</a></li>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
          echo '<li><a href="userprofile.php">' . $_SESSION['username'] . '</a></li>';
        } else {
          echo '<li><a href="login.php">Login</a></li>';
        }
        ?>
      </ul>
    </nav>
    <h1 id="bannertitle">Travelling for life</h1>
    <div id="blackbox" class="blackbox"></div>
  </div>
  <div class="container">
    <a href="bookings.php" id="browse-btn">Browse</a>
    <div id="content">
      <div class="section-box">
        <div class="section-img">
          <img src="../images/pexels-roman-odintsov-4553618.jpg" alt="side" class="side-image" />
        </div>
        <div class="section-text">
          <p>
            Welcome to our <strong>travel website!</strong> Here, we aim to
            inspire and guide you through your wanderlust journey, whether
            you're a seasoned traveler or new to exploring the world. Our
            website is a one-stop-shop for all things travel-related, with
            comprehensive guides, insider tips, and destination
            recommendations that will help you plan your perfect adventure.
          </p>
        </div>
      </div>
      <div class="section-box" id="second-section">
        <div class="section-text">
          <p>
            We understand that traveling can be a life-changing experience,
            and we want to make sure you have all the information and
            resources you need to make your trips unforgettable. Our team of
            experienced travelers has scoured the globe, seeking out the most
            incredible destinations, hidden gems, and unique experiences to
            share with you.
          </p>
        </div>
        <div class="section-img">
          <img src="../images/pexels-eyup-beyhan-7602068.jpg" alt="side" class="side-image" />
        </div>
      </div>
      <div class="section-box">
        <div class="section-img">
          <img src="../images/pexels-ainbinder-5029795.jpg" alt="side" class="side-image" />
        </div>
        <div class="section-text">
          <p>
            So, whether you're looking for a romantic getaway, an epic
            adventure, or simply want to unwind and recharge in a stunning
            location, we've got you covered. Join us on a journey of discovery
            and let us help you plan your next unforgettable travel
            experience.
          </p>
        </div>
      </div>
    </div>
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