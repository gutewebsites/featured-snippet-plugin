<?php
/*
Plugin Name: Featured-Snippet-Shortcode
Description: Use [featured_snippet image="Image URL" image_alt="Alt-Attribute for your image"]Your content for the featured snippet[/featured_snippet] to display a little featured snippet box in your content area.
Author: TechnicalSEO.de, André Goldmann
Author URI: https://www.technicalseo.de
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function featured_snippet_function() {
  	echo '<link rel="stylesheet" href="'.plugins_url('', __FILE__).'/featured-snippet.css" type="text/css" media="screen" />';
}
add_action( 'wp_head' , 'featured_snippet_function',40);

function featured_snippet_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts(
		array(
			'image' => '',
			'image_alt' => '',
		),
		$atts);

	return '<div class="featured_snippet"><img src="' . $atts['image'] . '" alt="' . $atts['image_alt'] . '" /><p>' . $content . '</p></div>';

}
add_shortcode( 'featured_snippet', 'featured_snippet_shortcode' );