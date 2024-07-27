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

<link rel="stylesheet" href="../css/account.css">
<title>B&B Travel - Account</title>
</head>

<main role="main">
    <section id="account" aria-labelledby="account-heading" role="alert">
        <h1 id="account-heading">Welcome <?php echo ($_SESSION['username']) ?></h1>
        <!-- Users booking information would display here once that user story is complete -->
        <p>Booking information:</p>
        <button id="home" type="button"
            onclick="window.location.href='/Book&Board_extended/pages/home.php'">Home</button>
    </section>
</main>

<?php include '../partials/footer.php'; ?>
<?php
// End output buffering and flush the output
ob_end_flush();
?>