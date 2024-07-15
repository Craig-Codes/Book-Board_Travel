<?php
// This script provides utility functions for database functionality


function searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order)
{
    // Base query using 1=1 to ensure the start is always true so that additional queries can be appended
    $query = "SELECT * FROM offer WHERE 1=1";
    $params = []; // params array is used to dynamically append the parameters

    // Use a default wildcard if form_destination is null or an empty string or 'any'
    if ($form_destination === null || $form_destination === '' || strtolower($form_destination) === 'any') {
        $query .= " AND location LIKE ?";
        $params[] = "%";
    } else {
        $query .= " AND location LIKE ?";
        $params[] = "%" . $form_destination . "%";
    }

    // Allow 'any' through  
    if ($form_duration !== "any") {
        $query .= " AND nights = ?";
        $params[] = $form_duration;
    }

    // Ensure the filter column and sort direction are valid to prevent SQL injection
    $allowed_filters = ['travel_time', 'travel_stops', 'price']; // Define your allowed columns
    $allowed_orders = ['ASC', 'DESC']; // List of allowed values

    if ($form_filter !== null) { // If input is not null 
        if (!in_array($form_filter, $allowed_filters)) { // If the input is not in the array (ASC or DESC), throw error
            throw new Exception('Invalid filter column');
        }

        $sort_direction = strtoupper($filter_order); // Convert sort direction to uppercase
        if (in_array($sort_direction, $allowed_orders)) { // If the input is in the list, it is valid
            $query .= " ORDER BY " . $form_filter . " " . $sort_direction;
        } else {
            throw new Exception('Invalid sort direction');
        }
    }

    return ['query' => $query, 'params' => $params];
    // return both the query string and the parameters - allows the database to use prepared statements for security
}