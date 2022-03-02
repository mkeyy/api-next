<?php
/**
 * Theme Setup
 *
 * @package IVN
 */

function ivn_theme_setup()
{
    /**
     * Theme Features
     */
    add_action('init', 'ivn_theme_init');
    add_action('init', 'ivn_register_menus');

    /**
     * Media
     */
    add_filter('sanitize_file_name', 'ivn_sanitize_file_name');
    add_action('init', 'ivn_image_sizes');
    add_filter('intermediate_image_sizes_advanced', 'ivn_remove_default_image_sizes');
    add_filter('big_image_size_threshold', '__return_false');

    /**
     * Administration
     */
    add_action('admin_menu', 'ivn_admin_init');
    //add_filter('use_block_editor_for_post', '__return_false');
    add_action('admin_init', 'ivn_disable_editor_for_specific_template');

    /**
     * Utilities
     */
    add_action('init', 'ivn_pagination_url_translation');
    add_action('template_redirect', 'ivn_nice_search_redirect');

    /**
     * Disable Emojis
     */
    add_filter('tiny_mce_plugins', function ($plugins) {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    });
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

add_action('after_setup_theme', 'ivn_theme_setup');

/**
 * Theme Features
 */

/**
 * Basics
 */
function ivn_theme_init()
{
    add_theme_support('html5', array('script', 'style'));
    add_theme_support('post-thumbnails');
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
    remove_filter('term_description', 'wpautop');
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

/**
 * Register Menu Locations
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
function ivn_register_menus()
{
    register_nav_menus(array(
        'header-menu' => __('Header', 'ivn-backend'),
        'footer-menu' => __('Footer', 'ivn-backend'),
    ));
}

/**
 * Media
 */

/**
 * Custom image sizes
 * @link http://codex.wordpress.org/Function_Reference/add_image_size
 */
function ivn_image_sizes()
{
    //add_image_size('ivn-full', 1920, 99999, false);
}

/**
 * Do not create default image sizes
 */
function ivn_remove_default_image_sizes($sizes)
{
    unset($sizes['medium']);       // disable medium size
    unset($sizes['large']);        // disable large size
    unset($sizes['medium_large']); // disable medium-large size
    unset($sizes['1536x1536']);    // disable 2x medium-large size
    unset($sizes['2048x2048']);    // disable 2x large size
    return $sizes;
}

/**
 * Santize media names
 * @link http://codex.wordpress.org/Function_Reference/remove_accents
 * @link http://codex.wordpress.org/Function_Reference/seems_utf8
 * @link http://codex.wordpress.org/Function_Reference/utf8_uri_encode
 *
 * @param string $sFileName
 * @return string
 */
function ivn_sanitize_file_name($sFileName)
{
    $sFileName = remove_accents($sFileName);
    $sFileName = strip_tags($sFileName);

    if (seems_utf8($sFileName)) {
        if (function_exists('mb_strtolower')) {
            $sFileName = mb_strtolower($sFileName, 'UTF-8');
        }

        $sFileName = utf8_uri_encode($sFileName, 200);
    }

    $sFileName = strtolower($sFileName);
    $sFileName = preg_replace('/\s+/', '-', $sFileName);
    $sFileName = preg_replace('|-+|', '-', $sFileName);
    $sFileName = trim($sFileName, '-');

    return $sFileName;
}

/**
 * Administration
 */

define('DISALLOW_FILE_EDIT', true);

/**
 * Manage Administration Panel
 * @link http://codex.wordpress.org/Function_Reference/wp_get_current_user
 * @link http://codex.wordpress.org/Function_Reference/remove_menu_page
 * @link http://codex.wordpress.org/Function_Reference/remove_submenu_page
 */
function ivn_admin_init()
{
    remove_menu_page('edit-comments.php');

    add_action('wp_before_admin_bar_render', function () {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    });
}

/**
 * Disable content editor for listed templates
 */
function ivn_disable_editor_for_specific_template()
{
    $templates = array(
//        'front-page.php',
//        'templates/about.php',
//        'templates/exams.php',
//        'templates/faq.php',
//        'templates/search.php',
    );

    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } elseif (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    }

    if (!isset($post_id)) return;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    foreach ($templates as $template) {
        if ($template_file == $template) {
            remove_post_type_support('page', 'editor');
        }
    }

    //if ($post_id === get_option('page_on_front')) remove_post_type_support('page', 'editor');
}

/**
 * Utilities
 */

/**
 * Pagination URL translation
 */
function ivn_pagination_url_translation()
{
    global $wp_rewrite;
    $wp_rewrite->pagination_base = "strona";
}

/**
 * Pretty search URL
 */
function ivn_nice_search_redirect()
{
    global $wp_rewrite;

    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
        return;
    }

    $sSearchBase = $wp_rewrite->search_base;

    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$sSearchBase}/") === false) {
        wp_redirect(user_trailingslashit(trailingslashit(home_url("/{$sSearchBase}/" . urlencode(get_query_var('s'))))));
        exit();
    }
}