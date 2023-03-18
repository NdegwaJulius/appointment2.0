<?php
// Save the appointment meta box
    function my_appointment_plugin_save_meta_box($post_id) {
    if (!isset($_POST['my_appointment_plugin_nonce'])) {
    return $post_id;
    }
    
    $nonce = $_POST['my_appointment_plugin_nonce'];
    if (!wp_verify_nonce($nonce, 'my_appointment_plugin_save_meta_box')) {
    return $post_id;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
    return $post_id;
    }
    
    $appointment_date = sanitize_text_field($_POST['appointment_date']);
    update_post_meta($post_id, '_appointment_date', $appointment_date);
    
    $appointment_time = sanitize_text_field($_POST['appointment_time']);
    update_post_meta($post_id, '_appointment_time', $appointment_time);
    
    $appointment_location = sanitize_text_field($_POST['appointment_location']);
    update_post_meta($post_id, '_appointment_location', $appointment_location);
    
    $appointment_user_email = sanitize_email($_POST['appointment_user_email']);
    update_post_meta($post_id, '_appointment_user_email', $appointment_user_email);
    }
    add_action('save_post', 'my_appointment_plugin_save_meta_box');
    
    