<?php
// Appointment booking form submission
function my_appointment_plugin_submit_form() {
  if (isset($_POST['submit_appointment_booking'])) {
    $appointment_date = sanitize_text_field($_POST['appointment_date']);
    $appointment_time = sanitize_text_field($_POST['appointment_time']);
    $appointment_location = sanitize_text_field($_POST['appointment_location']);
    $appointment_notes = sanitize_textarea_field($_POST['appointment_notes']);

    $post_data = array(
      'post_title' => __('Appointment') . ' - ' . $appointment_date . ' ' . $appointment_time,
      'post_content' => '',
      'post_status' => 'publish',
      'post_type' => 'appointment'
    );

    // Insert the post into the database
    $post_id = wp_insert_post($post_data);

    // Save the appointment data as post meta
    update_post_meta($post_id, 'appointment_date', $appointment_date);
    update_post_meta($post_id, 'appointment_time', $appointment_time);
    update_post_meta($post_id, 'appointment_location', $appointment_location);
    update_post_meta($post_id, 'appointment_notes', $appointment_notes);

    // Display a success message
    echo '<div class="notice notice-success"><p>' . __('Appointment created successfully.') . '</p></div>';
  }
}

// Register the meta box
function my_appointment_plugin_meta_box() {
    add_meta_box( 
        'my_appointment_plugin_meta_box',
        __('Appointment Details'),
        'my_appointment_plugin_meta_box_callback',
        'appointment'
    );
};
add_action('add_meta_boxes', 'my_appointment_plugin_meta_box');

// Define the meta box content
function my_appointment_plugin_meta_box_callback( $post ) {
    
    // Retrieve previous values from db, if available
    $appointment_date = get_post_meta( $post->ID, 'appointment_date', true );
    $appointment_time = get_post_meta( $post->ID, 'appointment_time', true );
    $appointment_location = get_post_meta( $post->ID, 'appointment_location', true );
    $appointment_notes = get_post_meta( $post->ID, 'appointment_notes', true );
    
    // Output fields
    echo '<label for="appointment_date">' . esc_html__( 'Date', 'my-textdomain' ) . '</label><br />';
    echo '<input type="date" id="appointment_date" name="appointment_date" value="' . esc_attr( $appointment_date ) . '" required /><br />';
    echo '<label for="appointment_time">' . esc_html__( 'Time', 'my-textdomain' ) . '</label><br />';
    echo '<input type="time" id="appointment_time" name="appointment_time" value="' . esc_attr( $appointment_time ) . '" required /><br />';
    echo '<label for="appointment_location">' . esc_html__( 'Location', 'my-textdomain' ) . '</label><br />';
    echo '<input type="text" id="appointment_location" name="appointment_location" value="' . esc_attr( $appointment_location ) . '" required /><br />';
    echo '<label for="appointment_notes">' . esc_html__( 'Notes (Optional)', 'my-textdomain' ) . '</label><br />';
    echo '<textarea id="appointment_notes" name="appointment_notes">' . esc_html( $appointment_notes ) . '</textarea><br />';
    
    // Add nonce for security
    wp_nonce_field( basename( __FILE__ ), 'my_appointment_plugin_meta_box_nonce' );
}

// Save the appointment data
function my_appointment_plugin_save_data( $post_id ) {
  
  // Check if nonce is set
  if (!isset($_POST['my_appointment_plugin_meta_box_nonce'])) {
    return;
  }

  // Verify the nonce for security
  if (!wp_verify_nonce($_POST['my_appointment_plugin_meta_box_nonce'], basename(__FILE__))) {
    return;
  }

  // Check if the current user has permission to edit the post.
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Save the appointment data as post meta
  update_post_meta($post_id, 'appointment_date', $_POST['appointment_date']);
  update_post_meta($post_id, 'appointment_time', $_POST['appointment_time']);
  update_post_meta($post_id, 'appointment_location', $_POST['appointment_location']);
  update_post_meta($post_id, 'appointment_notes', $_POST['appointment_notes']);
};
add_action('save_post', 'my_appointment_plugin_save_data');
