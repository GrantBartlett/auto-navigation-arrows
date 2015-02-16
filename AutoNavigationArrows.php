<?php

/***
 * Auto Navigation Arrows
 *
 * @package: Auto_Navigation_Arrows
 * @author Grant Bartlett <grant@smswmedia.com>
 * @license: MIT
 * @link: http://smswmedia.com
 * @copyright: 2015 SMSW Media LTD
 *
 * @wordpress-plugin
 * Plugin Name: Auto Navigation Arrows
 * Description: This plugin will generate previous and next navigation arrows on the current page
 * Version: 1.0.0
 * Author: Grant Bartlett
 * Author URI: http://grant-bartlett.com
 * Text Domain: auto-navigation-arrows
 * GitHub Plugin URI: @TODO
 *
 */

class AutoNavigationArrows extends WP_Widget {

    protected $widgetClass = 'Auto_Navigation_Arrows';
    protected $widgetName = 'Auto Navigation Arrows';

    private $widgetDesc = 'This plugin will generate previous and next navigation arrows on active page';
    private $widgetSlug = 'auto-navigation-arrows';
    private $arrayOfPages = [];
    private $configureLinks = [];



    /**
     * Constructor
     *
     * Specifies class name, description and instantiates the widget.
     *
     */
    public function __construct() {

        // Load plugin text domain
        add_action( 'init', array( $this, 'widgetTextDomain' ) );

        // Extend WP_WIDGET Constructor
        parent::__construct(
            $this->getWidgetClass(),
            __( $this->getWidgetName(), $this->getWidgetSlug() ),

            array(
                'classname'   => $this->getWidgetSlug() . '-class',
                'description' => __( $this->getWidgetDesc(), $this->getWidgetSlug() )
            )
        );

        // @TODO: Register admin styles and scripts

        // @TODO: Register site styles and scripts

        // @TODO: Refresh cached output

    }




    /**
     * Outputs the content of the Widget
     *
     * WordPress Widget API
     *
     * @param array $args - The array of form elements
     * @param array $instance - The current instance of the widget
     */
    public function widget( $args, $instance ){

        echo $args['before_widget'];


        include( plugin_dir_path(__FILE__) . 'views/widget.php' );


        echo $args['after_widget'];

    }




    /**
     * Processes the widgets options to be saved
     *
     * WordPress Widget API
     *
     * @param array $new_instance - The new instance of values to be generated via the update.
     * @param array $old_instance - The previous instane of values before the update.
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ){
        $instance = $old_instance;

        return $instance;
    }





    /**
     * Generates the admin form for the widget
     *
     * WordPress Widget API
     *
     */
    public function form( $instance ) {
        return $instance;
    }





    /**
     * Register Widget Text Domain
     */
    public function widgetTextDomain() {
        load_plugin_textdomain( $this->getWidgetSlug(), false, plugin_dir_path( __FILE__ ) . 'lang/' );
    }

    /**
     * @param array $configureLinks
     */
    public function setConfigureLinks( $configureLinks ) {
        $pageIdsArray = array();

        // Take arguments set by @getArrayOfPages
        foreach ( $this->getArrayOfPages( $configureLinks ) as $page ) {
            $pageIdsArray[] += $page->ID;
        }
        $this->configureLinks = $pageIdsArray;
    }

    /**
     * @return array
     */
    public function getConfigureLinks() {
        return $this->configureLinks;
    }

    /**
     * @return array
     */
    public function getArrayOfPages($arrayOfPages) {
        return $this->arrayOfPages = get_pages( $arrayOfPages );
    }

    /**
     * Widget Name
     * @return string
     */
    public function getWidgetName() {
        return $this->widgetName;
    }

    /**
     * @return string
     */
    public function getWidgetClass() {
        return $this->widgetClass;
    }

    /**
     * Widget Description
     * @return string
     */
    public function getWidgetDesc() {
        return $this->widgetDesc;
    }

    /**
     * Widget Slug
     * @return string
     */
    public function getWidgetSlug() {
        return $this->widgetSlug;
    }

}

add_action( 'widgets_init', create_function( '', 'register_widget("AutoNavigationArrows");' ) );