<?php
// If the search bar has been used, query the database based on the user request

// Default form values
$form_destination = "any";
$form_duration = 10;
$form_filter = "price";
$filter_order = "desc";

if (isset($_GET["destination"])) {
    $form_destination = $_GET["destination"];
}

if (isset($_GET["duration"])) {
    $form_duration = $_GET["duration"];
}

if (isset($_GET["filter"])) {
    echo $_GET["filter"];
    $form_filter = $_GET["filter"];
}

if (isset($_GET["order"])) {
    $filter_order = $_GET["order"];
}

// SQL here.... first check if non set, default!

?>

<link rel="stylesheet" href="../css/search.css">

<section class="search-container">
    <h1>Search:</h1>

    <form action="../pages/offers.php" method="GET">
        <label for="destination">Destination:</label><br>
        <input type="text" id="destination" name="destination" value="<?php echo $form_destination; ?>"><br>
        <label for="duration">Duration:</label><br>
        <input type="number" id="duration" name="duration" value="<?php echo $form_duration; ?>" step="1" nim="3"
            max="25"><br>
        <label for="filters">Choose a filter:</label>
        <select id="filter" name="filter">
            <option value="price" <?php echo ($form_filter === 'price') ? 'selected' : '' ?>>Price</option>
            <option value="travel-time" <?php echo ($form_filter === 'travel-time') ? 'selected' : '' ?>>Travel Time
            </option>
            <option value="flight-stops" <?php echo ($form_filter === 'flight-stops') ? 'selected' : '' ?>>Flight Stops
            </option>
        </select>
        <input type="radio" id="desc" name="order" value="desc"
            <?php echo ($filter_order === 'desc') ? 'checked' : '' ?>>
        <label for="desc">High</label><br>
        <input type="radio" id="asc" name="order" value="asc" <?php echo ($filter_order === 'asc') ? 'checked' : '' ?>>
        <label for="css">Low</label><br>
        <input type="submit">
    </form>
</section>
<!-- Search by destination, number of days, THEN filter by ... Default to all, by id (internally)-->
<!-- Search results can be viewed
with a variety of filtering options, for example, price, travel time, flight stops and so on. -->
<!-- Extend to include facilities or activites? -->