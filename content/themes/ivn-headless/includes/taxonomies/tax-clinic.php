<?php
/**
 * Clinic Group - Taxonomy
 */
?>
<?php

/**
 * @link   http://codex.wordpress.org/Function_Reference/add_action
 * @link   http://codex.wordpress.org/Function_Reference/add_filter
 *
 * @return void
 */
function ivn_clinic_network_taxonomy_setup()
{
    add_action('init', 'ivn_clinic_network_taxonomy');
}

add_action('after_setup_theme', 'ivn_clinic_network_taxonomy_setup', 11);

/**
 * @link   http://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @return void
 */
function ivn_clinic_network_taxonomy()
{
    $aTaxonomyLabels = array(
        'name' => _x('Sieci Laboratoriów', 'Taxonomy General Name', 'ivn-theme'),
        'singular_name' => _x('Sieć Laboratoriów', 'Taxonomy Singular Name', 'ivn-theme'),
        'menu_name' => __('Sieci Laboratoriów', 'ivn-theme'),
        'all_items' => __('Wszystkie Sieci Laboratoriów', 'ivn-theme'),
        'parent_item' => __('Ojciec Sieci', 'ivn-theme'),
        'parent_item_colon' => __('Ojciec Sieci:', 'ivn-theme'),
        'new_item_name' => __('Nazwa Sieci Laboratoriów', 'ivn-theme'),
        'add_new_item' => __('Dodaj Sieć', 'ivn-theme'),
        'edit_item' => __('Edytuj Sieć', 'ivn-theme'),
        'update_item' => __('Aktualizuj Sieć', 'ivn-theme'),
        'separate_items_with_commas' => __('Oddziel sieci laboratoriów przecinkami', 'ivn-theme'),
        'search_items' => __('Szukaj sieci laboratioriów', 'ivn-theme'),
        'add_or_remove_items' => __('Dodaj lub usuń sieć', 'ivn-theme'),
        'choose_from_most_used' => __('Wybierz z najczęściej używanych sieci', 'ivn-theme'),
    );

    $aTaxonomyArguments = array(
        'labels' => $aTaxonomyLabels,
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'show_tagcloud' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'show_in_filter_area' => true,
        'rewrite' => array(
            'slug' => 'clinic-network',
            'with_front' => false,
            'hierarchical' => true,
        ),
    );

    register_taxonomy('clinic-network', array('clinic'), $aTaxonomyArguments);
}