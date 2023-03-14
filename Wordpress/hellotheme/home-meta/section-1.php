<?php
// Metaboxes
function section_1_metabox() {
    add_meta_box(
        'section_1_metabox', // $id is a unique id given to every meta box
        'section_1 Details', // $title is the title displayed in custom meta box
        'section_1_metabox_callback', // $callback is a function that outputs markup inside the custom meta box
        'page', // $page represents the admin page on which the meta box will be displayed on. It can be page, post, custom post type.
        'advanced', // $context represents the position of the meta box. It can be normal, advanced or side.
        'default' // $priority is the position of the box inside the context. It can be high, core, default or low.
    );
}
add_action( 'add_meta_boxes', 'section_1_metabox' );
function section_1_metabox_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'section_1_nonce' );
    $section_1_header = get_post_meta($post->ID, "section_1_header", true);
    $section_1_description = get_post_meta($post->ID, "section_1_description", true);
    $image1 = get_post_meta($post->ID, "section_1_image1", true);
    $image2 = get_post_meta($post->ID, "section_1_image2", true); 
    $image3 = get_post_meta($post->ID, "section_1_image3", true); 
    $section_1_button_title = get_post_meta($post->ID, "section_1_button_title", true);

    ?>
    <table class="table">
    <tr>
        <td><?php _e( 'Section_1 header', 'team' )?></td>
        <td><input type="text" name="section_1_header" id="section_1_header" value="<?php if ( isset ( $section_1_header ) ) echo $section_1_header; ?>" /></td>
    </tr>
    <tr>
        <td><?php _e( 'Section_1 description', 'team' )?></td>
        <td><input type="text" name="section_1_description" id="section_1_description" value="<?php if ( isset ( $section_1_description ) ) echo $section_1_description; ?>" /></td>
    </tr>
    <tr>
        <td>Image1</td>
        <td>
            <input type="url" name="section_1_image1" id="section_1_image1" value="<?php echo esc_attr( $image1 ); ?>"><br>
        </td>
        <td><button type="button" class="button" id="image1-btn" data-media-uploader-target="#section_1_image1"><?php _e( 'Upload Image', 'intern-demo' )?></button></td>
     </tr>
     <tr>
        <td>Image2</td>
        <td>
            <input type="url" name="section_1_image2" id="section_1_image2" value="<?php echo esc_attr( $image2 ); ?>"><br>
        </td>
        <td><button type="button" class="button" id="image2-btn" data-media-uploader-target="#section_1_image2"><?php _e( 'Upload Image', 'intern-demo' )?></button></td>
     </tr>
     <tr>
        <td>Image3</td>
        <td>
            <input type="url" name="section_1_image3" id="section_1_image3" value="<?php echo esc_attr( $image3 ); ?>"><br>
        </td>
        <td><button type="button" class="button" id="image3-btn" data-media-uploader-target="#section_1_image3"><?php _e( 'Upload Image', 'intern-demo' )?></button></td>
     </tr>
     <tr>
        <td><?php _e( 'Button title', 'team' )?></td>
        <td><input type="text" name="section_1_button_title" id="section_1_button_title" value="<?php if ( isset ( $section_1_button_title ) ) echo $section_1_button_title; ?>" /></td>
    </tr>
     </table>
    <?php
}

add_action("save_post", "section_1_save_metabox_data", 10, 2);

function section_1_save_metabox_data($post_id, $post) {
    // we have verfied the nonce
    if (!isset($_POST['section_1_nonce']) || !wp_verify_nonce($_POST['section_1_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // verifying slug value
    $post_slug = "page";
    if ($post_slug != $post->post_type) {
        return;
    }
    //save value to db field
    $section_1_header = '';
    $section_1_description = '';
    $image1 = '';
    $image2 = '';
    $image3 = '';
    $section_1_button_title = '';

    if (isset($_POST['section_1_header'])) {
        $section_1_header = sanitize_text_field($_POST['section_1_header']);
    }

    if (isset($_POST['section_1_description'])) {
        $section_1_description = sanitize_text_field($_POST['section_1_description']);
    }
    if (isset($_POST['section_1_image1'])) {
        $image1 = sanitize_url($_POST['section_1_image1']);
    }
    if (isset($_POST['section_1_image2'])) {
        $image2 = sanitize_url($_POST['section_1_image2']);
    }
    if (isset($_POST['section_1_image3'])) {
        $image3 = sanitize_url($_POST['section_1_image3']);
    }
    if (isset($_POST['section_1_button_title'])) {
        $section_1_button_title = sanitize_text_field($_POST['section_1_button_title']);
    }
    update_post_meta($post_id, "section_1_header", $section_1_header);
    update_post_meta($post_id, "section_1_description", $section_1_description);
    update_post_meta($post_id, "section_1_image1", $image1);
    update_post_meta($post_id, "section_1_image2", $image2);
    update_post_meta($post_id, "section_1_image3", $image3);
    update_post_meta($post_id, "section_1_button_title", $section_1_button_title);

}