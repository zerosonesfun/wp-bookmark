<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function bmwpskywolf_modify_post_title($title) {
    if (isset($_GET['title'])) {
        $title = sanitize_text_field($_GET['title']);
        $title = stripslashes($title); // Remove slashes
    }
    return esc_html($title);
}
add_filter('default_title', 'bmwpskywolf_modify_post_title');

function bmwpskywolf_modify_post_content($content) {
    if (isset($_GET['content']) && isset($_GET['wpbm_url']) && isset($_GET['wpbm_og_image'])) {
        $description = wp_kses_post(sanitize_text_field($_GET['content']));
        $description = stripslashes($description); // Remove slashes

        $url = esc_url(sanitize_url($_GET['wpbm_url']));
        $og_image = esc_url(sanitize_url($_GET['wpbm_og_image']));

        // Create the post content
        $content = '<img src="' . $og_image . '" />';
        $content .= '<p>' . $description . '</p>';
        $content .= '<p><a href="' . $url . '">Read more</a></p>';
    }
    return $content;
}
add_filter('default_content', 'bmwpskywolf_modify_post_content');