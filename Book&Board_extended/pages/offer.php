<?php
// Start output buffering - this ensures no html content is sent to the browser until the script checks for id error
ob_start();

// utils.php contains a function to convert travel time into a human-readable string
include '../utils/utils.php';
include '../../db/database.php';

// Capture the id parameter from the URL - anything other than an integer defaults to 0
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$offer = Database::getOffer($id); // Query the database for the specific offer

// If offer not found in the database, redirect to error page
if (empty($offer)) {
    header('Location: error.php');
    exit;
}

include '../partials/header.php';
include '../partials/navbar.php';
?>
<link rel="stylesheet" href="../css/offer.css">
<title>B&B Travel - <?php echo ($offer->location); ?></title>
</head>
<main role="main">
    <section id="offer" aria-labelledby="offer-heading" role="article">
        <h4 id="offer-heading" class="card-title"><?php echo ($offer->location); ?></h4>
        <h5 class="star-rating"><span><?php echo ($offer->star_rating); ?></span></h5>
        <h5 class="travel-dates">Dates: <?php echo ($offer->dates); ?></h5>
        <p class="travel-description"><?php echo ($offer->description); ?></p>
        <!-- The number format is a built in php method to make numerical values more readable, adding commas -->
        <p class="offer-price">£<?php echo number_format($offer->price); ?></p>
        <!-- convert travel time into human readable time -->
        <p class="travel-time">⏱️ Travel time: <?php echo convertMinutesToHoursAndMinutes($offer->travel_time); ?></p>
        <!-- convert travel stops into "direct" if 0, making it more human readable -->
        <p class="travel-stops">✈️ Flight stops:
            <?php echo $offer->travel_stops > 0 ? $offer->travel_stops : "Direct"; ?>
        </p>

        <div class="content-container">
            <div class="slideshow-container" role="region" aria-label="Image Carousel">
                <!-- create a carousel to display all images about the destination-->
                <!-- Loop through each image, on the offers image array -->
                <?php foreach ($offer->images as $index => $image) { ?>
                    <div class="mySlides fade">
                        <!-- The index is pulled out of the offer object so that alt text is different for each image -->
                        <img class="holiday-image" src="<?php echo htmlspecialchars($image); ?>"
                            alt="<?php echo htmlspecialchars($offer->location . ' image-' . ($index + 1)); ?>">
                        <!-- Trigger javascript to control clicking the carousel arrow buttons -->
                        <div class="arrow-container">
                            <a class="prev" onclick="plusSlides(-1)" role="button" aria-label="Previous Slide">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)" role="button" aria-label="Next Slide">&#10095;</a>
                        </div>
                    </div>
                <?php } ?>

                <div class="dot-container" role="tablist" aria-label="Image Navigation">
                    <?php foreach ($offer->images as $index => $image) { ?>
                        <span class="dot" tabindex="0" role="tab" aria-label="Slide <?php echo $index + 1; ?>"
                            onclick="currentSlide(<?php echo $index + 1; ?>)"
                            onkeydown="dotKeydown(event, <?php echo $index + 1; ?>)">
                            <!-- onkeydown allows carousel navigation dots to work for non-mouse users -->
                        </span>
                    <?php } ?>
                </div>

            </div>

        </div>
        <section class="additional-info">
            <div class="activities">
                <h5>Activities:</h5>
                <ul>
                    <!-- Each activity is listed by looping through the offers activities array -->
                    <?php foreach ($offer->activities as $activity) { ?>
                        <li><?php echo ($activity); ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="facilities">
                <h5>Facilities:</h5>
                <ul>
                    <!-- Each facility is listed by looping through the offers facilities array -->
                    <?php foreach ($offer->facilities as $facility) { ?>
                        <li><?php echo ($facility); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </section>

    </section>
</main>

<script src="../js/offer.js"></script>

<?php
include '../partials/footer.php';

// End output buffering and flush the output
ob_end_flush();
?>