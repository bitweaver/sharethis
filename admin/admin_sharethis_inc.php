<?php
// Copyright (c) 2008 Tekimaki LCC
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

/* options supported by ShareThis widget that we can set via our javascript include */
// button style stored as pref: sharethis_style_button
$formButtonStylesOptions = array(
	'default' => '<img src="http://sharethis.com/images/share-icon-16x16.png"> ShareThis Icon',
	'rotate' => '<img src="http://sharethis.com/images/rotating-icon2.gif"> Rotating Icons',
);
$gBitSmarty->assign( 'formButtonStylesOptions', $formButtonStylesOptions );

// tab options
$formTabStylesOptions = array(
	'sharethis_style_tab_web' => array(
		'label' => 'Social Web',
		'type' => 'toggle',
	),
	'sharethis_style_tab_post' => array(
		'label' => 'Post',
		'type' => 'toggle',
	),
	'sharethis_style_tab_email' => array(
		'label' => 'Send Email',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formTabStylesOptions', $formTabStylesOptions );

// color options
$formColorStylesOptions = array(
	'sharethis_style_color_linkfg' => array(
		'label' => 'Body Links',
		'note' => '',
		'type' => 'input',
		'default' => '#006633',
	),
	'sharethis_style_color_headerbg' => array(
		'label' => 'Header Background',
		'note' => '',
		'type' => 'input',
		'default' => '#999999',
	),
	'sharethis_style_color_inactivebg' => array(
		'label' => 'Inactive Tab Background',
		'note' => '',
		'type' => 'input',
		'default' => '#d2d2d2',
	),
	'sharethis_style_color_inactivefg' => array(
		'label' => 'Inactive Tab Text',
		'note' => '',
		'type' => 'input',
		'default' => '#424242',
	),
);
$gBitSmarty->assign( 'formColorStylesOptions', $formColorStylesOptions );
/* end widge style options */


// bitweaver display options
$formServiceOptions = array(
	'sharethis_nav' => array(
		'label' => 'ShareThis in "nav"',
		'note' => 'Displays the sharethis in the "nav" section of each page, above the body text. Visible only when the full content page is loaded',
		'type' => 'toggle',
	),
	'sharethis_view' => array(
		'label' => 'ShareThis in "view"',
		'note' => 'Displays the sharethis in the "view" section of each page, below the body text. Visible only when the full content page is loaded.',
		'type' => 'toggle',
	),
	'sharethis_icon' => array(
		'label' => 'ShareThis in "icons"',
		'note' => 'Displays the sharethis in the "icons" section of each page. Visible both in listings and when the full content page is loaded.',
		'type' => 'toggle',
	),
	'sharethis_body' => array(
		'label' => 'ShareThis in "body"',
		'note' => 'Displays the sharethis in the "body" section of each page, below the body text. Visible both in listings and when the full content page is loaded.',
		'type' => 'toggle',
	),
);
$gBitSmarty->assign( 'formServiceOptions', $formServiceOptions );

// allow selection of what packages display sharethis box
$exclude = array( 'bituser', 'tikisticky', 'pigeonholes' );
foreach( $gLibertySystem->mContentTypes as $cType ) {
	if( !in_array( $cType['content_type_guid'], $exclude ) ) {
		$formContentTypes['guids']['sharethis_'.$cType['content_type_guid']]  = $cType['content_description'];
	}
}

// store the prefs
if( !empty( $_REQUEST['sharethis_preferences'] ) ) {
	$gBitSystem->storeConfig( 'sharethis_api_key', $_REQUEST['sharethis_api_key'], SHARETHIS_PKG_NAME );

	$gBitSystem->storeConfig( 'sharethis_style_button', $_REQUEST['sharethis_style_button'], SHARETHIS_PKG_NAME );

	$formFeatures = array_merge( $formServiceOptions, $formTabStylesOptions, $formColorStylesOptions );

	foreach( $formFeatures as $item => $data ) {
		if( $data['type'] == 'numeric' ) {
			simple_set_int( $item, SHARETHIS_PKG_NAME );
		} elseif( $data['type'] == 'toggle' ) {
			simple_set_toggle( $item, SHARETHIS_PKG_NAME );
		} elseif( $data['type'] == 'input' ) {
			simple_set_value( $item, SHARETHIS_PKG_NAME );
		}
	}

	/*
	foreach( $formTabStylesOptions as $key => $params ) {
		$gBitSystem->storeConfig( $key, ( !empty( $_REQUEST[$key] ) ? $params['value'] : NULL ), SHARETHIS_PKG_NAME );
	}
	 */

	foreach( array_keys( $formContentTypes['guids'] ) as $val ) {
		$gBitSystem->storeConfig( $val, ( ( !empty( $_REQUEST['sharethis_content'] ) && in_array( $val, $_REQUEST['sharethis_content'] ) ) ? 'y' : NULL ), SHARETHIS_PKG_NAME );
	}
}


// check the correct packages in the package selection
foreach( $gLibertySystem->mContentTypes as $cType ) {
	if( $gBitSystem->getConfig( 'sharethis_'.$cType['content_type_guid'] ) ) {
		$formContentTypes['checked'][] = 'sharethis_'.$cType['content_type_guid'];
	}
}
$gBitSmarty->assign( 'formContentTypes', $formContentTypes );

// reset the styles hash in the system - otherwise preview will contain old styles
if( isset( $gSharethisSystem->mStyles ) ){
	unset($gSharethisSystem->mStyles);
}
$gSharethisSystem->getStyles();

