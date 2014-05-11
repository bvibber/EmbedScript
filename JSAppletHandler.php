<?php

class JSAppletHandler extends ContentHandler {
	public function __construct(
		$modelId = CONTENT_MODEL_EMBEDSCRIPT,
		$formats = array( CONTENT_FORMAT_JSON, CONTENT_FORMAT_JAVASCRIPT )
	) {
		parent::__construct( $modelId, $formats );
	}

	/**
	 * Returns the content's text as-is.
	 *
	 * @param Content $content
	 * @param string $format The serialization format to check
	 *
	 * @return mixed
	 */
	public function serializeContent( Content $content, $format = null ) {
		$this->checkFormat( $format );

		$data = $content->asArray();
		$blob = json_encode( $data );
		return $blob;
	}

	/**
	 * @return JSAppletContent
	 *
	 * @see ContentHandler::unserializeContent()
	 */
	public function unserializeContent( $blob, $format = null ) {
		$this->checkFormat( $format );
		
		if ( !$format || $format === CONTENT_FORMAT_JSON ) {
			$data = json_decode( $blob );
			$jsapplet = JSApplet::newFromArray( $data );
		} else if ($format === CONTENT_FORMAT_JAVASCRIPT ) {
			// assuming this doesn't explode :D
			$jsapplet = JSApplet::newFromSource( $blob );
		}
		return new JSAppletContent( $jsapplet );
	}

	/**
	 * @return JSAppletContent
	 *
	 * @see ContentHandler::unserializeContent()
	 */
	public function makeEmptyContent() {
		$jsapplet = new JSApplet();
		return new JSAppletContent( $jsapplet );
	}

	/**
	 * @return Content|bool
	 */
	public function merge3( Content $oldContent, Content $myContent, Content $yourContent ) {
		throw new MWException( 'Diffs are not yet implemented' );
	}

	/**
	 * @return boolean
	 *
	 * @see ContentHandler::unserializeContent()
	 */
	public function supportsSections() {
		return false;
	}

	/**
	 * @return boolean
	 *
	 * @see ContentHandler::unserializeContent()
	 */
	public function supportsRedirects() {
		return false;
	}
	
	public function getActionOverrides() {
		return array(
			'edit' => 'JSAppletEditAction'
		);
	}
}
