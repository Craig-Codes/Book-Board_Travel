<?php
include '../scripts/offerData.php';

// Capture the id parameter from the URL - anything other than an integer defaults to 0
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Extract valid IDs from the $allOffers array
$valid_ids = array_map(function ($offer) {
    return $offer->id;
}, $allOffers);

// Validate the id against id's in the dataset
if (!in_array($id, $valid_ids)) {
    // Redirect to an error page or display an error message
    header('Location: error.php');
    exit;
}

// Get the correct offer item
$offer = null;
foreach ($allOffers as $item) {
    if ($item->id == $id) {
        $offer = $item;
        break;
    }
}

if ($offer) {
    // Display offer details
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="../css/offer.css">
        <title><?php echo $offer->location; ?> - Offer Details</title>
    </head>

    <body>
        <?php
        include '../partials/header.php';
        include '../partials/navbar.php';
        ?>
        <main>
            <h1><?php echo $offer->location; ?></h1>
            <h2>Star Rating: <?php echo $offer->starRating; ?></h2>
            <p>Dates: <?php echo $offer->dates; ?></p>
            <p>Description: <?php echo $offer->description; ?></p>

            <div class="slideshow-container">
                <?php foreach ($offer->images as $index => $image) { ?>
                    <div class="mySlides fade">
                        <img class="holiday-image" src="<?php echo $image; ?>"
                            alt="<?php echo $offer->location . ' image-' . ($index + 1); ?>">
                    </div>
                <?php } ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            <div style="text-align:center">
                <?php foreach ($offer->images as $index => $image) { ?>
                    <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span>
                <?php } ?>
            </div>

            <p>Price: <?php echo $offer->price; ?></p>

            <h3>Activities:</h3>
            <ul>
                <?php foreach ($offer->activities as $activity) { ?>
                    <li><?php echo $activity; ?></li>
                <?php } ?>
            </ul>

            <h3>Facilities:</h3>
            <ul>
                <?php foreach ($offer->facilities as $facility) { ?>
                    <li><?php echo $facility; ?></li>
                <?php } ?>
            </ul>
        </main>
        <script src="../js/offer.js"></script>
    </body>

    </html>
    <?php
} else {
    // Offer with given ID not found
    header('Location: error.php');
    exit;
}
?>