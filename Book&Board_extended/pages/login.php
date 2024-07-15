<?php
// Start output buffering - this ensures no hmtl content is sent to the browser until the script checks for id error
ob_start();
include '../partials/header.php';
include '../partials/navbar.php';
include '../../db/database.php';

?>

<link rel="stylesheet" href="../css/login.css">
<title>B&B Travel - Login</title>
</head>
<main role="main">
    <section id="login-section">
        <div class="tabs">
            <button id="login-tab" class="tab-links" onclick="openTab(event, 'login-content')">Login</button>
            <button id="register-tab" class="tab-links" onclick="openTab(event, 'register-content')">Register</button>
        </div>
        <div id="login-content" class="tab-content">Login</div>
        <div id="register-content" class="tab-content">Register</div>
        <!-- <div id="login-or-register">
            <h1 id="login-heading">Login</h1>
            <h1 id="login-heading">Register</h1>
        </div>
        <p>Please login or register for an account</p>
        <form id="search-form" action="../pages/offers.php" method="GET">
            <div class="search-input">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" aria-required="true" maxlength="100">
            </div>
            <div class="search-input">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" aria-required="true" maxlength="100">
            </div>

            <div id="login-buttons">
                <input id="login" type="submit" onclick="" value="Login">
                <input id="register" type="submit" onclick="" value="Register">
            </div>
        </form> -->

    </section>
</main>

<script src="../js/login.js"></script>
<?php include '../partials/footer.php';
ob_end_flush(); ?>