<?php
/**
 * Index page.
 *
 * @package IVN
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <main>
        <h1>Headless Wordpress</h1>
        <p>Created by <a href="https://ivision.pl/" target="_blank" title="IVN - Agencja Interaktywna - Kraków">IVN™</a>
        </p>
    </main>

<?php endif; ?>
<?php get_footer(); ?>