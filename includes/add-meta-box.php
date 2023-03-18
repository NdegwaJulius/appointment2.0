<?php
// Add the appointment meta box
function my_appointment_plugin_add_meta_box() {
  add_meta_box('my_appointment_plugin_meta_box', __('Appointment Details'), 'my_appointment_plugin_meta_box_callback', 'appointment');
}
add_action('add_meta_boxes', 'my_appointment_plugin_add_meta_box');

// Callback function for meta box content
function my_appointment_plugin_meta_box_callback( $post ) {
  // Display input field for appointment date
  echo '<label for="appointment_date">';
  echo __('Appointment Date:');
  echo '</label> ';
  echo '<input type="date" id="appointment_date" name="appointment_date" value="' . esc_attr( get_post_meta( $post->ID, 'appointment_date', true ) ) . '" />';

  // Display input field for appointment time
  echo '<br/><br/>';
  echo '<label for="appointment_time">';
  echo __('Appointment Time:');
  echo '</label> ';
  echo '<input type="time" id="appointment_time" name="appointment_time" value="' . esc_attr( get_post_meta( $post->ID, 'appointment_time', true ) ) . '" />';
}

// Save appointment meta data
function my_appointment_plugin_save_meta_data( $post_id ) {
  // Save appointment date if it exists in post data
  if ( isset( $_POST['appointment_date'] ) ) {
    update_post_meta( $post_id, 'appointment_date', sanitize_text_field( $_POST['appointment_date'] ) );
  }
  // Save appointment time if it exists in post data
  if ( isset( $_POST['appointment_time'] ) ) {
    update_post_meta( $post_id, 'appointment_time', sanitize_text_field( $_POST['appointment_time'] ) );
  }
}
add_action( 'save_post', 'my_appointment_plugin_save_meta_data' );
