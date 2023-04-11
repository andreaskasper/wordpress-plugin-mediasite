<?php
/**
 * Elementor Calendly Widget.
 *
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class Calendly extends \Elementor\Widget_Base {

	public function get_name() {
		return 'goo1-calendly';
	}

  
	public function get_title() {
		return __( 'Calendly', 'plugin-name' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-calendar';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['andreaskasper', 'goo1eew'];
	}


  protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'type',
			[
				'label' => esc_html__( 'Separator Type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'inline' => esc_html__( 'Inline Embed', 'plugin-name' ),
					'popup_widget' => esc_html__( 'Popup Widget', 'plugin-name' ),
					'popup_text' => esc_html__( 'Popup Text', 'plugin-name' )
				],
			]
		);

		/*$this->add_control(
			'url',
			[
				'label' => esc_html__( 'Calendly Meeting URL', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://calendly.com/user/meeting', 'plugin-name' ),
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);*/

		$this->add_control(
			'slug_user',
			[
				'label' => esc_html__( 'User URL slug', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'slug_meeting',
			[
				'label' => esc_html__( 'Meeting URL slug', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'default' => "Schedule time with me",
				'label_block' => true,
				'condition' => [
					'type' => 'popup_widget',
				],
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'default' => "click here",
				'label_block' => true,
				'condition' => [
					'type' => 'popup_text',
				],
			]
		);


		$this->add_control(
			'hide_event_type_details',
			[
				'label' => __( 'Hide event type details', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
				'condition' => [
					'type' => 'inline',
				],
			]
		);

		$this->add_control(
			'hide_gdpr_banner',
			[
				'label' => __( 'Hide GDPR banner', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
				'condition' => [
					'type' => 'inline',
				],
			]
		);

		$this->add_control(
			'branding',
			[
				'label' => __( 'Branding', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
				'condition' => [
					'type' => 'popup_widget',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		

		$this->end_controls_section();
		

    }
    
    protected function render() {
		$settings = $this->get_settings_for_display();

		//print_r($settings);

		switch ($settings["type"] ?? "") {
			case "inline":
				$url = "https://calendly.com/".$settings["slug_user"]."/".$settings["slug_meeting"]."?";
				if (($settings["hide_gdpr_banner"] ?? "") == "yes") $url .= "hide_gdpr_banner=1"; else $url .= "hide_gdpr_banner=0";
				if (($settings["hide_event_type_details"] ?? "") == "yes") $url .= "hide_event_type_details=1"; else $url .= "hide_event_type_details=0";
				$url .= "&background_color=".urlencode(substr($settings["background_color"] ?? "#ffffff",1,8));
				$url .= "&text_color=".urlencode(substr($settings["text_color"] ?? "#000000",1,8));
				$url .= "&primary_color=".urlencode(substr($settings["primary_color"] ?? "#0000ff",1,8));
		
		
				echo('<!-- Calendly inline widget begin -->
				<div class="calendly-inline-widget" data-url="'.$url.'" style="min-width:320px;height:630px;"></div>
				<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
				<!-- Calendly inline widget end -->');
				break;
			case "popup_widget":
				$w = array();
				$w["url"] = "https://calendly.com/".$settings["slug_user"]."/".$settings["slug_meeting"];
				$w["text"] = $settings["button_text"] ?? "Schedule time with me";
				$w["color"] = $settings["background_color"];
				$w["textColor"] = $settings["text_color"];
				$w["branding"] = (($settings["branding"] == "yes")?true:false);



				echo('<!-- Calendly badge widget begin -->
				<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
				<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
				<script type="text/javascript">window.onload = function() { Calendly.initBadgeWidget('.json_encode($w).'); }</script>
				<!-- Calendly badge widget end -->');
				break;
			case "popup_text":
				$w = array();
				$w["url"] = "https://calendly.com/".$settings["slug_user"]."/".$settings["slug_meeting"];
				echo('<!-- Calendly link widget begin -->
				<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
				<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
				<a href="" onclick="Calendly.initPopupWidget('.json_encode($w).');return false;">'.$settings["link_text"].'</a>
				<!-- Calendly link widget end -->');
				break;
		}
	}
}
