<?php
// Start output buffering - this ensures no hmtl content is sent to the browser until the script checks for id error
ob_start();
include '../partials/header.php';
include '../partials/navbar.php';
include '../../db/database.php';
include '../utils/utils.php';
include '../utils/db_helpers.php';

$login = false;
$register = false;
$loginError = false;
$registerError = false;
// Check to see if we have any POST request data
if (!empty($_POST)) {
    // Check for each potential parameter and validate using helper method in utils/utils.php
    // Validate login inputs
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = validateLoginInput("username");
        $password = validateLoginInput("password");
        // Ensure none of the unputs are null values
        if ($username !== null && $password !== null) {
            $login = true;
        }
    }
    // Validate register inputs
    if ( // Ensure all inputs are found, and that the passwords match
        !empty($_POST['register-username'])
        && !empty($_POST['register-password'])
        && !empty($_POST['confirm-password'])
        && !empty($_POST['email'])
        && $_POST['confirm-password'] === $_POST['register-password']
    ) {
        $username = validateLoginInput("register-username");
        $password = validateLoginInput("register-password");
        $confirmPassword = validateLoginInput("confirm-password");
        $email = validateLoginInput("email");
        // Ensure none of the unputs are null values
        if ($username !== null && $password !== null && $confirmPassword !== null && $email !== null) {
            $register = true;
        }
    }
}

// IF login -> DB
if ($login) {
    // try / catch - loginError = true 
    // Login route -dbhelpers
    // Start a session
}
if ($register) {
    // try / catch - registerError = true
    // Register route -dbhelpers
    //start a session
}

?>

<link rel="stylesheet" href="../css/login.css">
<title>B&B Travel - Login</title>
</head>
<main role="main">
    <section id="login-section">
        <!-- Flash any error to the user to keep them informed -->
        <!-- If we have a login error -->
        <?php if ($loginError) {
            echo ('
                <div class="error" role="article">
                <h4>Unable to login, please try again.
                </h4></div>');
        } ?>
        <!-- If we have a register error -->
        <?php if ($registerError) {
            echo ('
                <div class="error" role="article">
                <h4>Unable to register a new user, please try again.
                </h4></div>');
        } ?>
        <div class="tabs">
            <!-- Tabs control what content is displayed to the user, either the login form or the register form -->
            <button id="login-tab" class="tab-links" onclick="openTab(event, 'login-content')">Login</button>
            <button id="register-tab" class="tab-links" onclick="openTab(event, 'register-content')">Register</button>
        </div>
        <div id="login-content" class="tab-content">
            <!-- On login form submit, we want to go back to the login.php script for validation -->
            <!-- Basic frontend validation carried out by the forms, ensuring required items are filled in, and lengths are correct -->
            <!-- POST requests are used to stop user passwords being visibile as query parameters, instead sending in the request body -->
            <form id="login-form" action="../pages/login.php" method="POST">
                <div class="search-input">
                    <label for="username">Username:</label>
                    <!-- Basic frontend validation using maxLength to limit username length -->
                    <input type="text" id="username" name="username" aria-required="true" maxlength="100"
                        required="true">
                </div>
                <div id="login-username-error"></div>
                <div class="search-input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" aria-required="true" maxlength="100"
                        required="true">
                </div>
                <div id="login-password-error"></div>

                <input id="login" type="submit" onclick="" value="Login">
            </form>
        </div>
        <div id="register-content" class="tab-content">
            <!-- On register form submit, we want to go back to the login.php script for validation -->
            <form id="register-form" action="../pages/login.php" method="POST">
                <div class="search-input">
                    <label for="username">Username:</label>
                    <input type="text" id="register-username" name="register-username" aria-required="true"
                        maxlength="100" required="true">
                </div>
                <div id="register-username-error"></div>
                <div class="search-input">
                    <label for="password">Password:</label>
                    <input type="password" id="register-password" name="register-password" aria-required="true"
                        maxlength="100" required="true">
                </div>
                <div id="password-error"></div>
                <div class="search-input">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" aria-required="true"
                        maxlength="100" required="true">
                </div>
                <div id="confirm-password-error"></div>
                <div class="search-input email">
                    <!-- Basic frontend validation using email type to ensure input is a valid email address -->
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" aria-required="true" required="true">
                </div>
                <div id="email-error"></div>
                <!-- Additional validation to check passwords match, before form is submitted -->
                <input id="register" type="submit" onclick="handleRegisterSubmit(event)" value="Register">
            </form>
        </div>
    </section>
</main>

<script src="../js/login.js"></script>
<?php include '../partials/footer.php';
ob_end_flush(); ?>