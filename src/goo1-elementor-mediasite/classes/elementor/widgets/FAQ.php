<?php
/**
 * Elementor FAQ Widget.
 * with added JSON-LD
 * by Andreas Kasper
 *
 * @since 1.0.0
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class FAQ extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'goo1-faq';
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
		return __( 'FAQ', 'plugin-name' );
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
		return 'eicon-help-o';
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
		return ['andreaskasper','goo1eew' ];
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
			'question',
			[
				'label' => __( 'Question', 'goo1-wsdc' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
        
        $repeater->add_control(
			'answer',
			[
				'label' => esc_html__( 'Answer', 'goo1-wsdc' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your answer here', 'textdomain' ),
			]
		);
        
        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'goo1-wsdc' ),
				'type' => \Elementor\Controls_Manager::ICONS
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
					]
				],
				'title_field' => '{{{ question }}}',
			]
		);
        
        $this->add_control(
			'question_tag',
			[
				'label' => __( 'Question Tag', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => "h3",
				'options' => array("div" => "DIV", "h1" => "H1", "h2" => "H2", "h3" => "H3", "h4" => "H4", "h5" => "H5", "h6" => "H6")
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
		);*/
           

		$this->end_controls_section();
        
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
        
        $this->add_control(
			'style_question_color',
			[
				'label' => esc_html__( 'Question Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .txt_question' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'style_question_icon_color',
			[
				'label' => esc_html__( 'Question Icon Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'color: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'style_answer_color',
			[
				'label' => esc_html__( 'Answer Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .txt_answer' => 'color: {{VALUE}}',
				],
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
        
        $jsonld = array(
        	"@context" => "https://schema.org",
      		"@type" => "FAQPage",
      		"mainEntity" => array()
        );

		//$user = get_userdata(get_current_user_id());
		//echo(var_export($settings, true));
        foreach ($settings["list"] as $row) {
        	switch ($settings["question_tag"]) {
            	case "div":
                case "h1":
                case "h2":
                case "h3":
                case "h4":
                case "h5":
                case "h6":
echo('<'.$settings["question_tag"].' class="txt_question">'.$row["question"].'</'.$settings["question_tag"].'>');
break;
            	default:
                	echo('<div>'.$row["question"].'</div>');
            }
            echo('<div class="txt_answer">'.$row["answer"].'</div>');
            
            $b = array(
            	"@type" => "Question",
        		"name" => $row["question"],
        		"acceptedAnswer" => array(
          			"@type" => "Answer",
          			"text" => $row["answer"]
        		)
            );
            $jsonld["mainEntity"][] = $b;
            
        }
        
        echo('<script type="application/ld+json">'.json_encode($jsonld).'</script>');

	}
}
