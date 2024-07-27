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
    <!-- GET Request used, with the server reading the URL query parameters -->
    <form id="search-form" action="../pages/offers.php" method="GET">
        <div class="search-input">
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" value="<?php echo $form_destination; ?>"
                aria-required="true">
        </div>
        <div class="search-input">
            <label for="filters">Duration (nights):</label>
            <select id="duration" name="duration" aria-required="true">
                <!-- Drop down box values given as a list -->
                <option value="any" <?php echo ($form_duration === 'any') ? 'selected' : '' ?>>any</option>
                <option value="4" <?php echo ($form_duration === '4') ? 'selected' : '' ?>>4
                </option>
                <option value="7" <?php echo ($form_duration === '7') ? 'selected' : '' ?>>7
                </option>
                <option value="10" <?php echo ($form_duration === '10') ? 'selected' : '' ?>>10
                </option>
                <option value="12" <?php echo ($form_duration === '12') ? 'selected' : '' ?>>12
                </option>
                <option value="14" <?php echo ($form_duration === '14') ? 'selected' : '' ?>>14
                </option>
                <option value="21" <?php echo ($form_duration === '21') ? 'selected' : '' ?>>21
                </option>
            </select>
        </div>
        <div class="search-input">
            <label for="filters">Filter By:</label>
            <select id="filter" name="filter" aria-required="true">
                <!-- PHP used to mark the selected form value -->
                <option value="price" <?php echo ($form_filter === 'price') ? 'selected' : '' ?>>Price</option>
                <option value="travel_time" <?php echo ($form_filter === 'travel_time') ? 'selected' : '' ?>>Travel Time
                </option>
                <option value="travel_stops" <?php echo ($form_filter === 'travel_stops') ? 'selected' : '' ?>>Flight
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