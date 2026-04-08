<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/techbiz-constants.php';

//theme setup
require_once TECHBIZ_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once TECHBIZ_DIR_PATH_INC . 'essential-scripts.php';

// plugin activation
require_once TECHBIZ_DIR_PATH_FRAM . 'plugins-activation/techbiz-active-plugins.php';

// meta options
require_once TECHBIZ_DIR_PATH_FRAM . 'techbiz-meta/techbiz-config.php';

// page breadcrumbs
require_once TECHBIZ_DIR_PATH_INC . 'techbiz-breadcrumbs.php';

// sidebar register
require_once TECHBIZ_DIR_PATH_INC . 'techbiz-widgets-reg.php';

//essential functions
require_once TECHBIZ_DIR_PATH_INC . 'techbiz-functions.php';

// theme dynamic css
require_once TECHBIZ_DIR_PATH_INC . 'techbiz-commoncss.php';

// helper function
require_once TECHBIZ_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once TECHBIZ_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once TECHBIZ_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// techbiz options
require_once TECHBIZ_DIR_PATH_FRAM . 'techbiz-options/techbiz-options.php';

// hooks
require_once TECHBIZ_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once TECHBIZ_DIR_PATH_HOOKS . 'hooks-functions.php';

if( class_exists( 'woocommerce' ) ){
    require_once TECHBIZ_DIR_PATH_INC . 'woo-hooks/techbiz-woo-hooks.php';
    require_once TECHBIZ_DIR_PATH_INC . 'woo-hooks/techbiz-woo-hooks-functions.php';
};