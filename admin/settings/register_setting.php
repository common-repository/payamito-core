<?php

namespace payamito\admin;

use CSF;

class register_setting {

	private static $instance;
	protected $prefix = 'payamito';


	private function __construct() {

		$this->prefix = 'payamito';

		$this->load_framwork();
		$this->create_options();
	}

	private function load_framwork() {
		require_once PAYAMITO_ADMIN . 'lib/codestar-framework/codestar-framework.php';
	}

	private function create_options() {

		if ( class_exists( 'CSF' ) ) {

			CSF::createOptions( $this->prefix, [
				'framework_title'    => 'پیامیتو',
				'menu_title'         => 'پیامیتو',
				'menu_slug'          => 'payamito',
				'theme'              => 'light',
				'menu_icon'          => 'dashicons-bell',
				'menu_position'      => '2',
				'show_sub_menu'      => false,
				'show_reset_section' => false,
				'show_reset_all'     => false,
			] );
			CSF::createSection( $this->prefix, $this->default_section() );
		}
		$this->init_custom_section();
	}

	/**
	 * default options menu
	 * other addons can not edite default optopns
	 *
	 * @return array
	 * @since             1.1.0
	 * @author            payamito
	 */
	private function default_section() {

		return [
			'title'  => esc_html__( 'General Options', 'payamito' ),
			'fields' => [
				[
					'id'    => 'username',
					'type'  => 'text',
					'title' => esc_html__( 'Username', 'payamito' ),
					'help'  => esc_html__( 'Username in payamito website', 'payamito' ),
				],
				[
					'id'    => 'password',
					'type'  => 'text',
					'title' => esc_html__( 'Password', 'payamito' ),
					'help'  => esc_html__( 'Password in payamito website', 'payamito' )
				],

				[
					'id'    => 'SMS_line_number',
					'type'  => 'text',
					'title' => esc_html__( 'SMS line number', 'payamito' ),
					'help'  => esc_html__( 'SMS line number. If you do not know, call support', 'payamito' )
				],
			]
		];
	}

	/**
	 * add custom menu
	 * other addons can edite this function
	 *
	 * @return void
	 * @since             1.1.0
	 * @author            payamito
	 * @support           code star framework field types
	 * https://codestarframework.com/documentation/#/fields
	 */
	public function init_custom_section() {
		$sections = apply_filters( 'payamito_add_section', [] );
		if ( ! is_array( $sections ) || is_null( $sections ) ) {
			return;
		}
		foreach ( $sections as $se ) {
			if ( empty( $se['title'] || empty( $se['fields'] ) ) ) {
				continue;
			}
			CSF::createSection( $this->prefix, $se );
		}
	}

	/**
	 * Returns an instance of this class.
	 *
	 * @return $this
	 * @since  1.0
	 * @access static
	 */
	public static function instance() {
		$class = static::class;

		if ( ! isset( self::$instance[ $class ] ) ) {
			self::$instance[ $class ] = new $class();
		}

		return self::$instance[ $class ];
	}
}
