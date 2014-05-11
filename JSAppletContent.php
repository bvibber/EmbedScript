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

class JSAppletContent extends AbstractContent {
	/**
	 * @var JSApplet $jsapplet
	 */
	private $jsapplet;
	
	/**
	 * @param JSApplet $text JavaScript code.
	 */
	public function __construct( JSApplet $jsapplet, $model_id = CONTENT_MODEL_JSAPPLET ) {
		parent::__construct( $model_id );
		$this->jsapplet = $jsapplet;
	}
	
	protected function getHtml() {
		// @todo :D
		return '<pre>' . htmlspecialchars( $this->jsapplet->js ) . '</pre>';
	}
	
	public function getTextForSearchIndex() {
		// @todo
		return $this->jsapplet->js;
	}
	
	public function getWikitextForTransclusion() {
		return false;
	}
	
	public function getTextForSummary( $maxLength = 250 ) {
		// @todo
		return 'some JS code';
	}
	
	public function getNativeData() {
		return $this->jsapplet;
	}
	
	public function getSize() {
		return strlen( json_encode( $this->jsapplet->asArray() ) );
	}
	
	public function copy() {
		return $this;
	}
	
	public function isCountable( $hasLinks = null ) {
		return false;
	}

}
