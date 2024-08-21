<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function dpbd_delete_posts_by_date($start_date, $end_date) {
    global $wpdb;

    // Sanitize the inputs
    $start_date = sanitize_text_field($start_date);
    $end_date = sanitize_text_field($end_date);

    // Modify the query to ensure full day coverage
    $start_datetime = $start_date . ' 00:00:00';
    $end_datetime = $end_date . ' 23:59:59';

    // Prepare and execute the delete query
    $query = $wpdb->prepare(
        "DELETE FROM $wpdb->posts WHERE post_date >= %s AND post_date <= %s",
        $start_datetime,
        $end_datetime
    );

    $result = $wpdb->query($query);

    // Return the number of rows affected
    return $result;
}

