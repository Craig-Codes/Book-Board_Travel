<?php
// offerData.php contains an array of all the offer objects
include '../scripts/offerData.php';


// Capture the id parameter from the URL - anything other than an integer defaults to 0
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Extract valid IDs from the $allOffers array
// This allows us to compare if the provided URL parameter (id) matches an offer objects id 
$validIds = array_map(function ($offer) {
    return $offer->id;
}, $allOffers);

// Validate the URL parameter id is in the validIds array
if (!in_array($id, $validIds)) {
    // Redirect to an error page if the id does not match an array entry
    header('Location: error.php');
    exit;
}

// Get the correct offer item - loop through the allOffers array matching on id
$offer = null;
foreach ($allOffers as $item) {
    if ($item->id == $id) {
        $offer = $item;
        break;
    }
}

// If we successfully find an offer matching the URL parameter id, display the offer content
if ($offer) {
    ?>
<?php
    include '../partials/header.php';
    include '../partials/navbar.php';
    ?>
<link rel="stylesheet" href="../css/offer.css">

<body>

    <main>
        <h1><?php echo $offer->location; ?></h1>
        <h2>Star Rating: <?php echo $offer->starRating; ?></h2>
        <p>Dates: <?php echo $offer->dates; ?></p>
        <p>Description: <?php echo $offer->description; ?></p>

        <div class="slideshow-container">
            <!-- create a carousel to display all images about the destination-->
            <!-- Loop though each image, on the offers image array -->
            <?php foreach ($offer->images as $index => $image) { ?>
            <div class="mySlides fade">
                <!-- The index is pulled out of the offer object so that alt text is different for each image -->
                <img class="holiday-image" src="<?php echo $image; ?>"
                    alt="<?php echo $offer->location . ' image-' . ($index + 1); ?>">
            </div>
            <?php } ?>
            <!-- Trigger javascript to control clicking the carousel arrow buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="text-align:center">
            <?php foreach ($offer->images as $index => $image) { ?>
            <!-- A clickable circle marker is create for each image -->
            <!-- This allows users to click the marker to jump to that image -->
            <!-- Index is used to pass the image position number to a javascript function -->
            <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span>
            <?php } ?>
        </div>

        <p>Price: <?php echo $offer->price; ?></p>

        <h3>Activities:</h3>
        <ul>
            <!-- Each activity is listed by looping through the offers activities array -->
            <?php foreach ($offer->activities as $activity) { ?>
            <li><?php echo $activity; ?></li>
            <?php } ?>
        </ul>

        <h3>Facilities:</h3>
        <ul>
            <!-- Each facility is listed by looping through the offers facilities array -->
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
    // If the URL parameter (id) does not match an offer object id, redirect to the error page
    header('Location: error.php');
    exit;
}
?>