<?php
// Register the appointment post type
function my_appointment_plugin_register_post_type() {
  $labels = array(
    'name' => __('Appointments'),
    'singular_name' => __('Appointment'),
    'add_new' => __('Add New'),
    'add_new_item' => __('Add New Appointment'),
    'edit_item' => __('Edit Appointment'),
    'new_item' => __('New Appointment'),
    'view_item' => __('View Appointment'),
    'search_items' => __('Search Appointments'),
    'not_found' => __('No appointments found'),
    'not_found_in_trash' => __('No appointments found in Trash'),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'menu_icon' => 'dashicons-calendar-alt',
    'supports' => array('title'),
  );

  register_post_type('appointment', $args);
}
add_action('init', 'my_appointment_plugin_register_post_type');
?>
