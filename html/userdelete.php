<?php
session_start();
if (isset($_SESSION['username'])) {
    $file = 'users.json';
    $data = file_get_contents($file);
    $users = json_decode($data, true);
    $key = 'username';
    $valueToDelete = $_SESSION['username'];
    $success = false;
    foreach ($users as $key => $user) {
        if ($user['username'] == $valueToDelete) {
            unset($users[$key]);
            unset($_SESSION['username']);
            $newUserJson = json_encode($users, JSON_PRETTY_PRINT);
            file_put_contents('users.json', $newUserJson);
            $success = true;
            break;
        }
    }
    if ($success) {
        header('Location: registration.php');
    } else {
        header('Location: userprofile.php');
    }
}
?>