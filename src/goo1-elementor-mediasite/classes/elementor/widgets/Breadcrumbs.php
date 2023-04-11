<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class Breadcrumbs extends \Elementor\Widget_Base {

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
		return 'goo1-breadcrumbs';
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
		return __( 'Breadcrumbs', 'plugin-name' );
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
		return 'eicon-editor-list-ul';
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

		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'url_href',
			[
				'label' => esc_html__( 'Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( '', 'plugin-name' ),
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-google-plus',
					'fa fa-instagram',
					'fa fa-linkedin',
					'fa fa-pinterest',
					'fa fa-reddit',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-youtube',
				],
				'default' => 'fa fa-facebook',
			]
		);

		$repeater->add_control(
			'active',
			[
				'label' => __( 'active', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => "yes",
				'default' => 'no',
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Items', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Home', 'plugin-name' )
					]
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'icon_between',
			[
				'label' => esc_html__( 'Icon between', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-google-plus',
					'fa fa-instagram',
					'fa fa-linkedin',
					'fa fa-pinterest',
					'fa fa-reddit',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-youtube',
				],
				'default' => 'fa fa-facebook',
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

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} ol li a, {{WRAPPER}} ol li',
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' => esc_html__( 'Separator Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .separator' => 'color: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs(
			'style_tabs'
		);
		
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'plugin-name' ),
			]
		);

		$this->add_control(
			'item_color_normal',
			[
				'label' => esc_html__( 'Item Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'plugin-name' ),
			]
		);

		$this->add_control(
			'item_color_hover',
			[
				'label' => esc_html__( 'Item Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_active_tab',
			[
				'label' => esc_html__( 'Active', 'plugin-name' ),
			]
		);

		$this->add_control(
			'item_color_active',
			[
				'label' => esc_html__( 'Item Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} li.active a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->add_control(
			'separator',
			[
				'label' => esc_html__( 'Separator Type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'none', 'plugin-name' ),
					'>' => esc_html__( '>', 'plugin-name' ),
					'/' => esc_html__( '/', 'plugin-name' ),
					'»' => esc_html__( '»', 'plugin-name' ),
					'icon' => esc_html__( 'Icon', 'plugin-name' )
				],
			]
		);

		$this->add_control(
			'icon_separator',
			[
				'label' => esc_html__( "Separator Icon", 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'separator' => 'icon'
				]
			]
		);

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

		echo('<ol itemscope itemtype="https://schema.org/BreadcrumbList" style="padding: 0; margin: 0; list-style:none;">');
		$i = 0;
		foreach ($settings["list"] as $row) {
			$i++;
			echo('<li class="'.(($row["active"] == "yes")?"active":"").'" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" style="display: inline;">');
			echo('<a href="'.$row["url_href"].'" itemprop="item" href="https://example.com/books">');
			echo('<span itemprop="name">'.$row["title"].'</span></a>');
			if ($i < count($settings["list"])) {
				switch ($settings["separator"]) {
					case ">": echo(' <span class="separator">&gt;</span> '); break;
					case "/": echo(' <span class="separator">/</span> '); break;
					case "»": echo(' <span class="separator">»</span> '); break;
					case "icon": 
						echo('<i class="separator '.$settings["icon_separator"]["value"].'"></i>');
						break;
				}
			}
			echo('<meta itemprop="position" content="'.$i.'" />');
			echo('</li> ');
		}
		echo('</ol>');
	}
}
