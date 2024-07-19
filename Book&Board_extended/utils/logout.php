<?php
// On user logout button click, we want to log the user out
session_start();
session_unset(); // remove all global variables related to the session
session_destroy(); // destroy all data associated with the session

setcookie("loggedIn", "", time() - 3600, "/"); // unset cookie

header("Location: ../pages/login.php"); // redirect to the home page
exit();