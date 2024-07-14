<?php
// This script provides utility functions for database functionality


function searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order)
{
    // Base query using 1=1 to ensure the start is always true so that additional queries can be appended
    $query = "SELECT * FROM offer WHERE 1=1";
    $params = []; // params array is used to dynamically append the parameters

    if ($form_destination !== null) {
        $query .= " AND location LIKE ?"; // Like is used for basic pattern matching
        $params[] = "%" . $form_destination . "%"; // Wildcards for partial match of destination text, allowing match if the text is found in the destination word/s
    }

    if ($form_duration !== null) {
        $query .= " AND nights = ?";
        $params[] = $form_duration;
    }

    // Ensure the filter column and sort direction are valid to prevent SQL injection
    $allowed_filters = ['travel_time', 'travel_stops', 'price']; // Define your allowed columns
    $allowed_orders = ['ASC', 'DESC'];

    if ($form_filter !== null && in_array($form_filter, $allowed_filters)) {
        $sort_direction = strtoupper($filter_order); // Convert sort direction to uppercase
        if (in_array($sort_direction, $allowed_orders)) {
            $query .= " ORDER BY " . $form_filter . " " . $sort_direction;
        } else {
            throw new Exception('Invalid sort direction');
        }
    }

    return ['query' => $query, 'params' => $params];
}