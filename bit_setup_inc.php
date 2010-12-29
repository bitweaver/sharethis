<?php
/**
 * base package include
 *
 * @author   Tekimaki LCC <will@tekimaki.com>
 * @version  $Revision$
 * @package  sharethis
 */

$registerHash = array(
	'package_name' => 'sharethis',
	'package_path' => dirname( __FILE__ ).'/',
	'service' => 'sharethis',
);
$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'sharethis' ) ) {
	$gLibertySystem->registerService( 'sharethis', SHARETHIS_PKG_NAME, array(
		'content_nav_tpl'  => 'bitpackage:sharethis/service_content_nav_inc.tpl',
		'content_icon_tpl' => 'bitpackage:sharethis/service_content_icon_inc.tpl',
		'content_body_tpl' => 'bitpackage:sharethis/service_content_body_inc.tpl',
		'content_view_tpl' => 'bitpackage:sharethis/service_content_view_inc.tpl',
		));

	require_once(SHARETHIS_PKG_PATH."SharethisSystem.php");
	global $gSharethisSystem;

	// Initialize system
	if ( empty( $gSharethisSystem ) ) {
		$gSharethisSystem = new SharethisSystem();
		$gSharethisSystem->getStyles();
		$gBitSmarty->assign_by_ref('gSharethisSystem', $gSharethisSystem);
	}
}

