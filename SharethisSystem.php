<?php
/**
 * $Header: /cvsroot/bitweaver/_bit_sharethis/SharethisSystem.php,v 1.3 2009/03/31 08:19:02 lsces Exp $
 * @package sharethis
 */

/**
 * @package sharethis
 */
class SharethisSystem {

	// master list of all possible style kernel configs, this list matches options in admin_sharethis_inc.php
	var $mStyleOptions;

	// active styles
	var $mStyles;

	function SharethisSystem() {
		$this->mStyleOptions = array(
			'button' => array(
				'sharethis_style_button'
			),
			'tabs' => array(
				'sharethis_style_tab_web',
				'sharethis_style_tab_post',
				'sharethis_style_tab_email',
			),
			'colors' => array(
				'sharethis_style_color_linkfg',
				'sharethis_style_color_headerbg',
				'sharethis_style_color_inactivebg',
				'sharethis_style_color_inactivefg',
			),
		);
	}

	/**
	 * assembles a hash of active style settings
	 * this provides a simple hash the tpl can easily
	 * loop over to assemble the request to the 
	 * sharethis service
	 **/
	function getStyles(){
		if( !isset( $this->mStyles ) ){
			global $gBitSystem;

			foreach( $this->mStyleOptions as $type => $options ){
				foreach ( $options as $val ){
					if( $gBitSystem->getConfig( $val ) && $gBitSystem->getConfig( $val ) != "n" ){
						$this->mStyles[$type][$val] = $gBitSystem->getConfig( $val );
					}
				}
			}
		}
		
		return $this->mStyles;
	}

	function isShareable( &$pServiceHash ){
		global $gBitSystem;
		if ( !empty( $pServiceHash['content_type_guid'] ) ) {
			return $gBitSystem->isFeatureActive( 'sharethis_'.$pServiceHash['content_type_guid'] );
		}
		return false;
	}
}
