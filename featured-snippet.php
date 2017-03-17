<?php
/*
Plugin Name: Featured-Snippet-Shortcode
Description: Use [featured_snippet image="Image URL" image_alt="Alt-Attribute for your image"]Your content for the featured snippet[/featured_snippet] to display a little featured snippet box in your content area.
Author: TechnicalSEO.de, André Goldmann
Author URI: https://www.technicalseo.de
Version: 1.1
*/

if ( !class_exists('WP') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

function my_plugin_update_handler( EUAPI_Handler $handler = null, EUAPI_Item_Plugin $item ) {

	if ( 'featured-snippet-plugin/featured-snippet-plugin.php' == $item->file ) {

		$handler = new EUAPI_Handler_GitHub( array(
			'type'       => $item->type,
			'file'       => $item->file,
			'github_url' => 'https://github.com/pixeldreher/featured-snippet-plugin',
			'http'       => array(
				'sslverify' => false,
			),
		) );

	}

	return $handler;

}
add_filter( 'euapi_plugin_handler', 'my_plugin_update_handler', 10, 2 );

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