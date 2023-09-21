<?php
function wpbm_modify_post_title($title) {
    if (isset($_GET['title'])) {
        $title = sanitize_text_field($_GET['title']);
    }

    return $title;
}
add_filter('default_title', 'wpbm_modify_post_title');

function wpbm_modify_post_content($content) {
    if (isset($_GET['content']) && isset($_GET['wpbm_url']) && isset($_GET['wpbm_og_image'])) {
        $description = sanitize_text_field($_GET['content']);
        $url = filter_var($_GET['wpbm_url'], FILTER_SANITIZE_URL);
        $og_image = filter_var($_GET['wpbm_og_image'], FILTER_SANITIZE_URL);

        // Create the post content
        $content = '<img src="' . $og_image . '" />';
        $content .= '<p>' . $description . '</p>';
        $content .= '<p><a href="' . $url . '">Read more</a></p>';
    }
    return $content;
}
add_filter('default_content', 'wpbm_modify_post_content');