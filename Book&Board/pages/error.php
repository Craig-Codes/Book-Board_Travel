<!-- Include partials -->
<?php
include '../partials/header.php';
include '../partials/navbar.php';
?>

<link rel="stylesheet" href="../css/error.css">
<title>B&B Travel - Error</title>
</head>
<main role="main">
    <section id="error" aria-labelledby="error-heading" role="alert">
        <h1 id="error-heading">404 Error</h1>
        <p>Sorry, the resource could not be found</p>
        <button id="home" type="button" onclick="window.location.href='/'">Home</button>
    </section>
</main>

<script src="../js/error.js"></script>
<?php include '../partials/footer.php'; ?>