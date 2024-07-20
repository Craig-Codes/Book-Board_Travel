<?php
// On user logout button click, we want to log the user out
session_start();
session_unset(); // remove all global variables related to the session
session_destroy(); // destroy all data associated with the session

setcookie("loggedIn", "", time() - 3600, "/"); // unset cookie
// Next time a page loads, the user will no longer have a cookie 
// and will not be able to access protected routes such as the accounts page

header("Location: ../pages/login.php"); // redirect to the home page
exit();