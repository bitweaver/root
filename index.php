<?php
/**
* @version $Header: /cvsroot/bitweaver/_root/index.php,v 1.2.2.5 2005/11/21 23:41:14 mej Exp $

* @package bitweaver
*/

// Copyright (c) 2002-2003, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// this has to be checked first thing since safe_mode screws up everything
// to run bitweaver with safe_mode on, you should remove the following lines
//if( ini_get( 'safe_mode' ) ) {
//	echo '
//		<h1>Safe Mode check</h1>
//		We have detected that your server has <b>safe_mode</b> set to <b>on</b>.<br />
//		If you have access to the php.ini file or your service provider is willing, we recommend that you change this setting to <b>off</b><br />
//		To get bitweaver working with safe_mode active please click <a href="peartest.php">here</a>.<br />
//	';
//	die;
//}
require_once ('bit_setup_inc.php');

//vd( $_COOKIE );
//vd( $_SESSION );
global $gBitSystem, $gBitSmarty;

// $gBitSystem->loadLayout() needs ACTIVE_PACKAGE
if (!defined('ACTIVE_PACKAGE')) {
	installError();
}

if( !empty( $_REQUEST['content_id'] ) ) {
	if( $obj = LibertyBase::getLibertyObject( $_REQUEST['content_id'] ) ) {
		$url = $obj->getDisplayUrl();
		header( "Location: $url" );
		die;
	}
} elseif ( !empty( $_REQUEST['structure_id'] ) ) {
	include( LIBERTY_PKG_PATH.'display_structure_inc.php' );
	die;
}
$gBitSystem->loadLayout();
if( !$gBitSystem->isDatabaseValid() ) {
	installError();
} elseif( isset($bitIndex) || empty( $gBitSystem->mLayout[CENTER_COLUMN] ) ) {
	header ("location: ".$gBitSystem->getDefaultPage());
} else {

	global $gCenterPieces;
	$gCenterPieces = array();
	foreach( array_keys( $gBitSystem->mLayout ) as $key ) {
		if( $key == CENTER_COLUMN ) {
			for( $i = 0; $i < count( $gBitSystem->mLayout[$key] ); $i++ ) {
				array_push( $gCenterPieces, 'bitpackage:'.$gBitSystem->mLayout[$key][$i]['module_rsrc'] );
			}
		}
	}
	$gBitSmarty->assign_by_ref( 'gCenterPieces', $gCenterPieces );

	// Display the template
	$gBitSystem->display( 'bitpackage:kernel/dynamic.tpl');
	//$gBitSmarty->display("bitweaver.tpl");
}
?>
