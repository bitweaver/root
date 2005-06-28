<?php
/**
* @package bitweaver
*/

	//ini_set('session.save_path', 'C:\somewhere\I\can\write');
	define( 'BIT_ROOT_PATH', empty($_SERVER['VHOST_DIR']) ? dirname( __FILE__ ).'/' : $_SERVER['VHOST_DIR'].'/');

	require_once( BIT_ROOT_PATH.'kernel/setup_inc.php' );
?>
