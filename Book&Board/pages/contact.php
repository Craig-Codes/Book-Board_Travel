<!-- include partials and branch location data -->
<?php include '../partials/header.php';
include '../partials/navbar.php';
include '../data/locationData.php' ?>

<link rel="stylesheet" href="../css/contact.css">
<title>B&B Travel - Contact</title>
</head>
<main>
    <section class="container">
        <h1>Contact Us</h1>
        <p>Welcome to Book & Board (B&B)! Since 1975, we have been committed to providing exceptional travel services.
            With
            four branches across the UK and our headquarters in London, we are here to assist you with all your travel
            needs.</p>

        <p>
            Our dedicated team is here to help you plan your perfect holiday. Whether you need custom travel plans,
            travel
            and hotel packages, or complete holiday packages, we are ready to assist you. Contact us via phone, email,
            or
            visit one of our branches to speak with our friendly staff.
        </p>

        <p>
            For personalized service, walk into any of our branches, where our experienced staff will be happy to assist
            you
            in person. We look forward to helping you create unforgettable travel experiences.
        </p>
    </section>
    <section aria-labelledby="contact-heading">
        <h2 id="contact-heading">Our Locations</h2>
        <div id="contact">
            <?php foreach ($locations as $location) { ?>
            <div class="contact-card" role="region" aria-labelledby="location-<?php echo $location->id; ?>">
                <div class="contact-details">
                    <h4 id="location-<?php echo $location->id; ?>" class="card-title"><?php echo ($location->title) ?>
                    </h4>
                    <div class="address">
                        <h5 class="card-street"><?php echo ($location->street) ?></h5>
                        <h5 class="card-city"><?php echo ($location->city) ?></h5>
                        <h5 class="card-county"><?php echo ($location->county) ?></h5>
                        <h5 class="card-postcode"><?php echo ($location->postcode) ?></h5>
                    </div>
                    <p class="card-phone">📞 <?php echo ($location->phone) ?></p>
                    <p class="card-email">📧 <?php echo ($location->email) ?></p>
                    <p class="card-opening-hours">Weekday hours: <?php echo ($location->weekHours) ?></p>
                    <p class="card-opening-weekend">Weekend hours: <?php echo ($location->weekendHours) ?></p>
                </div>
                <div class="contact-image">
                    <img src=<?php echo $location->image ?> alt="<?php echo $location->title ?>" />
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</main>


<?php include '../partials/footer.php'; ?>