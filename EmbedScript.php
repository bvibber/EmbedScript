<?php

/*
 * Copyright (C) 2011 Brion Vibber <brion@pobox.com>
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

$wgAutoloadClasses['EmbedScriptFunction'] =
	dirname(__FILE__) . '/EmbedScriptFunction.php';

$wgResourceModules['ext.embedscript.host'] = array(
	'localBasePath' => dirname( __FILE__ ) . '/modules',
	'remoteExtPath' => 'EmbedScript/modules',
	'group' => 'ext.embedscript',
	'scripts' => array(
		'ext.embedscript.host.js',
	)
);


$egEmbedScriptSandbox = 'http://embed-sandbox.wmflabs.org/';


function setupEmbedScript( $parser ) {
	$parser->setHook( 'embedscript', array( 'EmbedScriptFunction', 'embedScriptTag') );
	return true;
}
