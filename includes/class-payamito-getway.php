<?php

class Payamito_Getway {

	private static $instance;

	private $username;
	private $password;
	private $from;

	private $send_endpoint = 'http://api.payamak-panel.com/post/Send.asmx?wsdl';
	                          

	public function __construct() {

		$connection = Payamito_Connection::instance();

		$this->username = apply_filters( 'payamito_username', $connection->username );
		$this->password = apply_filters( 'payamito_password', $connection->password );
		$this->from     = apply_filters( 'payamito_from', $connection->from );

	}

	public function send_pattern( $to, $text, $bodyid ) {

		do_action( 'payamito_before_send_pattern', $to, $text, $bodyid );

		ini_set( "soap.wsdl_cache_enabled", 0 );

		$client                   = new \SoapClient( $this->send_endpoint, [ 'exceptions' => false ] );
		$client->soap_defencoding = 'UTF-8';
		$client->decode_utf8      = true;
		$args                     = [
			"username" => $this->username,
			"password" => $this->password,
			"to"       => $to,
			"text"     => $text,
			'bodyId'   => $bodyid,
		];

		$args = apply_filters( 'payamito_send_pattern_args', $args );

		$result = $client->SendByBaseNumber( $args )->SendByBaseNumberResult;

		do_action( 'payamito_after_send_pattern', $result, $args );

	return $result;
	}

	public function send( $to, $text ) {

		do_action( 'payamito_before_send', $to, $text );

		ini_set( "soap.wsdl_cache_enabled", 0 );

		$client                   = new \SoapClient( $this->send_endpoint, [ 'exceptions' => false ] );
		$client->soap_defencoding = 'UTF-8';
		$client->decode_utf8      = true;
		$args                     = [
			"username" => $this->username,
			"password" => $this->password,
			"from"     => $this->from,
			"to"       => $to,
			"text"     => $text,
			"isflash"  => false
		];

		$args = apply_filters( 'payamito_send_args', $args );

		$result = $client->SendSimpleSMS( $args )->SendSimpleSMSResult;
		if( is_null( $result)){
		$result=-100;
		}
		do_action( 'payamito_after_send', $result, $args );

		return $result ;
	}


	public static function instance() {
		$class = static::class;

		if ( ! isset( self::$instance[ $class ] ) ) {
			self::$instance[ $class ] = new $class();
		}

		return self::$instance[ $class ];
	}

}