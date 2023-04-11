<?php

if (!defined('ABSPATH')) {
    exit;
}

class goo1_ElementorRestrictContent {

    public function __construct() {
        //add_action('elementor/element/common/_section_style/after_section_end', [$this, 'content_protection'], 10);
        add_action('elementor/element/common/_section_style/after_section_end', [$this, "initeditor"], 10);
        add_action('elementor/widget/render_content', [$this, 'prerender'], 10, 2 );
    }

function initeditor($element) {
    global $wpdb, $wp_roles;
        $element->start_controls_section(
            'goo1_ElementorRestrictContent_section',
            [
                'label' => "goo1 Content Protection",
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
			'goo1_ElementorRestrictContent_enabled',
			[
				'label' => __( 'enabled', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'enabled', 'your-plugin' ),
				'label_off' => __( 'disabled', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_isloggedin',
			[
				'label' => __( 'is logged in', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'your-plugin' ),
				'label_off' => __( 'no', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_byUserRole',
			[
				'label' => __( 'by User Role', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'your-plugin' ),
				'label_off' => __( 'no', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $all_roles = $wp_roles->roles;
        foreach ($all_roles as $k => $v) {
            $element->add_control(
                'goo1_ElementorRestrictContent_role_'.$k,
                [
                    'label' => $v["name"],
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'yes', 'your-plugin' ),
                    'label_off' => __( 'no', 'your-plugin' ),
                    'return_value' => "yes",
                    'default' => 'no',
                    'condition' => [
                        "goo1_ElementorRestrictContent_enabled" => "yes",
                        "goo1_ElementorRestrictContent_byUserRole" => "yes"
                    ]
                ]
            );
        }

        $element->add_control(
			'goo1_ElementorRestrictContent_byWooCommerceProduct',
			[
				'label' => __( 'by WooCommerce Product', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'your-plugin' ),
				'label_off' => __( 'no', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $repeater = new \Elementor\Repeater();

		$rows = $wpdb->get_results( $wpdb->prepare('SELECT ID, post_title FROM '.$wpdb->posts.' WHERE post_type IN ("product","product_variation")  ORDER BY post_title ASC',array()), ARRAY_A );

		$w = array();
		foreach($rows as $row) {
			$w[$row["ID"]] = $row["post_title"]." [".$row["ID"]."]";
		}
		
        
        $repeater->add_control(
			'pid',
			[
				'label' => __( '', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $w,
				'placeholder' => __( '', 'plugin-name' ),
			]
		);

		/*$a = $this->get_settings_for_display("wcpids");
		print_r($a);

		$product = wc_get_product( id );
		$pt = $product->get_title();*/
		
		$element->add_control(
			'goo1_ElementorRestrictContent_products',
			[
				'label' => __( 'Woocommerce Products', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => 'PID: {{{ pid }}}',
				'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_byWooCommerceProduct" => "yes"
				],
			]
		);

        /*$element->add_control(
            'eael2_ext_content_protection_pro_required',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => $this->teaser_template([
                    'title' => __('Meet EA Content Protection', 'essential-addons-for-elementor-lite'),
                    'messages' => __('Put a restriction on any of your content and protect your privacy.', 'essential-addons-for-elementor-lite'),
                ]),
            ]
        );*/


        $element->add_control(
			'goo1_ElementorRestrictContent_inverse',
			[
				'label' => __( 'inverse', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'your-plugin' ),
				'label_off' => __( 'no', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementtype',
			[
				'label' => __( 'Content if blocked', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => __( 'none', 'plugin-domain' ),
					'template' => __( 'Elementor Template', 'plugin-domain' ),
					'wysiwyg' => __( 'WYSIWYG Editor', 'plugin-domain' ),
					'shortcode' => __( 'Shortcode', 'plugin-domain' )
				],
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        
        $rows = $wpdb->get_results( $wpdb->prepare('SELECT ID, post_title FROM '.$wpdb->posts.' WHERE post_type IN ("elementor_library")  ORDER BY post_title ASC',array()), ARRAY_A );

		$rows_templates = array();
		foreach($rows as $row) {
			$rows_templates[$row["ID"]] = $row["post_title"];
		}

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementtemplate',
			[
				'label' => __( 'Template', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $rows_templates,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_replacementtype" => "template"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementwysiwyg',
			[
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Type your replacement text here', 'plugin-domain' ),
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_replacementtype" => "wysiwyg"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementshortcode',
			[
				'label' => __( 'Shortcode', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 2,
				'placeholder' => __( 'Type your shortcode here', 'plugin-domain' ),
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_replacementtype" => "shortcode"
                ]
			]
		);

        $element->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        /*$element->add_control(
			'goo1_ElementorRestrictContent_dtvonenabled',
			[
				'label' => __( 'von enabled', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'enabled', 'your-plugin' ),
				'label_off' => __( 'disabled', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);*/

        $element->add_control(
			'goo1_ElementorRestrictContent_dtvon',
			[
				'label' => __( 'Startzeit', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementtypevon',
			[
				'label' => __( 'Content if blocked', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => __( 'none', 'plugin-domain' ),
                    'default'  => __( 'default block', 'plugin-domain' ),
					'template' => __( 'Elementor Template', 'plugin-domain' ),
					'wysiwyg' => __( 'WYSIWYG Editor', 'plugin-domain' ),
					'shortcode' => __( 'Shortcode', 'plugin-domain' )
				],
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_dtvon!" => ""
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_blockvontemplates',
			[
				'label' => __( 'Template', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $rows_templates,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_dtvon!" => "",
                    "goo1_ElementorRestrictContent_replacementtypevon" => "template"
                ]
			]
		);

        /*$element->add_control(
			'goo1_ElementorRestrictContent_dtbisenabled',
			[
				'label' => __( 'bis enabled', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'enabled', 'your-plugin' ),
				'label_off' => __( 'disabled', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);*/

        $element->add_control(
			'goo1_ElementorRestrictContent_dtbis',
			[
				'label' => __( 'Endzeit', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes"
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_replacementtypebis',
			[
				'label' => __( 'Content if blocked', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => __( 'none', 'plugin-domain' ),
                    'default'  => __( 'default block', 'plugin-domain' ),
					'template' => __( 'Elementor Template', 'plugin-domain' ),
					'wysiwyg' => __( 'WYSIWYG Editor', 'plugin-domain' ),
					'shortcode' => __( 'Shortcode', 'plugin-domain' )
				],
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_dtbis!" => ""
                ]
			]
		);

        $element->add_control(
			'goo1_ElementorRestrictContent_blockbistemplates',
			[
				'label' => __( 'Template', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $rows_templates,
                'condition' => [
                    "goo1_ElementorRestrictContent_enabled" => "yes",
                    "goo1_ElementorRestrictContent_dtbis!" => "",
                    "goo1_ElementorRestrictContent_replacementtypebis" => "template"
                ]
			]
		);




        $element->end_controls_section();
    }

    function prerender($content, $widget) {
        global $wp_roles;
        $settings = $widget->get_settings_for_display();
        if (($settings["goo1_ElementorRestrictContent_enabled"] ?? "") != "yes") return $content;

        //Zeitsteuerung
        if (!empty($settings["goo1_ElementorRestrictContent_dtvon"])) {
            if (time() < strtotime($settings["goo1_ElementorRestrictContent_dtvon"])) {
                switch ($settings["goo1_ElementorRestrictContent_replacementtype"]) {
                    case "none": return '';
                    case "template": return do_shortcode('[elementor-template id="'.$settings["goo1_ElementorRestrictContent_blockvontemplates"].'"]');
                }
            }
        }

        if (!empty($settings["goo1_ElementorRestrictContent_dtbis"])) {
            if (time() > strtotime($settings["goo1_ElementorRestrictContent_dtbis"])) {
                switch ($settings["goo1_ElementorRestrictContent_replacementtype"]) {
                    case "none": return '';
                    case "template": return do_shortcode('[elementor-template id="'.$settings["goo1_ElementorRestrictContent_blockbistemplates"].'"]');
                }
            }
        }

        //$content = var_export($settings,true).$content;

        $j = false;

        if ((($settings["goo1_ElementorRestrictContent_isloggedin"] ?? "") == "yes") AND is_user_logged_in()) $j = true;

        
        if (!$j AND (($settings["goo1_ElementorRestrictContent_byUserRole"] ?? "") == "yes")) {
            $myroles = $this->get_current_user_roles();
            $all_roles = $wp_roles->roles;
            foreach ($all_roles as $k => $v) {
                if ((($settings['goo1_ElementorRestrictContent_role_'.$k] ?? "") == "yes") AND in_array($k, $myroles)) $j = true;
            }
        }


        if (!$j AND (($settings["goo1_ElementorRestrictContent_byWooCommerceProduct"] ?? "") == "yes")) {
            $b = array();
            foreach ($settings["goo1_ElementorRestrictContent_products"] as $a) {
                $b[] = $a["pid"];
            }
            if ($this->has_bought_items(0, $b)) $j = true;
        }


        if (($settings["goo1_ElementorRestrictContent_inverse"] ?? "") == "yes") $j = !$j;

        if ($j) {
            return $content;
        } else {
            /*Wir brauchen den Blockcode*/
            switch ($settings["goo1_ElementorRestrictContent_replacementtype"]) {
                case "none": return '';
                case "template": return do_shortcode('[elementor-template id="'.$settings["goo1_ElementorRestrictContent_replacementtemplate"].'"]');
                case "wysiwyg": return ($settings["goo1_ElementorRestrictContent_replacementwysiwyg"] ?? "");
                case "shortcode": return do_shortcode($settings["goo1_ElementorRestrictContent_replacementshortcode"] ?? "");
                default:
                $content = var_export($settings,true).$content;
                return $content;    
            }
        }

        
    }

    function get_current_user_roles() {
        if( is_user_logged_in() ) { // check if there is a logged in user 
            $user = wp_get_current_user(); // getting & setting the current user 
            $roles = ( array ) $user->roles; // obtaining the role 
            return $roles; // return the role for the current user 
        } else {
            return array(); // if there is no logged in user return empty array  
        }
    }

    function has_bought_items( $user_var = 0,  $product_ids = 0 ) {
        global $wpdb;
        
        // Based on user ID (registered users)
        if ( is_numeric( $user_var) ) { 
            $meta_key     = '_customer_user';
            $meta_value   = $user_var == 0 ? (int) get_current_user_id() : (int) $user_var;
        } 
        // Based on billing email (Guest users)
        else { 
            $meta_key     = '_billing_email';
            $meta_value   = sanitize_email( $user_var );
        }
        
        $paid_statuses    = array_map( 'esc_sql', wc_get_is_paid_statuses() );
        $product_ids      = is_array( $product_ids ) ? implode(',', $product_ids) : $product_ids;
    
        $line_meta_value  = $product_ids !=  ( 0 || '' ) ? 'AND woim.meta_value IN ('.$product_ids.')' : 'AND woim.meta_value != 0';
    
        // Count the number of products
        $count = $wpdb->get_var( "
            SELECT COUNT(p.ID) FROM {$wpdb->prefix}posts AS p
            INNER JOIN {$wpdb->prefix}postmeta AS pm ON p.ID = pm.post_id
            INNER JOIN {$wpdb->prefix}woocommerce_order_items AS woi ON p.ID = woi.order_id
            INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS woim ON woi.order_item_id = woim.order_item_id
            WHERE p.post_status IN ( 'wc-" . implode( "','wc-", $paid_statuses ) . "' )
            AND pm.meta_key = '$meta_key'
            AND pm.meta_value = '$meta_value'
            AND woim.meta_key IN ( '_product_id', '_variation_id' ) $line_meta_value 
        " );
    
        // Return true if count is higher than 0 (or false)
        return $count > 0 ? true : false;
    }

}

$a = new goo1_ElementorRestrictContent();
