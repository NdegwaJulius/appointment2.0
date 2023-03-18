<?php
// Add appointment booking form shortcode
function my_appointment_plugin_shortcode($atts) {
    ob_start();
    include(plugin_dir_path(FILE) . 'templates/booking-form.php');
    return ob_get_clean();
    }
    add_shortcode('appointment_booking_form', 'my_appointment_plugin_shortcode');
    
    