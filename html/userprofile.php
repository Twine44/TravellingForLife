<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

$user = $_SESSION['user'];
$userJson = file_get_contents('users.json');
$users = json_decode($userJson, true);
$loggedInUser = $_SESSION['username'];

$admin = false;
if ($_SESSION['username'] == "admin") {
  $admin = true;
}

foreach ($users as $user2) {
  if ($user2['username'] === $loggedInUser) {
    if (isset($user2['bookings'])) {
      $bookings = $user2['bookings'];
    }
    $user = $user2;
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($users as $key => $user) {
    if ($user['username'] === $loggedInUser) {
      $name = $_POST['name'];
      $birthday = $_POST['birthday'];
      $password = $_POST['password'];

      if ($birthday != "") {
        $user['birthday'] = $birthday;
        $users[$key]['birthday'] = $birthday;
      }
      if ($name != "") {
        $user['name'] = $name;
        $users[$key]['name'] = $name;
      }
      if ($password != "") {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user['password'] = $password;
        $users[$key]['password'] = $password;
      }

    }
  }

  $newUserJson = json_encode($users, JSON_PRETTY_PRINT);
  file_put_contents('users.json', $newUserJson);

  session_regenerate_id(true);
  $_SESSION['loggedInUser'] = $loggedInUser;

  header('Location: userprofile.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="../css/bookingpage.css" />
  <link rel="stylesheet" href="../css/userprofile.css" />
  <link rel="icon" type="image/png" href="/Travelling/images/travel.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet" />

  <title>User Profile</title>
</head>

<body>
  <header class="header">
    <nav>
      <a href="home.php" id="logo">T4life</a>
      <ul id="navlinks">
        <li><a href="home.php">Home</a></li>
        <li><a href="bookings.php">Browse</a></li>
        <?php
        if (isset($_SESSION['username'])) {
          echo '<li><a href="userprofile.php" id="current-page" class="nav-black">' . $_SESSION['username'] . '</a></li>';
        } else {
          echo '<li><a href="login.php" id="current-page" class="nav-black">Login</a></li>';
        }
        ?>
      </ul>
    </nav>
    <hr id="nav-line" />
  </header>

<div class="mainbox">
  <div class="userbox">
    <h2 class="userheader">User Profile</h2>
    <div class="infogrid">
      <p class="staticinfo"> <strong>Username</strong> </p>
      <p>
        <?php echo $user['username']; ?>
      </p>
      <p class="staticinfo"> <strong>Name</strong> </p>
      <p>
        <?php echo $user['name']; ?>
      </p>
      <p class="staticinfo"> <strong>Email</strong> </p>
      <p>
        <?php echo $user['email']; ?>
      </p>
      <p class="staticinfo">
        <strong>Birthday</strong>
      </p>
      <p >
        <?php echo $user['birthday']; ?>
      </p>
    </div>
    <div class="btn-box">
      <a class="logout" href="logout.php">Log out</a>
      
    </div>
  </div>
  <div class="bookingbox">
  <h2 class="userheader">Your bookings</h2>
        <?php if (isset($bookings)) {
          foreach ($bookings as $location => $booking) {
            $price = $booking['price'];
            $nights = $booking['nights'];
            $personCount = $booking['personcount'];
            echo "<div class='userbookings'>
              <p class='lefttext'> $location </p>
              <p> $nights</p>
              <p class='lefttext moneytext'> $price HUF </p>
              <p> Booked for $personCount</p>
              </div>";
          }
        } else {
          echo "<div><p>You have no bookings yet</p></div>";
        } ?>
      
  </div>
  </div>
  <div class="lastbox">
  <button id="toggleFormBtn" class="profilebutton">Change my profile</button>
  <form method="post"  id="profileForm" style="display:none;">
        <label for="name" class="proflabel">Name</label>
        <input type="text" id="name" name="name" class="profinput"/>
        <label for="birthday" class="proflabel">Birthday</label>
        <input type="date" id="birthday" name="birthday"  class="profinput"/>
        <label for="password" class="proflabel">Password</label>
        <input type="password" id="password" name="password" class="profinput"/>

        <input type="submit" value="Update Profile" />
        <a class="logout delete" href="userdelete.php">Delete Profile</a>
    </form>
    <!-- Az admin jelszó, hogy ki lehessen próbálni: 12345678 -->
    <?php if ($admin) {
      echo '<div class="adminbox">
      <h2>Admin panel</h2>
      <div class="adminusers">';
      foreach ($users as $key => $user) {
        $name = $user['username'];
        if ($user['username'] !== $loggedInUser) {
          echo "<div class='oneuserdiv'><p class='oneusertext'>";
          echo $user['username'];
          echo "</p>";
          echo "<form method='post' action='delete_user.php' class='adminform'>
              <input type='hidden' name='user_key' value='$name'>
              <input type='submit' class='logout delete deluser' name='delete_user' value='Delete user'>
            </form>";
          echo "</div>";
        }
      }
      echo "</div></div>";
    }
    ?>
    </div>
    <script>
    document.getElementById("toggleFormBtn").addEventListener("click", function() {
        var form = document.getElementById("profileForm");
        if (form.style.display === "none") {
            form.style.display = "flex";
        } else {
            form.style.display = "none";
        }
    });
</script>
</body>
</html>