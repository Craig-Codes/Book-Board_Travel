<?php
// Start output buffering - this ensures no hmtl content is sent to the browser until the script checks for id error
ob_start();
include '../partials/header.php';
include '../partials/navbar.php';
include '../../db/database.php';

$latestOffers = Database::getLatestOffers(); // Query the database for the last 3 added offers

// If offers do not load, re-direct to error page
if (empty($latestOffers)) {
    header('Location: error.php');
    exit;
}

?>

<link rel="stylesheet" href="../css/home.css">
<title>B&B Travel - Home</title>
</head>
<main role="main">
    <section id="introduction-text" aria-labelledby="introduction-heading">
        <h1 id="introduction-heading">Welcome to Book & Board Travel Agency</h1>
        <h2>Your journey starts here
            <!-- SVG is the map place marker icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="32" height="32">
                <path
                    d="M32 5a21 21 0 0 0-21 21c0 17 21 33 21 33s21-16 21-33A21 21 0 0 0 32 5zm0 31a10 10 0 1 1 10-10 10 10 0 0 1-10 10z"
                    fill="#358CC0" stroke="black" stroke-width="2" />
            </svg>
        </h2>
        <h3>Explore our latest offers, discover breathtaking destinations, and let us craft the perfect holiday tailored
            just for you.</h3>
    </section>
    <article aria-labelledby="best-selling-offers-heading">
        <div id="best-selling-offers">
            <!-- loop through the latestOffers array, pulling out each found offer to create an information card -->
            <?php foreach ($latestOffers as $offer) { ?>
            <article class="offer-card" aria-labelledby="offer-<?php echo ($offer['id']) ?>-title"
                data-id="<?php echo ($offer['id']) ?>">
                <h4 id="offer-<?php echo ($offer['id']) ?>-title" class="card-title"><?php echo ($offer['location']) ?>
                </h4>
                <h5 class="star-rating"><?php echo ($offer['star_rating']) ?></h5>
                <h6 class="travel-dates"><?php echo ($offer['dates']) ?></h6>
                <h6 class="travel-dates"><?php echo ($offer['nights']) . ' nights' ?></h6>
                <p class="travel-description"><?php echo ($offer['description']) ?></p>
                <!-- The number format is a built in php method to make numeriacal values more readible, adding commas -->
                <p class="offer-price">£<?php echo number_format($offer['price']) ?></p>
            </article>
            <?php } ?>
        </div>
    </article>
    <?php include '../partials/search.php'; ?>
</main>

<script src="../js/home.js"></script>
<?php include '../partials/footer.php';
ob_end_flush(); ?>