<?php
/**
 * Theme Utilities
 *
 * @package IVN
 */

/**
 * Check if page is wp login
 */
function is_wplogin(): bool
{
    $ABSPATH_MY = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, ABSPATH);
    return ((in_array($ABSPATH_MY . 'wp-login.php', get_included_files()) || in_array($ABSPATH_MY . 'wp-register.php', get_included_files())) || (isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') || $_SERVER['PHP_SELF'] == '/wp-login.php');
}
