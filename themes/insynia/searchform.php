<?php
/**
 * The template for displaying search forms
 *
 * @package Insynia
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-field-<?php echo uniqid(); ?>" class="screen-reader-text">
        <?php esc_html_e( 'Search for:', 'insynia' ); ?>
    </label>
    <input
        type="search"
        id="search-field-<?php echo uniqid(); ?>"
        class="search-field"
        placeholder="<?php esc_attr_e( 'Search...', 'insynia' ); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
        title="<?php esc_attr_e( 'Search for:', 'insynia' ); ?>"
    />
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php esc_html_e( 'Search', 'insynia' ); ?></span>
        <?php esc_html_e( 'Search', 'insynia' ); ?>
    </button>
</form>