<?php
// Start output buffering - this ensures no hmtl content is sent to the browser until the script checks for id error
ob_start();
include '../partials/header.php';
include '../partials/navbar.php';
include '../../db/database.php';
include '../utils/utils.php';
include '../utils/db_helpers.php';

// error state flags, allowing the correct output to be given to the user on a login or register failure
$login = false;
$register = false;
// Store the error message to be output to the user
$loginError;
$registerError;

// Check to see if we have any POST request data
if (!empty($_POST)) {
    // Check for each potential parameter and validate using helper method in utils/utils.php
    // Validate login inputs
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = validateLoginInput("username");
        $inputPassword = validateLoginInput("password");
        // Ensure none of the unputs are null values
        if ($username !== null && $inputPassword !== null) {
            $login = true;
            $register = false;
        } else {
            $loginError = "Ensure username and password are no longer than 100 characters, and no shorter than 5 characters";
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
        $inputPassword = validateLoginInput("register-password");
        $confirmPassword = validateLoginInput("confirm-password");
        $email = validateEmailInput("email"); // DO A SEPERATE VALIDATION HERE!!!


        // Ensure none of the inputs are null values
        if ($username !== null && $inputPassword !== null && $confirmPassword !== null && $email !== null) {
            if ($inputPassword !== $confirmPassword) {
                $registerError = "Passwords do not match";
            } else {
                $register = true;
                $login = false;
            }
        } else {
            // Check what validation caused the error - checking that the email address was validated
            if ($email === null) {
                $registerError = "Email is not a valid address";
            } else {
                $registerError = "Ensure username and password are no longer than 100 characters, and no shorter than 5 characters";
            }
        }
    }
}

if ($login) { // If login data is verified and complete, attempt to log user in
    try {
        // Try and get the user
        $hashedPassword = Database::getUserPassword($_POST['username']);
        if ($hashedPassword === null) { // If we get null, a user was not found
            $loginError = "No user was found"; // No user found
        } else {
            $inputPassword = $_POST["password"];
            // Check if entered password matches the hashed and salted password stored in the DB
            if (password_verify($inputPassword, $hashedPassword)) {
                // Credentials are correct - Start Session
                session_start();
                $_SESSION["username"] = $_POST['username']; // use the users unique username as a session value
                setcookie("loggedIn", "true", time() + (12 * 3600), "/"); // set cookie for 12 hours
                header('Location: account.php');
                exit;
            } else {
                $loginError = "Incorrect password";
            }
        }
    } catch (Exception $e) {
        $loginError = "Unable to retrieve user";
    }
}

if ($register) { // If register data is verified and complete, attempt to register user
    try {
        // Check that username doesn't already exist
        $userAlreadyExists = Database::checkUser($_POST['register-username']);
        if ($userAlreadyExists) {
            $registerError = "User already exists";
        } else {
            // Create new user
            try {
                $user = Database::insertUser($_POST['register-username'], $_POST['register-password'], $_POST['email']);
                if ($user === false) {
                    $registerError = "Unable to create new user";
                } else {
                    // Start Session
                    header('Location: profile.php');
                    exit;
                }
            } catch (Exception $e) {
                $registerError = "Email address has already been used";
            }


        }
    } catch (Exception $e) {
        $registerError = "Unable to create new user";
    }
}

?>

<link rel="stylesheet" href="../css/login.css">
<title>B&B Travel - Login</title>
</head>
<main role="main">
    <section id="login-section">
        <!-- Flash any error to the user to keep them informed -->
        <!-- If we have a login error -->
        <?php if (isset($loginError)) {
            echo ("
            <div class='error' role='article'>
                <h4>$loginError</h4>
            </div>
        ");
        } ?>
        <!-- If we have a register error -->
        <?php if (isset($registerError)) {
            echo ("
        <div class='error' role='article'>
            <h4>$registerError</h4>
        </div>
    ");
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
                    <input type="text" id="username" name="username" aria-required="true" maxlength="100" minLength="5"
                        required>
                </div>
                <div id="login-username-error"></div>
                <div class="search-input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" aria-required="true" maxlength="100"
                        minLength="5" required="true">
                </div>
                <div id="login-password-error"></div>

                <input id="login" type="submit" onclick="" value="Login">
            </form>
        </div>
        <div id="register-content" class="tab-content">
            <!-- On register form submit, we want to go back to the login.php script for validation -->
            <form id="register-form" action="../pages/login.php" method="POST">
                <div class="search-input">
                    <label for="register-username">Username:</label>
                    <input type="text" id="register-username" name="register-username" aria-required="true"
                        maxlength="100" minlength="5" required>
                    <div id="register-username-error" class="error" style="display: none;">Username must be at least 5
                        characters long.</div>
                </div>
                <div class="search-input">
                    <label for="register-password">Password:</label>
                    <input type="password" id="register-password" name="register-password" aria-required="true"
                        maxlength="100" minlength="5" required>
                    <div id="password-error" style="display: none;">Password must be at least 5 characters
                        long.</div>
                </div>
                <div class="search-input">
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" aria-required="true"
                        maxlength="100" minlength="5" required>
                    <div id="confirm-password-error" style="display: none;">Passwords do not match.</div>
                </div>
                <div class="search-input email">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" aria-required="true" required>
                    <div id="email-error" style="display: none;">Invalid email address.</div>
                </div>
                <input id="register" type="submit" value="Register">
            </form>

        </div>
    </section>
</main>

<script src="../js/login.js"></script>
<?php include '../partials/footer.php';
ob_end_flush(); ?>