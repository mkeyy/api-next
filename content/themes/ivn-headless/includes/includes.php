<?php
/**
 * Files to include
 *
 * @package IVN
 */

$ivn_CustomIncludes = array(
    /**
     * Meta Boxes
     */

    /**
     * Custom Post Types
     */
    'cpt/video.php',

    /**
     * Taxonomies
     */

    /**
     * Other Files
     */
    'custom.php'
);

foreach ($ivn_CustomIncludes as $ivn_CustomInclude) {
    require(IVN_INC_DIR . $ivn_CustomInclude);
}