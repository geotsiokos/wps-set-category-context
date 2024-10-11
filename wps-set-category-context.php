<?php
/**
 * Plugin Name: WPS Set Category Contenxt
 * Plugin URI: https://github.com/geotsiokos/wps-include-backorder-products.git
 * Description: Sets category context, using the [woocommerce_product_filter_context] shortcode
 * Version: 1.0.0
 * Author: gtsiokos
 * Author URI: http://www.netpad.gr
 * Donate-Link: http://www.netpad.gr
 * License: GPLv3
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class WPS_Set_Category_Context {
	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'wp_head' ) );
	}
	public static function wp_head() {
		global $post;
		$post_id = $post->ID;

		// This array contains each category and its matching category page id
		// the form is category_slug => page_id
		$pages_categories = array(
			'women' => 1983,
			'men'   => 1989
		);
		$key = array_search( $post_id, $pages_categories );
		if ( $key ) {
			// For the term we should use the category title or slug in single quotes
			if ( function_exists( 'woocommerce_product_filter_context' ) ) {
				woocommerce_product_filter_context(
					array(
						'taxonomy' => 'product_cat',
						'term'     => $key
					)
					);
			}
		}
	}
} WPS_Set_Category_Context::init();