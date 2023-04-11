<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class Heading extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'goo1-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Headings', 'plugin-name' );
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
		return 'eicon-heading';
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

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);


		$this->add_control(
			'title1',
			[
				'label' => __( 'Title 1', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'title2',
			[
				'label' => __( 'Title 2', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'title3',
			[
				'label' => __( 'Title 3', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'space_between',
			[
				'label' => __( 'space between party', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'yes',
			]
		);

		$this->add_control(
			'url_href',
			[
				'label' => esc_html__( 'Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => esc_html__( 'HTML Tag', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'div',
				'options' => [
					'h1' => esc_html__( 'H1', 'plugin-name' ),
					'h2' => esc_html__( 'H2', 'plugin-name' ),
					'h3' => esc_html__( 'H3', 'plugin-name' ),
					'h4' => esc_html__( 'H4', 'plugin-name' ),
					'h5' => esc_html__( 'H5', 'plugin-name' ),
					'h6' => esc_html__( 'H6', 'plugin-name' ),
					'div' => esc_html__( 'div', 'plugin-name' ),
					'span' => esc_html__( 'span', 'plugin-name' ),
					'p' => esc_html__( 'p', 'plugin-name' )
				],
			]
		);
		
		/*$this->add_control(
			'MOBILE_APP_PROMO',
			[
				'label' => __( 'Show Mobile App Promo', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
			]
		);

		$this->add_control(
			'SHOW_CHROME_EXTENSION_BANNER',
			[
				'label' => __( 'Show Chrome Extension Banner', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
			]
		);

		$this->add_control(
			'SHOW_JITSI_WATERMARK',
			[
				'label' => __( 'Show Jitsi Watermark', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'yes',
			]
		);

		$this->add_control(
			'buttons_dv',
			[
				'label' => __( 'Buttons DV1', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
			]
		);*/
           

		$this->end_controls_section();

		

    }
    
	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {
		$settings = $this->get_settings_for_display();

		if (!empty($settings["url_href"])) echo('<a href="'.$settings["url_href"].'">');
		echo('<'.$settings["html_tag"].'>');

		if (!empty($settings["title1"])) echo('<span>'.$settings["title1"].'</span>');
		if ($settings["space_between"] == "yes") echo(' ');
		if (!empty($settings["title2"])) echo('<span>'.$settings["title2"].'</span>');
		if ($settings["space_between"] == "yes") echo(' ');
		if (!empty($settings["title3"])) echo('<span>'.$settings["title3"].'</span>');
		echo('</'.$settings["html_tag"].'>');

		if (!empty($settings["url_href"])) echo('</a>');
		
	}
}
