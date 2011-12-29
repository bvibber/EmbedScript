<?php

class EmbedScriptFunction {

	/**
	 *
	 * @param $content string
	 * @param $args array
	 * @param $parser Parser
	 */
	public static function embedScriptTag( $content, $args, $parser ) {
		/*
		if ( !array_key_exists( 'src', $args ) ) {
			return self::errorResult( wfMessage( 'embedscript-missing-src' ) );
		}
		*/

		$data = array(
			'code' => $content,
			'args' => $args
		);

		$parser->getOutput()->addModules( 'ext.embedscript.host' );
		return self::embedResult( $data, $args );
	}

	protected static function embedResult( $data, $params ) {
		return Html::element('div', array(
			'class' => 'mw-embedscript',
			'data-embed' => json_encode( $data )
		), '' );
		/*
		// This embeds in <[CDATA[...]]> which is redundant and breaks reading the text?!
		return Html::element('script', array(
			'type' => 'text/x-mediawiki-embedscript',
		), json_encode($data));
		*/
	}
	
	protected static function errorResult( Message $msg ) {
		return '<span class="error mw-embedscript-error">' .
			$msg->inContentLanguage()->parse() .
			'</span>';
	}

}
