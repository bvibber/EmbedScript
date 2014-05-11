<?php

class JSAppletContent extends JavaScriptContent {
	/**
	 * @param string $text JavaScript code.
	 */
	public function __construct( $text, $model_id = CONTENT_MODEL_JSAPPLET ) {
		parent::__construct( $text, $model_id );
	}
	
	protected function getHtml() {
		// @todo :D
		return parent::getHtml();
	}
}
