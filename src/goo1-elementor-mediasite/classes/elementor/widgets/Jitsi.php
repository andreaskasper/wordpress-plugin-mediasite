<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

namespace plugins\goo1\elementorwidgets\elementor\widgets;

class Jitsi extends \Elementor\Widget_Base {

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
		return 'goo1-jitsi';
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
		return __( 'Jitsi Meeting', 'plugin-name' );
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
		return 'eicon-video-camera';
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


		$this->add_control(
			'channel',
			[
				'label' => __( 'Channel Name', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'password',
			[
				'label' => __( 'Channel Passwort', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'domain_jitsi',
			[
				'label' => __( 'Domain', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => "meet.jit.si"
			]
		);

		
		$this->add_control(
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

		$id = "jitsi".md5(microtime(true));

		$settings = $this->get_settings_for_display();

		$user = get_userdata(get_current_user_id());

		$first_name = get_user_meta( get_current_user_id(), 'first_name', true );
		$last_name = get_user_meta( get_current_user_id(), 'last_name', true );
		$email = $user->user_email;


        echo('<div id="'.$id.'_wrapper"><div style="position: absolute; width: 100%; height: 100%; left: 0; top:0;"><div id="'.$id.'" style="width: 100%; height: 100%;"></div></div></div>
		<script src="https://'.$settings["domain_jitsi"].'/external_api.js"></script>
		<script>
		const options = {
			roomName: "'.$settings["channel"].'",
			width: "100%",
			height: "100%",
			userInfo: {
				email: "'.$email.'",
				displayName: "'.$first_name." ".$last_name.'"
			},
			interfaceConfigOverwrite: {
				MOBILE_APP_PROMO:'.(($settings["MOBILE_APP_PROMO"] == "yes")?'true':'false').',
				SHOW_CHROME_EXTENSION_BANNER:'.(($settings["SHOW_CHROME_EXTENSION_BANNER"] == "yes")?'true':'false').',
				SHOW_JITSI_WATERMARK:'.(($settings["SHOW_JITSI_WATERMARK"] == "yes")?'true':'false').'
				'.(($settings["buttons_dv"] == "yes")?',TOOLBAR_BUTTONS: [
					"microphone", "camera", "closedcaptions", "fullscreen",
					"fodeviceselection", "profile", "", "chat",
					"etherpad", "settings", "raisehand",
					"videoquality", "filmstrip", "invite", "tileview", "videobackgroundblur", "download", 
					"e2ee"
				  ]':'').'
			},
			parentNode: document.querySelector("#'.$id.'")
		};

		const api = new JitsiMeetExternalAPI( "'.$settings["domain_jitsi"].'", options);
		api.on("passwordRequired", function () {
    		api.executeCommand("password", "'.$settings["password"].'");
		});
		</script>');
?>
<style>
.premeeting-screen .copy-meeting { display: none;}
#<?=$id; ?>_wrapper { position: relative; width: 100%; height: 0; padding-bottom: 56.25%;}
body[data-elementor-device-mode="mobile"] #<?=$id; ?>_wrapper { position: relative; width: 100%; height: 100vh; padding-bottom: 0; }
</style>
<?php
	}
}
