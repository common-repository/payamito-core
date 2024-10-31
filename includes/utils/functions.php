<?php

if ( ! function_exists( 'payamito_options' ) ) {
	function payamito_options( $option = '', $default = '' ) {

		$options = get_option( 'payamito' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

if ( ! function_exists( 'payamito_send' ) ) {

	function payamito_send( $to, $text ) {
		return Payamito_Getway::instance()->send( $to, $text );
	}

}
if ( ! function_exists( 'payamito_send_pattern' ) ) {

	function payamito_send_pattern( $to, $text, $bodyid ) {
		return Payamito_Getway::instance()->send_pattern( $to, $text, $bodyid );
	}
}