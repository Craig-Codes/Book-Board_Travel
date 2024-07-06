<?php include '../scripts/offerData.php'; ?>
<?php include '../partials/header.php'; ?>
<?php include '../partials/navbar.php'; ?>
<link rel="stylesheet" href="../css/home.css">
<main>
    <section id="introduction-text">
        <h1>Welcome to Book & Board Travel Agency</h1>
        <h2>Your journey starts here <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="32" height="32">
                <path
                    d="M32 5a21 21 0 0 0-21 21c0 17 21 33 21 33s21-16 21-33A21 21 0 0 0 32 5zm0 31a10 10 0 1 1 10-10 10 10 0 0 1-10 10z"
                    fill="#358CC0" stroke="black" stroke-width="2" />
            </svg>
        </h2>
        <h3>Explore our latest offers, discover breathtaking destinations, and let us craft the perfect holiday tailored
            just for you.</h3>
    </section>
    <article>
        <div id="best-selling-offers">
            <?php foreach ($bestOffers as $offer) { ?>
            <div class="offer-card">
                <h4 class="card-title"><?php echo ($offer->location) ?></h4>
                <h5 class="star-rating"><?php echo ($offer->starRating) ?></h5>
                <h6 class="travel-dates"><?php echo ($offer->dates) ?></h6>
                <p class="travel-description"><?php echo ($offer->description) ?></p>
                <p class="offer-price"><?php echo ($offer->price) ?></p>
            </div>
            <?php } ?>
        </div>
    </article>
</main>
<script src="../js/home.js"></script>
<?php include '../partials/footer.php'; ?>