<?php 
// Appointment booking form submission
function my_appointment_plugin_submit_form() {
  if (isset($_POST['submit_appointment_booking'])) {
    $appointment_date = sanitize_text_field($_POST['appointment_date']);
    $appointment_time = sanitize_text_field($_POST['appointment_time']);
    $appointment_location = sanitize_text_field($_POST['appointment_location']);
    $appointment_user_email = sanitize_email($_POST['appointment_user_email']);
    
    // Insert appointment post
    $appointment_post = array(
      'post_title' => __('Appointment').' - '.$appointment_date.' '.$appointment_time,
      'post_type' => 'appointment',
      'post_status' => 'publish',
    );
    $post_id = wp_insert_post($appointment_post);
    
    // Save appointment meta
    update_post_meta($post_id, '_appointment_date', $appointment_date);
    update_post_meta($post_id, '_appointment_time', $appointment_time);
    update_post_meta($post_id, '_appointment_location', $appointment_location);
    update_post_meta($post_id, '_appointment_user_email', $appointment_user_email);
    
    // Send email to user
    $to = $appointment_user_email;
    $subject = __('Appointment Confirmation');
    $message = sprintf(__('Your appointment on %s at %s has been confirmed. The location is %s.'), $appointment_date, $appointment_time, $appointment_location);
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $message, $headers);
    
    // Send appointment data to Zapier
    $data = array(
      'appointment_date' => $appointment_date,
      'appointment_time' => $appointment_time,
      'appointment_location' => $appointment_location,
      'appointment_user_email' => $appointment_user_email,
    );
    $options = array(
      'method' => 'POST',
      'body' => json_encode($data),
      'headers' => array('Content-Type' => 'application/json'),
    );
    $response = wp_remote_post('https://hooks.zapier.com/hooks/catch/1234567/abc123/', $options);
  }
}
add_action('init', 'my_appointment_plugin_submit_form');
