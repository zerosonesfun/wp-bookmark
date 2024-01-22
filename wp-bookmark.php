<?php
/*
Plugin Name: bookmark wp
Description: A bookmarking/reposting plugin for WordPress similar to the old Press This feature.
Version: 1.0
Author: Billy Wilcosky
Author URI: https://wilcosky.com/skywolf
License: GPL-2.0+
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// Include necessary files
include(plugin_dir_path(__FILE__) . 'includes/wpbm-admin-page.php');
include(plugin_dir_path(__FILE__) . 'includes/wpbm-post.php');