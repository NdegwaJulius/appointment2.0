<?php
/*
Plugin Name: Appointment Booking Plugin
Plugin URI: https://example.com/appointment-booking-plugin/
Description: A plugin that allows users to book appointments on the front-end, and admin to view the list of appointments that have been placed, sends a customized email to the user containing details of the appointment placed and details of the location for the appointment, and integrates with Zapier.
Version: 1.0
Author: Julius Ndegwa
Author URI: https://example.com/
License: GPL2
*/

// Register the appointment post type
include( plugin_dir_path( __FILE__ ) . 'includes/register-post-type.php' );

// Add the appointment meta box
include( plugin_dir_path( __FILE__ ) . 'includes/add-meta-box.php' );

// Appointment meta box callback
include( plugin_dir_path( __FILE__ ) . 'includes/meta-box-callback.php' );

// Save the appointment meta box
include( plugin_dir_path( __FILE__ ) . 'includes/save-meta-box.php' );

// Add appointment booking form shortcode
include( plugin_dir_path( __FILE__ ) . 'includes/shortcode.php' );

// Appointment booking form submission
include( plugin_dir_path( __FILE__ ) . 'includes/submit-form.php' );
// functions
include(plugin_dir_path( __FILE__ ) . 'includes/functions.php' );
?>

