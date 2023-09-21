<?php
// Function to create the admin page
function wpbm_bookmarklet_page() {
    $plugin_url = plugins_url('', __FILE__);
    $site_url = site_url();

    $bookmarklet_code = "
    javascript:(function(){var t=encodeURIComponent(document.title),d=document.querySelector('meta[name=\"description\"]'),u=encodeURIComponent(window.location.href),i=document.querySelector('meta[property=\"og:image\"]');d=d?encodeURIComponent(d.content):'No description available';i=i?encodeURIComponent(i.content):'No image available';var r=\"$site_url/wp-admin/post-new.php?post_type=post\";r+=\"&title=\"+t+\"&content=\"+d+\"&wpbm_url=\"+u+\"&wpbm_og_image=\"+i;window.location.href=r;})();
    ";

    ?>
    <div class="wrap">
    <h1><?php echo esc_html__('Bookmarklet', 'wpbm'); ?></h1>
    <p><?php echo esc_html__('Copy the code below and paste it as a new browser bookmark\'s URL.', 'wpbm'); ?></p>
    <textarea rows="5" cols="50" id="bookmarklet-code"><?php echo esc_textarea($bookmarklet_code); ?></textarea>
    </div>
    <?php
}

// Add the admin menu page
function wpbm_add_admin_menu() {
    add_management_page('Bookmarklet', 'Bookmarklet', 'manage_options', 'wpbm-bookmarklet', 'wpbm_bookmarklet_page');
}
add_action('admin_menu', 'wpbm_add_admin_menu');