<?php

namespace plugins\goo1\elementor\mediasite;

class core {

    public static function init() {

        add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {
            $elements_manager->add_category(
                'goo1mediasite',
                [
                    'title' => esc_html__( 'goo1 Mediasite', 'plugin-name' ),
                    'icon' => 'eicon-gallery-grid',
                ]
            );
        });

        add_action( 'elementor/widgets/widgets_registered', function() {
            /*\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \plugins\goo1\elementorwidgets\elementor\widgets\Breadcrumbs() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \plugins\goo1\elementorwidgets\elementor\widgets\Heading() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \plugins\goo1\elementorwidgets\elementor\widgets\Jitsi() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \plugins\goo1\elementorwidgets\elementor\widgets\Calendly() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \plugins\goo1\elementorwidgets\elementor\widgets\ToggleButton() );*/
        });

        add_action("wp_head", function() {
            echo('<meta name="supportedby" content="Andreas Kasper"/>');
        });
    }
}
