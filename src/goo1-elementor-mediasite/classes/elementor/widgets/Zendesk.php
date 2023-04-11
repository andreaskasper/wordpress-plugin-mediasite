<?php
/**
 * Elementor Zendesk Widget.
 *
 * Elementor widget that shows a Live Support Help Chat via Zendesk
 *
 * @version 0.1
 * @lastmodified 06.07.2023 23:00
 *
 * @since 1.0.0
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class Zendesk extends \Elementor\Widget_Base {

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
		return 'goo1-zendesk';
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
		return __( 'goo1 Live Support Chat', 'plugin-name' );
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
		return 'fa fas fa-comments-o fa-comments';
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
		return ['andreaskasper', 'goo1' ];
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
			'key',
			[
				'label' => __( 'Key', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			'department',
			[
				'label' => __( 'Department', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			'tags',
			[
				'label' => __( 'Tags', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			'language',
			[
				'label' => __( 'Sprache', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => null,
				'options' => array("en" => "English", "de" => "Deutsch"),
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_badge',
			[
				'label' => __( 'Badge', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'badge_label',
			[
				'label' => __( 'Badge Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			'badge_image',
			[
				'label' => __( 'Badge Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'chat_label_online',
			[
				'label' => __( 'Chat Label Online', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			'chat_label_offline',
			[
				'label' => __( 'Chat Label Offline', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_helpCenter',
			[
				'label' => __( 'Help Center', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			"helpcenter_chatbutton",
			[
				'label' => __( 'Chat Button', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			"button_offline_text",
			[
				'label' => __( 'Offline Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			"window_title",
			[
				'label' => __( 'Window Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->add_control(
			"prechat_greeting",
			[
				'label' => __( 'Prechat Greeting', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => null,
			]
		);

		$this->end_controls_section();
		


		/*$this->add_control(
			'url_mp4',
			[
				'label' => __( 'Video URL mp4', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL
			]
        );
        
        $this->add_control(
			'url_webm',
			[
				'label' => __( 'Video URL webm', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL
			]
        );
        
        $this->add_control(
			'url_poster',
			[
				'label' => __( 'Poster URL', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL
			]
        );

        $this->add_control(
			'url_chapters_vtt',
			[
				'label' => __( 'Kapitel vtt', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL
			]
        );*/
        
        /*$this->add_control(
			'poster_local',
			[
				'label' => __( 'Ersatzvorschaubild', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);*/

        

		

		/* ---------------------- */

		/*$this->start_controls_section(
			'members_section',
			[
				'label' => __( 'Mitgliedschaftsbeschränkung', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		/*$this->add_control(
			'member_level1',
			[
				'label' => __( 'Level 1: Basic', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'anzeigen', 'your-plugin' ),
				'label_off' => __( 'verstecken', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'member_level2',
			[
				'label' => __( 'Level 2: Premium', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'anzeigen', 'your-plugin' ),
				'label_off' => __( 'verstecken', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'member_level3',
			[
				'label' => __( 'Level 3: Pro', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'anzeigen', 'your-plugin' ),
				'label_off' => __( 'verstecken', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'member_referenzdatum',
			[
				'label' => __( 'Referenzdatum', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
			]
		);


		$this->end_controls_section();*/

		$this->start_controls_section(
			'style_general_section',
			[
				'label' => __( 'General', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'chat_hideWhenOffline',
			[
				'label' => __( 'hide when offline', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'verstecken', 'your-plugin' ),
				'label_off' => __( 'anzeigen', 'your-plugin' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_position_section',
			[
				'label' => __( 'Position', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'position_horizontal',
			[
				'label' => __( 'Horizontal', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => "right",
				'options' => array("left" => "Left", "right" => "Right")
			]
		);

		$this->add_control(
			'position_vertical',
			[
				'label' => __( 'Vertical', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => "bottom",
				'options' => array("bottom" => "Bottom", "top" => "Top")
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_colors_section',
			[
				'label' => __( 'Colors', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'color_theme',
			[
				'label' => __( 'Theme', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_launcher',
			[
				'label' => __( 'Launcher', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_launcherText',
			[
				'label' => __( 'Launcher Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_button',
			[
				'label' => __( 'Button', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_resultLists',
			[
				'label' => __( 'Result Lists', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_header',
			[
				'label' => __( 'Header', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'color_articleLinks',
			[
				'label' => __( 'Article Links', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_badge_section',
			[
				'label' => __( 'Badge', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'badge_layout',
			[
				'label' => __( 'Layout', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => "image_left",
				'options' => array("image_left" => "Image Left", "image_right" => "Image Right", "image_only" => "Image Only", "text_only" => "Text only")
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

		if( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			echo('<div style="color: #000; background: #ffffff80; padding: 0.5rem; border-radius: 0.5rem; text-align: center;">goo1 Live Support');
			if (empty($settings["key"])) echo('<div style="background: #00000080; color: #f00; font-family: Courier, Serif; font-size:0.8rem; text-align: center;">Error: API-KEY is missing in Settings.</div>');
			echo('</div>');
			return;
		}

		if (empty($settings["key"])) {
			echo('<div style="background: #00000080; color: #f00; font-family: Courier, Serif; font-size:1rem; padding: 0.25rem; text-align: center;">Error: API-KEY is missing in Settings.</div>');
		}

		$w = array();
		
		if (!empty($settings["badge_label"]))  $w["webWidget"]["launcher"]["badge"]["label"]["*"] = $settings["badge_label"];
		if (!empty($settings["badge_image"]))  $w["webWidget"]["launcher"]["badge"]["image"] = $settings["badge_image"];
		if (!empty($settings["badge_layout"])) $w["webWidget"]["launcher"]["badge"]["layout"] = $settings["badge_layout"];

		if (!empty($settings["chat_hideWhenOffline"])) $w["webWidget"]["chat"]["hideWhenOffline"] = true;
		if (!empty($settings["position_horizontal"])) $w["webWidget"]["position"]["horizontal"] = $settings["position_horizontal"];
		if (!empty($settings["position_vertical"])) $w["webWidget"]["position"]["vertical"] = $settings["position_vertical"];


		if (!empty($settings["helpcenter_chatbutton"])) $w["webWidget"]["helpCenter"]["chatButton"]["*"] = $settings["helpcenter_chatbutton"];

		if (!empty($settings["chat_label_online"])) $w["webWidget"]["contactOptions"]["enabled"] = true;
		if (!empty($settings["chat_label_online"])) $w["webWidget"]["contactOptions"]["chatLabelOnline"] = $settings["chat_label_online"];
		if (!empty($settings["chat_label_offline"])) $w["webWidget"]["contactOptions"]["chatLabelOffline"] = $settings["chat_label_offline"];


		if (!empty($settings["color_theme"])) $w["webWidget"]["color"]["theme"] = $settings["color_theme"];
		if (!empty($settings["color_launcher"])) $w["webWidget"]["color"]["launcher"] = $settings["color_launcher"];
		if (!empty($settings["color_launcherText"])) $w["webWidget"]["color"]["launcherText"] = $settings["color_launcherText"];
		if (!empty($settings["color_button"])) $w["webWidget"]["color"]["button"] = $settings["color_button"];
		if (!empty($settings["color_resultLists"])) $w["webWidget"]["color"]["resultLists"] = $settings["color_resultLists"];
		if (!empty($settings["color_header"])) $w["webWidget"]["color"]["header"] = $settings["color_header"];
		if (!empty($settings["color_articleLinks"])) $w["webWidget"]["color"]["articleLinks"] = $settings["color_articleLinks"];

		

		echo('<script type="text/javascript">window.zESettings = '.json_encode($w).';</script>');

		echo('<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key='.urlencode($settings["key"]).'"></script>');


		echo( '<script>');
			$user = wp_get_current_user();
			//print_r($user);
			if (!empty($user->first_name."")) echo('
            zE(function() {
              zE.identify({
                name: "'.$user->first_name.' '.$user->last_name.'",
                email: "'.($user->user_email ?? "").'",
				organization: "goo1 Test"
              });
              console.log("Support started");
            });');

		echo('</script>');
          
		/*echo('<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="https://v2.zopim.com/?HJnLRAfLbOZw1fR2agLUMNzJXzJyu3ot";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");');
		echo('$zopim(function() {'.PHP_EOL);
		$user = wp_get_current_user();
		if (!empty($user->first_name."")) echo('$zopim.livechat.setName("'.$user->first_name.' '.$user->last_name.'");'.PHP_EOL);
		if (!empty($user->user_email."")) echo('$zopim.livechat.setEmail("'.$user->user_email.'");'.PHP_EOL);

		if (!empty($settings["department"])) echo('$zopim.livechat.departments.filter("'.$settings["department"].'");'.PHP_EOL);
		if (!empty($settings["tags"])) echo('$zopim.livechat.addTags("'.$settings["tags"].'");'.PHP_EOL);
		if (!empty($settings['color_badge'])) echo('$zopim.livechat.badge.setColor("'.$settings['color_badge'].'");'.PHP_EOL);
		if (!empty($settings['color_button'])) echo('$zopim.livechat.button.setColor("'.$settings['color_button'].'");'.PHP_EOL);
		if (!empty($settings['button_position'])) echo('$zopim.livechat.button.setPosition("'.$settings['button_position'].'");'.PHP_EOL);

		if (!empty($settings['bubble_title'])) echo('$zopim.livechat.bubble.setTitle("'.$settings["bubble_title"].'");'.PHP_EOL);
		if (!empty($settings['bubble_text'])) echo('$zopim.livechat.bubble.setText("'.$settings["bubble_text"].'");'.PHP_EOL);

		if (!empty($settings['badge_text'])) echo('$zopim.livechat.badge.setText("'.$settings["bubble_text"].'");'.PHP_EOL);
		if (!empty($settings["button_online_text"])) echo('$zopim.livechat.setGreetings({"online": "'.$settings["button_online_text"].'", "offline": "'.$settings["button_offline_text"].'"});'.PHP_EOL);

		if (!empty($settings['window_title'])) echo('$zopim.livechat.window.setTitle("'.$settings["window_title"].'");'.PHP_EOL);
		if (!empty($settings['prechat_greeting'])) echo('$zopim.livechat.prechatForm.setGreetings("'.$settings["prechat_greeting"].'");'.PHP_EOL);

			//$html .= '$zopim.livechat.concierge.setAvatar();
			//$html .= '$zopim.livechat.concierge.setName("Andreas MarcOnline");'.PHP_EOL;
			//$html .= '$zopim.livechat.concierge.setTitle("MarcSupport");'.PHP_EOL;
		echo('$zopim.livechat.theme.reload();'.PHP_EOL);
		echo('});');
		echo('</script>');
		//echo("abc");
		//print_r($settings);*/

	}
}
