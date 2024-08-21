<?php
/*
Plugin Name: Delete Posts by Date
Description: A plugin to delete posts between specific dates.
Version: 1.0
Author: Adarsh 
License: GPLv2 
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/delete-posts-functions.php';
require_once plugin_dir_path(__FILE__) . 'admin/delete-posts-page.php';

// Add admin menu
add_action('admin_menu', 'dpbd_admin_menu');
