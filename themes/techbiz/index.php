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
    // Header
    get_header();

    /**
    *
    * Hook for About Us Section
    *
    * Hook techbiz_home_about_us
    *
    * @Hooked techbiz_home_about_us_cb 10
    *
    */
    do_action( 'techbiz_home_about_us' );

    /**
    *
    * Hook for Home Page Team Members Section
    *
    * Hook techbiz_home_team_members
    *
    * @Hooked techbiz_home_team_members_cb 10
    *
    */
    do_action( 'techbiz_home_team_members' );

    //footer
    get_footer();