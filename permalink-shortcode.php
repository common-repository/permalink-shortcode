<?php
/*
Plugin Name: Permalink Shortcode
Description: Provides a shortcode that allows you to insert permalinks into your content.
Version: 1.0.0
Author: Ryan Lange
Author URI: http://ryan-lange.com/

--------------------------------------------------------------------------------

Permalink Shortcode Plugin
Copyright (C) 2013  Ryan Lange <ryan.m.lange@gmail.com>

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 2 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Prevent direct access to this file.
if( !defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if( !class_exists( 'PermalinkShortcode' ) ) {

	/**
	 * Permalink Shortcode
	 */
	final class PermalinkShortcode {

		/**
		 * Default values for the shortcode's attributes.
		 *
		 * @var array
		 */
		private $defaults = array(
			'link' => array(
				'wpid'      => 0,
				'query'     => null,
				'fragment'  => null
			),
			'html' => array(
				'accesskey' => null,
				'charset'   => null,
				'class'     => null,
				'dir'       => null,
				'hreflang'  => null,
				'id'        => null,
				'lang'      => null,
				'media'     => null,
				'rel'       => null,
				'rev'       => null,
				'style'     => null,
				'target'    => null,
				'title'     => null,
				'type'      => null
			)
		);

		/**
		 * @var PermalinkShortcode
		 */
		private static $instance = null;

		/**
		 * constructor
		 */
		private function __construct()
		{
			add_shortcode( 'permalink', array( $this, 'doShortcode' ) );
		}

		/**
		 * @param array $attributes
		 * @param string $content
		 * @return string
		 */
		public function doShortcode( $attributes, $content = null )
		{
			$link_attributes = shortcode_atts( $this->defaults['link'], $attributes );

			if( empty( $content ) ) {
				$output = $this->getUri( $link_attributes );
			} else {
				$output = '<a href="' . $this->getUri( $link_attributes ) . '"';

				// Add the HTML attributes.
				foreach( shortcode_atts( $this->defaults['html'], $attributes ) as $attribute => $value ) {

					// Some attributes need special handling.
					if( 'class' == $attribute ) {
						$value = trim( "permalink-shortcode {$value}" );
					} elseif( ( 'title' == $attribute ) && ( null === $value ) ) {
						$value = get_the_title( $link_attributes['wpid'] );
					}

					if( null !== $value ) {
						$output .= ' ' . $attribute . '="' . esc_attr( $value ) . '"';
					}
				}

				$output .= '>' . do_shortcode( $content ) . '</a>';
			}

			return $output;
		}

		/**
		 * @param array $link_attributes
		 * @return string
		 */
		private function getUri( array $link_attributes )
		{
			$permalink = get_permalink( $link_attributes['wpid'] );

			$query = $link_attributes['query'];
			if( ( null !== $query ) && ( '?' !== substr( $query, 0, 1 ) ) ) {
				$query = "?{$query}";
			}

			$fragment = $link_attributes['fragment'];
			if( ( null !== $fragment ) && ( '#' !== substr( $fragment, 0, 1 ) ) ) {
				$fragment = "#{$fragment}";
			}

			return $permalink . $query . $fragment;
		}

		/**
		 * Initializes the plugin by creating an instance of the class if no
		 * instance already exists.
		 */
		public static function init()
		{
			if( null === self::$instance ) {
				self::$instance = new self();
			}
		}

		// prevent cloning
		private function __clone() {}
	}

	PermalinkShortcode::init();
}
