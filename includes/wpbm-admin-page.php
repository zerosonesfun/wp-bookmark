<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Function to create the admin page
function bmwpskywolf_bookmarklet_page() {
    $plugin_url = esc_url_raw(plugins_url('', __FILE__));
    $site_url = esc_url(home_url());

    $description = isset($_GET['content']) ? wp_kses_post(sanitize_text_field($_GET['content'])) : '';

    $og_image = '';
    if (isset($_GET['wpbm_og_image'])) {
        $og_image = esc_url(sanitize_url($_GET['wpbm_og_image']));
    }

    $bookmarklet_code = "javascript:(function(){var t=encodeURIComponent(document.title),d=document.querySelector('meta[name=\"description\"]'),u=encodeURIComponent(window.location.href),i=document.querySelector('meta[property=\"og:image\"]');d=d?encodeURIComponent(d.getAttribute('content')):'No description available';i=i?encodeURIComponent(i.getAttribute('content')):'No image available';var r='" . esc_url($site_url) . "/wp-admin/post-new.php?post_type=post'+'&title='+t+'&content='+d+'&wpbm_url='+u+'&wpbm_og_image='+i;window.location.href=r;})();";

    ?>
    <div class="wrap">
        <h1><?php echo esc_html__('Bookmarklet', 'bmwpskywolf'); ?></h1>
        <p><?php echo esc_html__('Copy the code below and paste it as a new browser bookmark\'s URL.', 'bmwpskywolf'); ?></p>
        <textarea rows="5" cols="50" id="bookmarklet-code"><?php echo esc_textarea($bookmarklet_code); ?></textarea>
    </div>
    <?php
}

// Add the admin menu page within tools
function bmwpskywolf_add_admin_menu() {
    add_management_page('Bookmarklet', 'Bookmarklet', 'manage_options', 'wpbm-bookmarklet', 'bmwpskywolf_bookmarklet_page');
}
add_action('admin_menu', 'bmwpskywolf_add_admin_menu');