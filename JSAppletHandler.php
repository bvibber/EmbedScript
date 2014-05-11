<?php

class JSAppletHandler extends JavaScriptContentHandler {
	public function __construct(
		$modelId = CONTENT_MODEL_EMBEDSCRIPT,
		$formats = CONTENT_FORMAT_EMBEDSCRIPT
	) {
		parent::__construct( $modelId, $formats );
	}

	public function unserializeContent( $text, $format = null ) {
		$this->checkFormat( $format );
		return new JSAppletContent( $text );
	}

	public function makeEmptyContent() {
		return new JSAppletContent( '' );
	}

	public function supportsSections() {
		return false;
	}

	public function supportsRedirects() {
		return false;
	}
}
