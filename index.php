<?php
/**
 * @version $Header: /cvsroot/bitweaver/_root/index.php,v 1.22 2007/05/30 21:07:27 spiderr Exp $
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
if( !$gBitSystem->isDatabaseValid() ) {
	install_error();
} elseif( !defined( 'ACTIVE_PACKAGE' )) {
	$bit_index = $gBitSystem->getConfig( 'bit_index' );
	if( in_array( $bit_index, array_keys( $gBitSystem->mPackages )) && defined( strtoupper( $bit_index ).'_PKG_PATH' )) {
		define( 'ACTIVE_PACKAGE', constant( strtoupper( $bit_index ).'_PKG_NAME' ));
	} else {
		define( 'ACTIVE_PACKAGE', KERNEL_PKG_NAME );
		unset( $bit_index );
	}
}

if( !empty( $_REQUEST['content_id'] )) {
	if( $obj = LibertyBase::getLibertyObject( $_REQUEST['content_id'] )) {
		bit_redirect( $obj->getDisplayUrl().( !empty( $_REQUEST['highlight'] ) ? '&highlight='.$_REQUEST['highlight'] : '' ));
	}
} elseif( !empty( $_REQUEST['structure_id'] )) {
	include( LIBERTY_PKG_PATH.'display_structure_inc.php' );
	die;
}

$gBitThemes->loadLayout();
// Redirectless home for packages
if( !empty( $bit_index )) {
	chdir( BIT_ROOT_PATH.$bit_index );
	include_once( './index.php' );
die;
}

bit_redirect( $gBitSystem->getDefaultPage() );
?>
