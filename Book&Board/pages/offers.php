<?php
include '../partials/header.php';
include '../partials/navbar.php';
?>

<link rel="stylesheet" href="../css/offers.css">
<!-- offerData.php contains an array of all the offer objects -->
<?php include '../data/offerData.php'; ?>

<main>
    <section class="container">
        <h1>Our Offers</h1>
        <p>Dive into a world of incredible
            offers, each designed to bring you the best value and unparalleled adventures. Explore a diverse range
            of breathtaking destinations, from serene beaches and vibrant cities to exotic landscapes and cultural
            landmarks. Whether you're dreaming of a romantic getaway, an adventurous trek, or a family vacation, our
            expert team is here to craft the perfect holiday tailored just for you.</p>
    </section>
    <section>

        <div id="best-selling-offers">

            <!-- loop through the imported allOffers array of offer objects, to create an offer card for each -->
            <?php foreach ($allOffers as $offer) { ?>
            <div class="offer-card">
                <div class="offer-details">
                    <h4 class="card-title"><?php echo ($offer->location) ?></h4>
                    <h5 class="star-rating"><?php echo ($offer->starRating) ?></h5>
                    <h5 class="travel-dates"><?php echo ($offer->dates) ?></h5>
                    <p class="travel-description"><?php echo ($offer->description) ?></p>
                    <!-- The number format is a built in php method to make numeriacal values more readible, adding commas -->
                    <p class="offer-price">£<?php echo number_format($offer->price) ?></p>
                </div>
                <div class="offer-image">
                    <!-- We only want to show the first image on this page, so index 0 is used -->
                    <img src=<?php echo $offer->images[0] ?> alt="<?php echo $offer->location ?>" />
                    <!-- A form is used to access the offer page, sending the selected id to the server
                              so that the correct offer can be selected and more details can be displayed -->
                    <form action="offer.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $offer->id; ?>">
                        <button type="submit">More Information</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php include '../partials/footer.php'; ?>