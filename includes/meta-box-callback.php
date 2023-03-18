<?php
include 'meta-box-callback.php';

// Appointment meta box callback
// function my_appointment_plugin_meta_box_callback($post) {
//     wp_nonce_field('my_appointment_plugin_save_meta_box', 'my_appointment_plugin_nonce');
    
//     $appointment_date = get_post_meta($post->ID, '_appointment_date', true);
//     $appointment_time = get_post_meta($post->ID, '_appointment_time', true);
//     $appointment_location = get_post_meta($post->ID, '_appointment_location', true);
//     $appointment_user_email = get_post_meta($post->ID, '_appointment_user_email', true);
    
//     echo '<label for="appointment_date">'.__('Date').'</label><br>';
//     echo '<input type="date" id="appointment_date" name="appointment_date" value="'.$appointment_date.'"><br>';
    
//     echo '<label for="appointment_time">'.__('Time').'</label><br>';
//     echo '<input type="time" id="appointment_time" name="appointment_time" value="'.$appointment_time.'"><br>';
    
//     echo '<label for="appointment_location">'.__('Location').'</label><br>';
//     echo '<input type="text" id="appointment_location" name="appointment_location" value="'.$appointment_location.'"><br>';
    
//     echo '<label for="appointment_user_email">'.__('User Email').'</label><br>';
//     echo '<input type="email" id="appointment_user_email" name="appointment_user_email" value="'.$appointment_user_email.'"><br>';
//     }
    
   