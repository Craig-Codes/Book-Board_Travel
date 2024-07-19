<?php
// Start output buffering and session at the very beginning
ob_start();
session_start();

// If NOT logged in (session) - Redirect home
if (!isset($_SESSION['username']) && (!isset($_COOKIE['loggedIn']) || $_COOKIE['loggedIn'] !== "true")) {
    header("Location: login.php");
    exit();
}

// Refresh the cookie for another 12 hours if logged in user visits the profile page
if (isset($_SESSION['username']) && isset($_COOKIE['loggedIn'])) {
    setcookie("loggedIn", "true", time() + (12 * 3600), "/");
}

// Include partials
include '../partials/header.php';
include '../partials/navbar.php';
?>

<link rel="stylesheet" href="../css/error.css">
<title>B&B Travel - Profile</title>
</head>

<main role="main">
    <section id="error" aria-labelledby="error-heading" role="alert">
        <h1 id="error-heading">Logged In</h1>
        <p>Yay</p>
        <button id="home" type="button" onclick="window.location.href='/'">Home</button>
    </section>
</main>

<script src="../js/error.js"></script>

<?php include '../partials/footer.php'; ?>
<?php
// End output buffering and flush the output
ob_end_flush();
?>