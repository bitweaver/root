<?php
/**
 * this file is deprecated and slated for delete
 * use: require_once( '../kernel/setup_inc.php' ); instead of require_once( '../kernel/setup_inc.php' );
 **/
$rootPath = empty( $_SERVER['VHOST_DIR'] ) ? dirname( __FILE__ ).'/' : $_SERVER['VHOST_DIR'].'/';
require_once( $rootPath.'kernel/setup_inc.php' );

$out = "Deprecated file require_once call:\n\tfile: bit_setup_inc.php\n\tuse \"require_once( '../kernel/bit_setup_inc.php' );\"\n\tBacktrace to require_once source:\n\t";
$out .= bt( 1, FALSE );
if( !defined( 'IS_LIVE' ) || IS_LIVE == FALSE ) {
	vd( $out );
} else {
	error_log( $out );
}
