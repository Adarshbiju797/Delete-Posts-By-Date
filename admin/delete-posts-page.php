<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function dpbd_admin_menu() {
    add_menu_page(
        'Delete Posts by Date',  // Page title
        'Delete Posts by Date',  // Menu title
        'manage_options',        // Capability
        'dpbd-delete-posts',     // Menu slug
        'dpbd_admin_page',       // Callback function
        'dashicons-trash',       // Icon
        20                       // Position
    );
}

function dpbd_enqueue_admin_styles() {
    wp_enqueue_style('dpbd-admin-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('admin_enqueue_scripts', 'dpbd_enqueue_admin_styles');

function dpbd_admin_page() {
    if (isset($_POST['dpbd_delete_posts'])) {
        $start_date = $_POST['dpbd_start_date'];
        $end_date = $_POST['dpbd_end_date'];

        // Attempt to delete posts and get the result
        $deleted_count = dpbd_delete_posts_by_date($start_date, $end_date);

        // Display a message based on whether any posts were deleted
        if ($deleted_count > 0) {
            echo '<div class="updated"><p>Posts deleted successfully! ' . $deleted_count . ' posts removed.</p></div>';
        } else {
            echo '<div class="error"><p>No posts found within the specified date range.</p></div>';
        }
    }

    ?>
    <div class="wrap dpbd-admin-page">
        <h1>Delete Posts by Date</h1>
        <form method="post">
            <label for="dpbd_start_date">Start Date:</label>
            <input type="date" id="dpbd_start_date" name="dpbd_start_date" required>
            <br><br>
            <label for="dpbd_end_date">End Date:</label>
            <input type="date" id="dpbd_end_date" name="dpbd_end_date" required>
            <br><br>
            <input type="submit" name="dpbd_delete_posts" value="Delete Posts" class="button button-primary">
        </form>
    </div>
    <?php
}

// Ensure only admins can access the page
add_action('admin_init', 'dpbd_check_user_permissions');

function dpbd_check_user_permissions() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
}
