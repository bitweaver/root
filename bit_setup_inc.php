<?php
//ini_set( 'session.save_path', 'C:\somewhere\I\can\write' );
define( 'BIT_ROOT_PATH', empty( $_SERVER['VHOST_DIR'] ) ? dirname( __FILE__ ).'/' : $_SERVER['VHOST_DIR'].'/' );
require_once( BIT_ROOT_PATH.'kernel/setup_inc.php' );

// first thing we do, is check to see if our version of bitweaver is up to date
// BIT_INSTALL is set by the installer and LOGIN_VALIDATE is set in users/validate.php
// enter the version in the form '2.1.0-beta'
if( !( defined( 'BIT_INSTALL' ) || defined( 'LOGIN_VALIDATE' )) && version_compare( '', $gBitSystem->getVersion(), '>' )) {
	$gBitSmarty->display( "bitpackage:kernel/force_installer.tpl" );
	die;
}
?>
