<?php
/**
 * Base classes for actions done on pages.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA
 *
 * @file
 */

/**
 * Standalone record item for JSApplet / EmbedScript
 *
 * Meant to be immutable once instantiated. Whee!
 */
class JSApplet {
	/**
	 * HTML body content for the applet's iframe body
	 * Only the HTML from the main applet will be used; HTML from
	 * dependencies will be discarded. (or should it?)
	 *
	 * @var string $html
	 */
	public $html = '';

	/**
	 * CSS styles to inject into the applet's iframe body
	 * Additional code can be applied by adding a library dependency.
	 *
	 * @var string $css
	 */
	public $css = '';

	/**
	 * Main JavaScript code for the applet.
	 * Additional code can be applied by adding a library dependency.
	 *
	 * @var string $js
	 */
	public $js = '';

	/**
	 * List of other JSApplet modules that will be combined with this
	 * in actual output. This allows for bundling library dependencies.
	 *
	 * This list need not be ordered strictly; dependencies will be
	 * followed and resolved recursively.
	 *
	 * @var array $deps
	 */
	public $deps = array();

	/**
	 * Return a JSON-friendly array to save the applet's contents.
	 *
	 * @return array
	 */
	public function asArray() {
		return array(
			'html' => $this->html,
			'css' => $this->css,
			'js' => $this->js,
			'deps' => $this->deps
		);
	}

	/**
	 * Reconstruct an object from a JSON-style array
	 *
	 * @return JSApplet
	 */
	public static function newFromArray( array $arr ) {
		$jsapplet = new JSApplet();

		if ( array_key_exists( 'html', $arr ) ) {
			assert( is_string( $arr['html'] ) );
			$jsapplet->html = $arr['html'];
		}
		if ( array_key_exists( 'css', $arr ) ) {
			assert( is_string( $arr['css'] ) );
			$jsapplet->css = $arr['css'];
		}
		if ( array_key_exists( 'js', $arr ) ) {
			assert( is_string( $arr['js'] ) );
			$jsapplet->js = $arr['js'];
		}
		if ( array_key_exists( 'deps', $arr ) ) {
			assert( is_array( $arr['deps'] ) );
			foreach ( $arr['deps'] as $key => $val ) {
				assert( is_int( $key ) );
				assert( is_string( $val ) );
			}
			$jsapplet->deps = $arr['deps'];
		}

		return $jsapplet;
	}

	/**
	 * @param string $source
	 *
	 * @return JSApplet
	 */
	public static function newFromSource( $source ) {
		assert( is_string( $source ) );

		$jsapplet = new JSApplet();
		$jsapplet->js = $source;

		return $jsapplet;
	}
}
