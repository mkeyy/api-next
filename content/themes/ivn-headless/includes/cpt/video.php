<?php
/**
 * Videos - Post Type
 *
 * @package IVN
 */
?>
<?php

/**
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_videos_post_type_setup()
{
    add_action('init', 'ivn_videos_post_type');
}

add_action('after_setup_theme', 'ivn_videos_post_type_setup', 11);

/**
 * @link   http://codex.wordpress.org/Function_Reference/register_post_type
 * @link   http://codex.wordpress.org/Post_Types
 *
 * @return void
 */
function ivn_videos_post_type()
{
    $aPostTypeLabels = array(
        'name' => _x('Videos', 'Post Type General Name', 'ivn-theme'),
        'singular_name' => _x('Video', 'Post Type Singular Name', 'ivn-theme'),
        'menu_name' => __('Videos', 'ivn-theme'),
        'parent_item_colon' => __('Parent:', 'ivn-theme'),
        'all_items' => __('All Videos', 'ivn-theme'),
        'view_item' => __('See Video', 'ivn-theme'),
        'add_new_item' => __('Add Video', 'ivn-theme'),
        'add_new' => __('New Video', 'ivn-theme'),
        'edit_item' => __('Edit Video', 'ivn-theme'),
        'update_item' => __('Update Video', 'ivn-theme'),
        'search_items' => __('Search for video', 'ivn-theme'),
        'not_found' => __('Not found.', 'ivn-theme'),
        'not_found_in_trash' => __('Not found in trash.', 'ivn-theme'),
    );

    $aPostTypeArguments = array(
        'label' => __('Video', 'ivn-theme'),
        'description' => '',
        'labels' => $aPostTypeLabels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'capability_type' => 'page',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-format-video',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes'
        ),
        'taxonomies' => array(),
        'has_archive' => false,
        'rewrite' => array(
            'slug' => 'videos',
            'with_front' => false,
        ),
        'can_export' => true,
        'show_in_graphql' => true,
        'graphql_single_name' => 'video',
        'graphql_plural_name' => 'videos',
    );

    register_post_type('videos', $aPostTypeArguments);
}