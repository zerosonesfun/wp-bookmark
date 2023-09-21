<?php
function wpbm_set_featured_image($post_id, $og_image_url) {
    // Need to require these files
    if (!function_exists('media_handle_upload')) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }

    // Upload file to WordPress library
    $tmp = download_url($og_image_url);
    $file_array = array(
        'name' => basename($og_image_url),
        'tmp_name' => $tmp
    );

    // Check for download errors
    if (is_wp_error($tmp)) {
        @unlink($file_array['tmp_name']);
        return $tmp;
    }

    // Handle the media upload
    $id = media_handle_sideload($file_array, $post_id);

    // Check for handle sideload errors.
    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return $id;
    }

    // Set the featured image for the post
    set_post_thumbnail($post_id, $id);
}

function wpbm_handle_bookmarklet() {
    if (!is_user_logged_in()) {
        wp_redirect(wp_login_url(get_permalink()));
        exit;
    }

    $post_id = wp_insert_post();

    // Set the featured image for the new post
    wpbm_set_featured_image($post_id, $og_image);

    // Redirect to the new post page
    wp_redirect(admin_url('post.php?post=' . $post_id . '&action=edit'));
    exit;
}

add_action('wp_ajax_wpbm_handle_bookmarklet', 'wpbm_handle_bookmarklet');
add_action('wp_ajax_nopriv_wpbm_handle_bookmarklet', 'wpbm_handle_bookmarklet');