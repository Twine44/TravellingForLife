<?php
if (isset($_POST['delete_user']) && isset($_POST['user_key'])) {

    $valueToDelete = $_POST['user_key'];
    $file = 'users.json';
    $data = file_get_contents($file);
    $users = json_decode($data, true);
    $key = 'username';
    foreach ($users as $key => $user) {
        if ($user['username'] == $valueToDelete) {
            unset($users[$key]);

            $newUserJson = json_encode($users, JSON_PRETTY_PRINT);
            file_put_contents('users.json', $newUserJson);
            $success = true;
            break;
        }
    }

    header('Location: userprofile.php');
    exit();
}
?>
