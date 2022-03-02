<?php
/**
 * Define the metabox and field configurations.
 *
 * @package IVN
 */

add_action('cmb2_admin_init', 'ivn_cmb_front_page');
function ivn_cmb_front_page()
{
    $prefix = 'ivn_front_page_';

    /** @var $hero */
    $hero = new_cmb2_box(array(
        'id' => $prefix . 'hero',
        'title' => esc_html__('Sekcja - Hero', 'ivn-cmb'),
        'object_types' => array('page'),
        'show_on' => array('key' => 'id', 'value' => get_option('page_on_front')),
        'context' => 'normal',
        'priority' => 'high',
        'closed' => true
    ));
    $hero->add_field(array(
        'id' => $prefix . 'hero_title',
        'name' => esc_html__('Tytuł', 'ivn-cmb'),
        'type' => 'text'
    ));
    $hero->add_field(array(
        'id' => $prefix . 'hero_subtitle',
        'name' => esc_html__('Podtytuł', 'ivn-cmb'),
        'type' => 'text'
    ));
}