<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( ! class_exists( 'Nemesis_All_in_One' ) ) {

    class Nemesis_All_in_One {

        function register() {

            add_action( 'admin_enqueue_scripts', array( $this, 'nemesis_admin_scripts' ) );
            add_action( 'admin_menu', array( $this, 'nemesis_admin_menu' ) );

        }

        public function nemesis_admin_menu() {

            global $submenu;

            add_menu_page( 
                __('Nemesis All in One', 'nemesis'),
                __('Nemesis', 'nemesis'),
                'edit_posts',
                NEMESIS_ALL_IN_ONE_SLUG,
                [ $this, 'nemesis_admin_index' ],
                NEMESIS_ALL_IN_ONE_URL . 'images/navigation.png',
                '58.5'
            );

            add_submenu_page(  
                NEMESIS_ALL_IN_ONE_SLUG,
                __('Nemesis All in One', 'nemesis'), 
                __('Welcome', 'nemesis'),
                'edit_posts',
                NEMESIS_ALL_IN_ONE_SLUG,
                [ $this, 'nemesis_admin_index' ]
            );

            add_submenu_page(  
                NEMESIS_ALL_IN_ONE_SLUG,
                __('Premium Layouts', 'nemesis'), 
                __('Premium Layouts', 'nemesis'),
                'edit_posts',
                'pro-layouts-registrations', 
                [ $this, 'fbt_pro_layouts' ]
            ); 

            $link_text = '<span class="nemesis-pro-link" style="font-weight: bold; color: #EE1C5D"><span class="dashicons dashicons-star-filled" style="font-size: 16px"></span> Go Pro</span>';
	        $submenu[ NEMESIS_ALL_IN_ONE_SLUG ][2] = array( $link_text, 'manage_options' , NEMESIS_ALL_IN_ONE_PRO_LINK );
	        return $submenu;
        
        }

        public function nemesis_admin_index() {

            require_once( plugin_dir_path( __FILE__ ) . 'templates/admin.php' );

        }

        public function fbt_pro_layouts() {

            require_once( plugin_dir_path( __FILE__ ) . 'templates/premium-layouts.php' );

        }

        function nemesis_admin_scripts() {

            wp_enqueue_style( 'nemesis-admin-styles', plugins_url( '/assets/css/admin-styles.css', __FILE__ ) );
            wp_enqueue_script( 'nemesis-admin-scripts', plugins_url( '/assets/js/admin-scripts.js', __FILE__ ), array( 'jquery' ), NEMESIS_ALL_IN_ONE_VERSION, true );

        }

    }

    $nemesisAllinOne = new Nemesis_All_in_One();
    $nemesisAllinOne->register();

}