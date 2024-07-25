<?php
/**
 * Plugin Name: Categories Images for Elementor
 * Description: Adds dynamic data tag that gets the category image
 * Plugin URI:  https://github.com/fondly-cz/categories-images-for-elementor
 * Version:     1.0.0
 * Author:      fondly.cz
 * Author URI:  https://www.fondly.cz/
 * Text Domain: categories-images-for-elementor
 *
 * Requires Plugins: elementor,elementor-pro,categories-images
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register categories images Dynamic Tag.
 *
 * Include dynamic tag file and register tag class.
 *
 * @since 1.0.0
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function registerCategoriesImagesDynamicTag( $dynamic_tags_manager ) {
	require_once( __DIR__ . '/dynamic-tags/CategoryImageTag.php' );
	$dynamic_tags_manager->register( new CategoryImageTag() );
}

add_action( 'elementor/dynamic_tags/register', 'registerCategoriesImagesDynamicTag' );

function showWarning() {
	?>
	<div class="notice notice-error is-dismissible">
		<p><?php _e( 'Plugin Categories Images is not active. Please activate the plugin to use the Category Image as a dynamic tag in Elementor.', 'category-image-loop' ); ?></p>
	</div>
	<?php
}


function checkRequiredPlugins() {
	if ( ! is_plugin_active( 'elementor/elementor.php' ) || ! is_plugin_active( 'elementor-pro/elementor-pro.php' ) || ! is_plugin_active( 'categories-images/categories-images.php' ) ) {
		add_action( 'admin_notices', 'showWarning' );
	}
}

add_action( 'admin_init', 'checkRequiredPlugins' );