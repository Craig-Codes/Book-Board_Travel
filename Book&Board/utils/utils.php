<!-- This script provides utility functions which can be used across pages -->
<?php

// function takes the travel time in minutes and makes it human readable
function convertMinutesToHoursAndMinutes($minutes)
{
    // calculate the number of hours by dividing the minutes by 60, and put them in the variable
    $hours = floor($minutes / 60);
    // calculate the remaining minutes (modulo) by taking the remainder of the minutes divided by 60
    $remainingMinutes = $minutes % 60;

    $result = "";   // empty string to hold the result as a string value

    // add hours to the result string (if there are any)
    if ($hours > 0) {
        $result .= $hours . " hour" . ($hours > 1 ? "s" : "");  // add 's' to hours if more than one hour
    }

    // add minutes to the result string (if there are any)
    if ($remainingMinutes > 0) {
        // add a space if there were hours already added to the result string
        if ($hours > 0) {
            $result .= " ";
        }
        $result .= $remainingMinutes . " minute" . ($remainingMinutes > 1 ? "s" : "");  // add 's' if more than one minute
    }

    return $result; // return the result as a string
}