<?php

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WP_Nice_Scroll_Settings' ) ):
class WP_Nice_Scroll_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WP_Nice_Scroll_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'WP Nice Scroll Settings', 'WP Nice Scroll Settings', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wp_nice_scroll_section',
                'title' => __( 'WP Nice Scroll Settings' )
            ),
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wp_nice_scroll_section' => array(
                array(
                    'name'    => 'nice_scroll_enable',
                    'label'   => __( 'Enable Nice Scroll' ),
                    'desc'    => __( 'To enable nice scroll just select enable.' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Enable',
                        'no'  => 'Disable'
                    )
                ),
				array(
                    'name'    => 'scrollbar_bg_color',
                    'label'   => __( 'Scrollbar Background' ),
                    'desc'    => __( 'Choose a background color.' ),
                    'type'    => 'color',
                    'default' => ''
                ),
				array(
                    'name'    => 'scrollbar_cursor_bg',
                    'label'   => __( 'Scrollbar Cursor Background' ),
                    'desc'    => __( 'Choose a background color.' ),
                    'type'    => 'color',
                    'default' => '#424242'
                ),
				array(
                    'name'              => 'scrollbar_width',
                    'label'             => __( 'Scrollbar Width' ),
                    'desc'              => __( 'Enter scrollbar width' ),
                    'type'              => 'number',
                    'default'           => '8',
                    'sanitize_callback' => 'intval'
                ),
				array(
                    'name'              => 'scrollbar_radius',
                    'label'             => __( 'Scrollbar Cursor Radius' ),
                    'desc'              => __( 'Enter scrollbar radius' ),
                    'type'              => 'number',
                    'default'           => '3',
                    'sanitize_callback' => 'intval'
                ),
				array(
                    'name'    => 'nice_scroll_auto_hide',
                    'label'   => __( 'Enable Nice Scroll Auto Hide Mode' ),
                    'desc'    => __( 'Select a option.' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Enable',
                        'no'  => 'Disable'
                    )
                ),
				array(
                    'name'              => 'scroll_speed',
                    'label'             => __( 'Scrollbar Speed' ),
                    'desc'              => __( 'Enter scrollbar speed' ),
                    'type'              => 'number',
                    'default'           => '60',
                    'sanitize_callback' => 'intval'
                ),
				array(
                    'name'              => 'hide_curson_delay',
                    'label'             => __( 'Scrollbar Hide Cursor Delay' ),
                    'desc'              => __( 'Enter scrollbar hide cursor delay' ),
                    'type'              => 'number',
                    'default'           => '400',
                    'sanitize_callback' => 'intval'
                ),
            ),
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
