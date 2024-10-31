<?php
/**
 * Plugin Name: Nemesis All-in-One
 * Plugin URI: https://fbtemplates.net/
 * Description: The All in One Elementor Widget for Building Newspaper and Magazine Blocks
 * Author: fbtemplates
 * Version: 1.0.9
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Author URI: https://fbtemplates.net/
 * Text Domain: nemesis
 * Domain Path: /languages
 */

namespace Nemesis;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

final class Nemesis_Newspaper_Builder {

	const VERSION = '1.0.9';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.4';
	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		$this->defined_constants();
		$this->include_files();
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public function defined_constants() {
		define( 'NEMESIS_ALL_IN_ONE_SLUG', 'nemesis-all-in-one' );
		define( 'NEMESIS_ALL_IN_ONE_VERSION', '1.0.9' );
		define( 'NEMESIS_ALL_IN_ONE_PATH', plugin_dir_path( __FILE__ ) );
	    define( 'NEMESIS_ALL_IN_ONE_URL', plugin_dir_url( __FILE__ ) ) ;
	    define( 'NEMESIS_ALL_IN_ONE_PRO_LINK', 'https://1.envato.market/BXGoLJ' ) ; //Pro Link
	}

	public function i18n() {
		load_plugin_textdomain( 'nemesis' );
	}

	public function include_files() {
		if( is_admin() ) {
			require_once( NEMESIS_ALL_IN_ONE_PATH . 'admin/admin-page.php' );
		}
	}

	public function init() {

		add_image_size( 'nemesis-grid-posts', 600, 400, true );
        add_image_size( 'nemesis-large-thumb', 1024, 683, true );
		
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		
		// Add the widget category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_grid_widgets' ] );
		
		// Register styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_scripts' ] );
		
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
	
	}
	
	public function add_elementor_grid_widgets( $elements_manager ) {
        $elements_manager->add_category(
            'nemesis-all-in-one-widgets',
            [
                'title' => __( 'Nemesis All-in-One', 'nemesis' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'nemesis' ),
			'<strong>' . esc_html__( 'Nemesis All-in-One', 'nemesis' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'nemesis' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nemesis' ),
			'<strong>' . esc_html__( 'Nemesis All-in-One', 'nemesis' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'nemesis' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'nemesis' ),
			'<strong>' . esc_html__( 'Nemesis All-in-One', 'nemesis' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'nemesis' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/post-grids.php' );
		
		// Register widget		
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Nemesis_Posts_Grids() );
		
	}
	
	public function register_scripts() {

		wp_enqueue_style( 'nemesis-bs-styles', NEMESIS_ALL_IN_ONE_URL . '/assets/bootstrap/bootstrap-grid.min.css' );
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'nemesis-elementor-styles', NEMESIS_ALL_IN_ONE_URL . '/assets/css/style.css', array(), NEMESIS_ALL_IN_ONE_VERSION, 'all' );

    }

}
Nemesis_Newspaper_Builder::instance();