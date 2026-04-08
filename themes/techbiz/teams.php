<?php
/**
 * Template Name: Teams
 *
 * Page template for displaying the team members listing.
 *
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
 * Hook for Page Start Wrapper
 *
 * Hook techbiz_page_start_wrap
 *
 * @Hooked techbiz_page_start_wrap_cb 10
 */
do_action( 'techbiz_page_start_wrap' );

/**
 * Hook for Column Start Wrapper
 *
 * Hook techbiz_page_col_start_wrap
 *
 * @Hooked techbiz_page_col_start_wrap_cb 10
 */
do_action( 'techbiz_page_col_start_wrap' );

$techbiz_team_members = array(
    array(
        'name' => 'Hafiz Umer Sheikh',
        'role' => 'CEO',
        'icon' => 'fas fa-user-tie',
    ),
    array(
        'name' => 'Muneeb Khan',
        'role' => 'CTO',
        'icon' => 'fas fa-user-cog',
    ),
    array(
        'name' => 'Sana Khan',
        'role' => 'COO',
        'icon' => 'fas fa-user-circle',
    ),
);
?>

<!-- Teams Grid -->
<div class="vs-teams-wrapper">
    <div class="row justify-content-center">
        <?php foreach ( $techbiz_team_members as $member ) : ?>
        <div class="col-lg-4 col-sm-6">
            <!-- Single Team Member -->
            <div class="team-style1 text-center">
                <div class="team-img">
                    <i class="<?php echo esc_attr( $member['icon'] ); ?>" style="font-size: 80px; color: #6c757d;"></i>
                </div>
                <div class="team-content">
                    <h4 class="team-title"><?php echo esc_html( $member['name'] ); ?></h4>
                    <p class="team-degi"><?php echo esc_html( $member['role'] ); ?></p>
                </div>
            </div>
            <!-- End Single Team Member -->
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- End Teams Grid -->

<?php

/**
 * Hook for Column End Wrapper
 *
 * Hook techbiz_page_col_end_wrap
 *
 * @Hooked techbiz_page_col_end_wrap_cb 10
 */
do_action( 'techbiz_page_col_end_wrap' );

/**
 * Hook for Page Sidebar
 *
 * Hook techbiz_page_sidebar
 *
 * @Hooked techbiz_page_sidebar_cb 10
 */
do_action( 'techbiz_page_sidebar' );

/**
 * Hook for Page End Wrapper
 *
 * Hook techbiz_page_end_wrap
 *
 * @Hooked techbiz_page_end_wrap_cb 10
 */
do_action( 'techbiz_page_end_wrap' );

// Footer
get_footer();
