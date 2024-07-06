<?php include '../partials/header.php'; ?>
<?php include '../partials/navbar.php'; ?>
<link rel="stylesheet" href="../css/offers.css">
<?php include '../scripts/offerData.php'; ?>

<main>
    <h1>Our Offers</h1>
    <p>This is the offers page content.</p>
    <section>
        <div id="best-selling-offers">

            <?php foreach ($allOffers as $offer) { ?>
                <div class="offer-card">
                    <div class="offer-details">
                        <h4 class="card-title"><?php echo ($offer->location) ?></h4>
                        <h5 class="star-rating"><?php echo ($offer->starRating) ?></h5>
                        <h6 class="travel-dates"><?php echo ($offer->dates) ?></h6>
                        <p class="travel-description"><?php echo ($offer->description) ?></p>
                        <p class="offer-price"><?php echo ($offer->price) ?></p>
                    </div>
                    <div class="offer-image">
                        <img src=<?php echo $offer->images[0] ?> alt="<?php echo $offer->location ?>" />
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