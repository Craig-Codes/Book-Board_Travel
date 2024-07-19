<!-- This partial sets up the navbar which is included in each page -->
<?php

// Check session. If user is logged in, change the login button to display logout and user account button
if (!isset($_SESSION['username']) && (!isset($_COOKIE['loggedIn']) || $_COOKIE['loggedIn'] !== "true")) {
    $isLoggedIn = false;
} else {
    $isLoggedIn = true;
}

?>

<nav class="header">
    <a href="#" class="logo">B&B</a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn">
        <span class="navicon"></span>
    </label>
    <ul class="menu">
        <li><a href="../index.php">Home</a></li>
        <li><a href="../pages/offers.php">Offers</a></li>
        <li><a href="../pages/contact.php">Contact Us</a></li>
        <!-- Change login / logout button based in if a user is currently logged in or out -->
        <?php if ($isLoggedIn) { ?>
            <!-- Trigger logout function in php or JS? -->
            <li id="logout"><a id="logout-button" href="../pages/account.php">Account</a></li>
            <li id="logout"><a id="logout-button" href="../utils/logout.php">Logout</a></li>
        <?php } else { ?>
            <li id="login"><a id="login-button" href="../pages/login.php">Login</a></li>
        <?php } ?>
    </ul>
</nav>