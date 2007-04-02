<?php
/**
* @version $Header: /cvsroot/bitweaver/_root/index.php,v 1.16 2007/04/02 18:54:59 squareing Exp $
* @package bitweaver
*/

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
require_once( 'bit_setup_inc.php' );

// $gBitSystem->loadLayout() needs ACTIVE_PACKAGE
if( !defined( 'ACTIVE_PACKAGE' ) || !$gBitSystem->isDatabaseValid() ) {
	installError();
}

if( !empty( $_REQUEST['content_id'] ) ) {
	if( $obj = LibertyBase::getLibertyObject( $_REQUEST['content_id'] ) ) {
		$url = $obj->getDisplayUrl();
		header( "Location: ".$url.( !empty( $_REQUEST['highlight'] ) ? '&highlight='.$_REQUEST['highlight'] : '' ) );
		die;
	}
} elseif( !empty( $_REQUEST['structure_id'] ) ) {
	include( LIBERTY_PKG_PATH.'display_structure_inc.php' );
	die;
}

$gBitThemes->loadLayout();
if( empty( $gBitThemes->mLayout[CENTER_COLUMN] )) {
	header( "location: ".$gBitSystem->getDefaultPage() );
} else {
	global $gCenterPieces;
	$gCenterPieces = array();
	if( !empty( $gBitThemes->mLayout[CENTER_COLUMN] )) {
		$gCenterPieces = $gBitThemes->mLayout[CENTER_COLUMN];
	}

	// Display the template
	$gBitSystem->display( 'bitpackage:kernel/dynamic.tpl');
}
?>
