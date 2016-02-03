<?php
/*
 * ==============================
 *      THEME CUSTOM POST TYPES
 * ==============================
 * */
$contact = get_option('activate_contact');
if( @$contact == 1 ){
    add_action('init','sgrove_contact_custom_post_type');
    //add_filter(   'manage_  YourCustomPostType  _posts_columns' , 'callback function  )
    //ADD CUSTOM COLUMNS
    add_filter( 'manage_sgrove_contact_posts_columns', 'sgrove_set_sgrove_contact_columns');
    //EDIT CUSTOM COLUMN
    add_action('manage_sgrove_contact_posts_custom_column', 'sgrove_contact_custom_column', 10, 2);
    add_action('add_meta_boxes', 'sgrove_contact_add_meta_box');
    add_action('save_post', 'sgrove_save_contact_email_data');
}

/*
 *====================
 *  CONTACT CTP
 * ===================
 *
 * */
function sgrove_contact_custom_post_type() {
    $labels = array(
        'name'               => 'Messages',
        'singular_name'      => 'Message',
        'menu_name'          => 'Messages',
        'name_admin_bar'     => 'Message'
    );

    $args = array(
        'labels'             => $labels,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-email-alt',
        'supports'           => array( 'title', 'editor', 'author' )
    );

    register_post_type('sgrove_contact',$args);
}
function sgrove_set_sgrove_contact_columns( $columns ) {
    //unset( $columns['author']);
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';
    return $newColumns;

}
function sgrove_contact_custom_column( $column, $post_id ) {
    switch( $column ){
        case 'message' :
            //message column
            echo get_the_excerpt();
            break;
        case 'email' :
            $email = get_post_meta($post_id, '_contact_email_value_key', true );
            // email column
            echo $email;
            break;
    }
}
/*
 *=======================
 * CONTACT META BOXES
 * ======================
 *
 * */
function sgrove_contact_add_meta_box(){
    add_meta_box('contact_email','User Email', 'sgrove_contact_email_callback', 'sgrove_contact', 'side', 'high');
}
function sgrove_contact_email_callback( $post ){
    wp_nonce_field('sgrove_save_contact_email_data', 'sgrove_contact_email_meta_box_nonce' );
    $value = get_post_meta($post->ID, '_contact_email_value_key', true );

    echo '<label for="sgrove_contact_email_field">User Email Address</label>';
    echo '<input type="email" name="sgrove_contact_email_field" id="sgrove_contact_email_field" value="'.esc_attr($value).'" size="25" />';
}
function sgrove_save_contact_email_data( $post_id){

    if( ! isset( $_POST['sgrove_contact_email_meta_box_nonce'])){
        return;
    }

    if( ! wp_verify_nonce( $_POST['sgrove_contact_email_meta_box_nonce'], 'sgrove_save_contact_email_data')){
        return;
    }

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ){
        return;
    }
    if( ! isset( $_POST['sgrove_contact_email_field'])){
        return;
    }

    $my_data = sanitize_text_field( $_POST['sgrove_contact_email_field'] );

    update_post_meta($post_id, '_contact_email_value_key',$my_data);
}