<?php
/**
 * Ivision Theme functions and definitions
 *
 * @package IVN
 */

define('IVN_THEME_DIR', trailingslashit(get_template_directory()));
define('IVN_THEME_URI', trailingslashit(get_template_directory_uri()));

define('IVN_INC_DIR', trailingslashit(IVN_THEME_DIR . 'includes'));
define('IVN_INC_URI', trailingslashit(IVN_THEME_URI . 'includes'));

define('IVN_BLOCK_DIR', trailingslashit(IVN_THEME_DIR . 'blocks'));
define('IVN_BLOCK_URI', trailingslashit(IVN_THEME_URI . 'blocks'));

define('IVN_ASSETS_DIR', trailingslashit(IVN_THEME_DIR . 'assets'));
define('IVN_ASSETS_URI', trailingslashit(IVN_THEME_URI . 'assets'));

define('IVN_IMG_DIR', trailingslashit(IVN_THEME_DIR . 'build/img'));
define('IVN_IMG_URI', trailingslashit(IVN_THEME_URI . 'build/img'));

define('IVN_FONTS_DIR', trailingslashit(IVN_THEME_DIR . 'build/fonts'));
define('IVN_FONTS_URI', trailingslashit(IVN_THEME_URI . 'build/fonts'));

define('IVN_BUILD_DIR', trailingslashit(IVN_THEME_DIR . 'build'));
define('IVN_BUILD_URI', trailingslashit(IVN_THEME_URI . 'build'));

define('IVN_CSS_DIR', trailingslashit(IVN_THEME_DIR . 'build/css'));
define('IVN_CSS_URI', trailingslashit(IVN_THEME_URI . 'build/css'));

define('IVN_JS_DIR', trailingslashit(IVN_THEME_DIR . 'build/js'));
define('IVN_JS_URI', trailingslashit(IVN_THEME_URI . 'build/js'));

/**
 * Files to include
 */

$IVN_Includes = array(
    IVN_INC_DIR . 'settings.php',
    IVN_INC_DIR . 'utils.php',
    IVN_INC_DIR . 'enqueue.php',
    IVN_INC_DIR . 'includes.php',
);

foreach ($IVN_Includes as $IVN_Include) {
    require($IVN_Include);
}

/**
 * IF YOU WANT TO ADD ANY CUSTOM CODE:
 * do it in a custom file then add it to 
 * includes/includes.php
 */