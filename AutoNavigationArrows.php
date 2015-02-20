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
 * GitHub Plugin URI: https://github.com/GrantBartlett/auto-navigation-arrows
 *
 */
class AutoNavigationArrows extends WP_Widget {

    /**
     * Widget variables
     * @var string
     */
    private $widgetClass = 'Auto_Navigation_Arrows';
    private $widgetName = 'Auto Navigation Arrows';
    private $widgetDesc = 'This plugin will generate previous and next navigation arrows on active page';
    private $widgetSlug = 'auto-navigation-arrows';

    /**
     * Stores output of @get_pages() WordPress method
     * @var array
     */
    private $arrayOfPages = [];

    /**
     * Stores page IDs only
     * @var array
     */
    private $configureLinks = [];

    /**
     * Stores previous/next array ids
     * @var array
     */
    private $prevNextLinks = [];


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
    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );

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
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        return $instance;
    }

    /**
     * Generates the admin form for the widget
     *
     * WordPress Widget API
     *
     * @param array $instance
     *
     * @return array
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
        // Take arguments set by getArrayOfPages
        foreach ( $this->getArrayOfPages( $configureLinks ) as $page ) {
            $this->configureLinks[] += $page->ID;
        }
    }

    /**
     * @return array
     */
    private function getConfigureLinks() {
        return $this->configureLinks;
    }

    /**
     * Stores previous and next page IDs based on setConfigureLinks() arguments
     * @return array
     */
    public function getPrevNextLinks() {
        // Find current pay key in pageIdArray
        $pageKeyCurrent = array_search( get_the_ID(), $this->getConfigureLinks() );

        $prevNextLinks['previous'] = $this->getConfigureLinks()[ $pageKeyCurrent - 1 ];
        $prevNextLinks['next'] = $this->getConfigureLinks()[ $pageKeyCurrent + 1 ];

        return $prevNextLinks;
    }

    /**
     * @return array
     */
    private function getArrayOfPages( $arrayOfPages ) {
        return $this->arrayOfPages = get_pages( $arrayOfPages );
    }

    /**
     * Widget Name
     * @return string
     */
    private function getWidgetName() {
        return $this->widgetName;
    }

    /**
     * @return string
     */
    private function getWidgetClass() {
        return $this->widgetClass;
    }

    /**
     * Widget Description
     * @return string
     */
    private function getWidgetDesc() {
        return $this->widgetDesc;
    }

    /**
     * Widget Slug
     * @return string
     */
    private function getWidgetSlug() {
        return $this->widgetSlug;
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget("AutoNavigationArrows");' ) );