<?php
add_filter('product_type_selector', 'appointment_product_type');
 
function appointment_product_type($types){
   $types['appointment'] = __('Appointment');
   return $types;
}
 
add_action( 'woocommerce_product_options_general_product_data', 'appointment_product_type_options' );
 
function appointment_product_type_options() {
   global $woocommerce, $post;
   echo '<div class="options_group">';
      woocommerce_wp_checkbox( array(
         'id'        => '_is_appointment',
         'wrapper_class' => 'show_if_appointment',
         'label'     => __( 'Is Appointment', 'woocommerce' ),
         'description' => __( 'Enable if this product is an appointment.', 'woocommerce' )
      ) );
      woocommerce_wp_text_input( array(
         'id'                => '_appointment_duration',
         'wrapper_class' => 'show_if_appointment',
         'label'             => __( 'Appointment Duration (in minutes)', 'woocommerce' ),
         'placeholder'       => '',
         'description'       => __( 'Enter the duration of the appointment in minutes.', 'woocommerce' )
      ) );
   echo '</div>';
}
