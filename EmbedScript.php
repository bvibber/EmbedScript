<?php

/*
 * Copyright (C) 2011-2014 Brion Vibber <brion@pobox.com>
 * http://www.mediawiki.org/
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'EmbedScript',
	'descriptionmsg' => 'embedscript-desc',
	'author'         => 'Brion Vibber',
	'url'            => 'http://www.mediawiki.org/wiki/Extension:EmbedScript'
);

$wgExtensionMessagesFiles['EmbedScript'] = dirname(__FILE__) . '/EmbedScript.i18n.php';

$wgHooks['ParserFirstCallInit'][] = 'setupEmbedScript';

$wgAutoloadClasses['EmbedScriptFunction'] = __DIR__ . '/EmbedScriptFunction.php';
$wgAutoloadClasses['JSAppletContent'] = __DIR__ . '/JSAppletContent.php';
$wgAutoloadClasses['JSAppletHandler'] = __DIR__ . '/JSAppletHandler.php';

$wgResourceModules['ext.embedscript.host'] = array(
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'EmbedScript/modules',
	'group' => 'ext.embedscript',
	'scripts' => array(
		'ext.embedscript.host.js',
	)
);

// Setup content model...
define( 'CONTENT_MODEL_JSAPPLET', 'embedscript-jsapplet' );
define( 'CONTENT_FORMAT_JSAPPLET', 'text/x-jsapplet' );
$wgContentHandlers[CONTENT_MODEL_JSAPPLET] = 'JSAppletHandler';

// https://www.mediawiki.org/wiki/Extension_default_namespaces#EmbedScript
define( 'NS_JSAPPLET', 280 );
define( 'NS_JSAPPLET_TALK', 281 );
$wgExtraNamespaces[ NS_JSAPPLET ] = 'JSApplet';
$wgExtraNamespaces[ NS_JSAPPLET_TALK ] = 'JSApplet_talk';
$wgNamespaceContentModels[ NS_JSAPPLET ] = CONTENT_MODEL_JSAPPLET; 

function setupEmbedScript( $parser ) {
	$parser->setHook( 'embedscript', array( 'EmbedScriptFunction', 'embedScriptTag') );
	return true;
}
