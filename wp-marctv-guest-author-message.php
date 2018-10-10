<?php
/**
 * Plugin Name: Guest Author Message
 * Description: Displays a message if USP guest author is found on the post
 * Plugin URI:  https://marc.tv
 * Version:     0.2
 * Text Domain: guest-author-message
 * Domain Path: /languages
 * GitHub Plugin URI: mtoensing/wp-marctv-guest-author-message
 */


function marctv_wgam_add_info($content) {

	$post_id = get_the_ID();

	if ( is_single() AND metadata_exists( 'post', $post_id, 'user_submit_name' )) {

		$name =  get_post_meta( $post_id, 'user_submit_name', true );
		$html = '';
		$html .= '<p class="wgam-infobox">';
		$html .= '<strong>Hinweis:</strong> Dieser Gastartikel stammt von ' . $name . ' und wurde nicht von <a href="https://marc.tv/marc-toensing/">Marc</a> geschrieben.';
		$html .= '</p>';

		return $html . $content;

	} else {
		return $content;
	}

}

add_filter('the_content', 'marctv_wgam_add_info');



function marctv_wgam_enqueue_scripts() {
	wp_enqueue_style(
		"marctv-wgam", WP_PLUGIN_URL . "/wp-marctv-guest-author-message/style.css", true, "1.0");

}

add_action( 'wp_enqueue_scripts', 'marctv_wgam_enqueue_scripts' );

