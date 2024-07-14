<?php
// Default form values
$form_destination = "any";
$form_duration = 10;
$form_filter = "price";
$filter_order = "DESC";

// Check to see if we have any query parameters, and if we do, override the default values
// This ensures the search bar retains the user input values across searches and pages
if (!empty($_GET)) {
    if (isset($_GET["destination"])) {
        $form_destination = $_GET["destination"];
    }

    if (isset($_GET["duration"])) {
        $form_duration = $_GET["duration"];
    }

    if (isset($_GET["filter"])) {
        $form_filter = $_GET["filter"];
    }

    if (isset($_GET["order"])) {
        $filter_order = $_GET["order"];
    }
}

?>

<link rel="stylesheet" href="../css/search.css">

<section class="search-container">
    <form id="search-form" action="../pages/offers.php" method="GET">
        <div class="search-input">
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" value="<?php echo $form_destination; ?>"
                aria-required="true">
        </div>
        <div class="search-input">
            <label for="duration">Duration (nights):</label>
            <input type="number" id="duration" name="duration" value="<?php echo $form_duration; ?>" step="1" min="3"
                max="25" aria-required="true">
        </div>
        <div class="search-input">
            <label for="filters">Filter By:</label>
            <select id="filter" name="filter" aria-required="true">
                <option value="price" <?php echo ($form_filter === 'price') ? 'selected' : '' ?>>Price</option>
                <option value="travel-time" <?php echo ($form_filter === 'travel-time') ? 'selected' : '' ?>>Travel Time
                </option>
                <option value="flight-stops" <?php echo ($form_filter === 'flight-stops') ? 'selected' : '' ?>>Flight
                    Stops
                </option>
            </select>
        </div>
        <div class="search-input">
            <div>
                <label for="DESC">High</label>
                <input type="radio" id="DESC" name="order" value="DESC"
                    <?php echo ($filter_order === 'DESC') ? 'checked' : '' ?>>

            </div>
            <div>
                <label for="css">Low</label>
                <input type="radio" id="ASC" name="order" value="ASC"
                    <?php echo ($filter_order === 'ASC') ? 'checked' : '' ?>>
            </div>


        </div>

        <input type="submit" value="Search">
    </form>
</section>