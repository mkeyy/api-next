<?php
/**
 * Theme Enqueues
 *
 * @package IVN
 *
 * @link   http://codex.wordpress.org/Function_Reference/wp_deregister_script
 * @link   http://codex.wordpress.org/Function_Reference/wp_register_script
 * @link   http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link   http://codex.wordpress.org/Function_Reference/wp_localize_script
 * @link   http://codex.wordpress.org/Function_Reference/wp_is_mobile
 * @link   http://codex.wordpress.org/Function_Reference/admin_url
 */

/**
 * Remove version
 * @link http://codex.wordpress.org/Function_Reference/is_admin
 * @link http://codex.wordpress.org/Function_Reference/remove_query_arg
 * @link http://codex.wordpress.org/Function_Reference/add_query_arg
 *
 * @param string $resource
 * @return string
 */
function ivn_remove_style_script_version($resource)
{
    if (!is_admin() && strpos($resource, 'ver=') !== false) {
        $resource = remove_query_arg('ver', $resource);
    }

    return $resource;
}

/**
 * Theme
 */

add_action('after_setup_theme', 'ivn_enqueue_setup');
function ivn_enqueue_setup()
{
    add_action('wp_enqueue_scripts', 'ivn_dequeue_css', 100);
    add_action('wp_enqueue_scripts', 'ivn_enqueue_css');
    add_filter('style_loader_src', 'ivn_remove_style_script_version', 100);

    add_action('wp_enqueue_scripts', 'ivn_deregister_scripts');
    add_action('wp_enqueue_scripts', 'ivn_enqueue_js');
    add_filter('script_loader_src', 'ivn_remove_style_script_version', 100);

    add_filter('script_loader_tag', 'ivn_defer_parsing_of_js', 10);
}

/**
 * Administration
 */

add_action('after_setup_theme', 'ivn_admin_enqueue_setup');
function ivn_admin_enqueue_setup()
{
    add_action('admin_enqueue_scripts', 'ivn_admin_enqueue_css');
    add_action('admin_enqueue_scripts', 'ivn_admin_enqueue_js');
}

/**
 * CSS
 */
function ivn_dequeue_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}

function ivn_enqueue_css()
{
    /**
     * Enqueue styles
     */
    wp_enqueue_style('ivn-css-main', IVN_THEME_URI . 'style.css', array(), false);
}

function ivn_admin_enqueue_css()
{
    /**
     * Enqueue style
     */
    //wp_enqueue_style('ivn-css-admin', IVN_CSS_URI . $assetsMapping['style-admin'], array(), false);
}

/**
 * Javascript
 */
function ivn_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

function ivn_enqueue_js()
{
    /**
     * Enqueue main script
     */
    //wp_enqueue_script('ivn-js-main', IVN_JS_URI . $assetsMapping['main'], array(), false, true);
}

function ivn_admin_enqueue_js()
{
    /**
     * Enqueue and localize main script
     */
    //wp_enqueue_script('ivn-js-admin', IVN_JS_URI . $assetsMapping['admin'], array('jquery'), false, true);
}

/**
 * Add the defer attribute to all your JavaScript files except jQuery
 *
 * @param $url
 * @return mixed
 */
function ivn_defer_parsing_of_js($url)
{
    if (is_admin()) return $url;
    if (is_wplogin()) return $url;
    if (is_customize_preview()) return $url;
    if (FALSE === strpos($url, '.js')) return $url;
    if (strpos($url, 'jquery.js')) return $url;

    return str_replace(' src', ' defer src', $url);
}