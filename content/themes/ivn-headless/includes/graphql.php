<?php

function graphql_register_page_on_front()
{
    register_graphql_field(
        'RootQuery',
        'pageOnFront',
        array(
            'type' => 'Page',
            'resolve' => function () {
                $front_page_id = get_option('page_on_front');

                return [
                    'title' => get_the_title($front_page_id),
                    'content' => get_the_content($front_page_id)
                ];
            },
        )
    );
}

add_action('graphql_register_types', 'graphql_register_page_on_front');