<!-- Include partials -->
<?php
include '../partials/header.php';
include '../partials/navbar.php';

// If NOT logged in (session) - Redirect home
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