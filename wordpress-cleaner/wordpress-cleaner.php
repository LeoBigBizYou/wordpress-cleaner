<?php
/*
Plugin Name: Wordpress Cleaner
Description: Supprime les articles ainsi que les commentaires de base du wordpress + widgets inutiles du dashboard
Author: Léo DEMET
Version: 1.0
Author URI: https://www.demet.fr/
*/


use Khaldalim\WordpressCleaner\WordpressCleaner;

if (!defined('ABSPATH'))
    exit;

define('WORDPRESS_CLEANER_DIR', plugin_dir_path(__FILE__));

require WORDPRESS_CLEANER_DIR . 'vendor/autoload.php';

$plugin = new WordpressCleaner(__FILE__);
$options = get_option('wordpress_cleaner_general');


if (isset($options['remove_comments'])) {
    if ($options['remove_comments'] == 1) {
        require_once plugin_dir_path(__FILE__) . 'includes/comments.php';
    }
}


if (isset($options['remove_posts'])) {
    if ($options['remove_posts'] == 1) {
        require_once plugin_dir_path(__FILE__) . 'includes/posts.php';
    }
}

if (isset($options['remove_widgets'])) {
    if ($options['remove_widgets'] == 1) {
        require_once plugin_dir_path(__FILE__) . 'includes/dashboards_widgets.php';
    }
}

if (isset($options['remove_search'])) {
    if ($options['remove_search'] == 1) {
        require_once plugin_dir_path(__FILE__) . 'includes/search.php';
    }
}


if (isset($options['remove_apparance'])) {
    if ($options['remove_apparance'] == 1) {
        add_action('admin_menu', function () {
            remove_menu_page('themes.php');
        });
    }
}


if (isset($options['remove_tools'])) {
    if ($options['remove_tools'] == 1) {
        add_action('admin_menu', function () {
            remove_submenu_page('tools.php', 'import.php');
            remove_submenu_page('tools.php', 'tools.php');
            remove_submenu_page('tools.php', 'export.php');
            remove_submenu_page('tools.php', 'export-personal-data.php');
            remove_submenu_page('tools.php', 'erase-personal-data.php');
        });
    }
}

if (isset($options['remove_gutemberg'])) {
    if ($options['remove_gutemberg'] == 1) {
        add_filter('use_block_editor_for_post', '__return_false', 10);
    }
}


//raccourci vers les parametres dans la page plugins
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links');
function add_action_links($actions)
{
    $mylinks = array(
        '<a href="' . admin_url('options-general.php?page=wordpress_cleaner') . '">Réglages</a>',
    );
    $actions = array_merge($actions, $mylinks);
    return $actions;
}


//affiche le plus gros favicon en tant qu'image de page de connection
add_action('login_head', 'namespace_login_style');
function namespace_login_style()
{
    echo '<style>.login h1 a { background-image: url("' . get_bloginfo('template_directory') . '/assets/favicon/mstile-310x310.png" ) !important; }</style>';
}


//ajoute une signature en bas du back-offce
add_filter('admin_footer_text', 'remove_footer_admin');
function remove_footer_admin()
{
    echo '<p>Designé par <a href="https://bigbizyou.com" target="_blank">BigBizYou</a></p>';
}

/**
 * change url of login page logo
 */
add_filter('login_headerurl', 'my_custom_login_url');
function my_custom_login_url($url)
{
    return 'https://bigbizyou.com';
}


/**
 *   Remove Wordpress logo in backOffice
 * @author Léo
 */
add_action('admin_bar_menu', 'remove_wp_logo', 999);
function remove_wp_logo($wp_admin_bar)
{
    $wp_admin_bar->remove_node('wp-logo');
}


