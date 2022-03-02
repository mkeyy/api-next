<?php
/**
 * The template for displaying the header.
 *
 * @package IVN
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php get_template_part('partials/site', 'fonts'); ?>
    <?php wp_head(); ?>

    <?php if (is_front_page() || is_page_template('templates/search.php')): ?>
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=PL&language=pl&key=<?= GOOGLE_API_KEY ?>"></script>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
