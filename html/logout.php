<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['username']);
$_SESSION = array();
session_destroy();

header('Location: login.php');
exit;
?>
