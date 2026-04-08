<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Techbiz
	* @Version     : 1.0
	* @Author     : Vecurosoft
    * @Author URI : https://www.vecurosoft.com/
	*
	*/

	if( ! is_active_sidebar( 'techbiz-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-lg-4">
	<!-- Sidebar Begin -->
	<aside class="sidebar mt-5 mt-lg-0">
		<?php
			dynamic_sidebar( 'techbiz-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>