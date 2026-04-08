<?php
/**
 * @Packge     : Techbiz
 * @Version    : 1.0
 * @Author     : Vecurosoft
 * @Author URI : https://www.vecurosoft.com/
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'TECHBIZ_DIR_URI' ) ) {
    define('TECHBIZ_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'TECHBIZ_DIR_ASSIST_URI' ) ) {
    define( 'TECHBIZ_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'TECHBIZ_DIR_CSS_URI' ) ) {
    define( 'TECHBIZ_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Skin Css File
if ( ! defined( 'TECHBIZ_DIR_SKIN_CSS_URI' ) ) {
    define( 'TECHBIZ_DIR_SKIN_CSS_URI', get_theme_file_uri('/assets/css/skins/') );
}


// Js File URI
if (!defined('TECHBIZ_DIR_JS_URI')) {
    define('TECHBIZ_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// External PLugin File URI
if (!defined('TECHBIZ_DIR_PLUGIN_URI')) {
    define('TECHBIZ_DIR_PLUGIN_URI', get_theme_file_uri( '/assets/plugins/'));
}

// Base Directory
if (!defined('TECHBIZ_DIR_PATH')) {
    define('TECHBIZ_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('TECHBIZ_DIR_PATH_INC')) {
    define('TECHBIZ_DIR_PATH_INC', TECHBIZ_DIR_PATH . 'inc/');
}

//TECHBIZ framework Folder Directory
if (!defined('TECHBIZ_DIR_PATH_FRAM')) {
    define('TECHBIZ_DIR_PATH_FRAM', TECHBIZ_DIR_PATH_INC . 'techbiz-framework/');
}

//Classes Folder Directory
if (!defined('TECHBIZ_DIR_PATH_CLASSES')) {
    define('TECHBIZ_DIR_PATH_CLASSES', TECHBIZ_DIR_PATH_INC . 'classes/');
}

//Hooks Folder Directory
if (!defined('TECHBIZ_DIR_PATH_HOOKS')) {
    define('TECHBIZ_DIR_PATH_HOOKS', TECHBIZ_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'TECHBIZ_DEMO_DIR_PATH' ) ){
    define( 'TECHBIZ_DEMO_DIR_PATH', TECHBIZ_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'TECHBIZ_DEMO_DIR_URI' ) ){
    define( 'TECHBIZ_DEMO_DIR_URI', TECHBIZ_DIR_URI.'inc/demo-data/' );
}