<?php

/*
Plugin Name: Divi Lightbox for Jetpack Tiled galleries
Plugin URI: https:///www.saskialund.de/wp-plugins/
Description: Adds Divi's native lightbox effect to Jetpack Tiled galleries.

Version: 1.0

Author: Saskia Lund
Author URI: http://www.saskialund.de/

License: GPLv2

Text Domain: divi-jetpack-lightbox
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Nice try! :)' );

add_action( 'wp_footer', 'divi_jetpack_lightbox_js' );
function divi_jetpack_lightbox_js() {
	?><script type="text/javascript">(function($){$(document).ready(function(){
	if ($('.tiled-gallery').length !=0){
		var numBilder = $('.tiled-gallery .gallery-row .gallery-group .tiled-gallery-item').length;
		$('.tiled-gallery').wrap('<div class="et_pb_gallery"></div>');
		/* $('.tiled-gallery a').children('img').parent('a').addClass(function(){return(($(this).attr("href").split("?",1)[0].match(/\.(jpeg|jpg|gif|png)$/) != null) ? "et_pb_lightbox_image" : "") ;}); */
		$('.tiled-gallery').addClass("et_post_gallery et_pb_gallery_items").attr("data-per_page", numBilder);
		$('.gallery-group.images-1').addClass("et_pb_gallery_item");

			if ( $('.tiled-gallery').length ) {
				// swipe support in magnific popup only if gallery exists
				var magnificPopup = $.magnificPopup.instance;

				$( 'body' ).on( 'swiperight', '.mfp-container', function() {
					magnificPopup.prev();
				} );
				$( 'body' ).on( 'swipeleft', '.mfp-container', function() {
					magnificPopup.next();
				} );
				$('.tiled-gallery .gallery-row .gallery-group').magnificPopup( {
						delegate: '.tiled-gallery-item a',
						type: 'image',
						removalDelay: 500,
						gallery: {
							enabled: true,
							navigateByImgClick: true
						},
						mainClass: 'mfp-fade',
						zoom: {
							enabled: ! et_pb_custom.is_builder_plugin_used,
							duration: 500,
							opener: function(element) {
								return element.find('img');
							}
						},
						image: {
							titleSrc: function(item) {
							return '<div class="mfp-title">' + item.el.find('img').attr('alt') + '</div>';
							}
						}
					 });
			}
				
			
	}
	});})(jQuery)</script><?php
}