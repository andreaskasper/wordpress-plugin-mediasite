<?php
/**
 * Elementor Toggle Button Widget Widget.
 *
 *
 * @since 1.0.0
 */
namespace plugins\goo1\elementorwidgets\elementor\widgets;
 
class ToggleButton extends \Elementor\Widget_Base {

	public function get_name() {
		return 'goo1-togglebutton';
	}

	public function get_title() {
		return __( 'Toggle Button', 'plugin-name' );
	}

	public function get_icon() {
		return 'fa fa-toggle-on';
	}

	public function get_categories() {
		return ['andreaskasper', 'goo1' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
			'id1',
			[
				'label' => __( 'Element ID1', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( '', 'plugin-name' ),
			]
        );

        $this->add_control(
			'id2',
			[
				'label' => __( 'Element ID2', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( '', 'plugin-name' ),
			]
		);
		
		$this->add_control(
			'txt1',
			[
				'label' => __( 'Label1', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( '', 'plugin-name' ),
			]
		);
		
		$this->add_control(
			'txt2',
			[
				'label' => __( 'Label2', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => __( '', 'plugin-name' ),
			]
        );

		$this->end_controls_section();

    }
    

	protected function render() {
        $settings = $this->get_settings_for_display();

		echo('<button class="active" id="toggle_button_1" onclick="toggle1();">'.($settings["txt1"] ?? "Label1").'</button>');
		echo('<button id="toggle_button_2" onclick="toggle2();">'.($settings["txt2"] ?? "Label2").'</button>');

	?>
<style>
#toggle_button_1, #toggle_button_2 { background: transparent; border: 0.2rem solid #BE2222; color: #BE2222; font-size: 1.25rem; border-radius: 0; transition: all 300ms ease-in-out; }
#toggle_button_1 {-webkit-border-top-left-radius: 1rem;
-webkit-border-bottom-left-radius: 1rem;
-moz-border-radius-topleft: 1rem;
-moz-border-radius-bottomleft: 1rem;
border-top-left-radius: 1rem;
border-bottom-left-radius: 1rem}
#toggle_button_2 {-webkit-border-top-right-radius: 1rem;
-webkit-border-bottom-right-radius: 1rem;
-moz-border-radius-topright: 1rem;
-moz-border-radius-bottomright: 1rem;
border-top-right-radius: 1rem;
border-bottom-right-radius: 1rem}
#toggle_button_1.active { background: #BE2222; color: #fff; }
#toggle_button_2.active { background: #BE2222; color: #fff; }
</style>
<?php



		if ( ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
        ?>
<script>

function toggle1() {
	jQuery("#<?=$settings["id2"] ?>").show();
	jQuery("#<?=$settings["id1"] ?>").hide();
	jQuery("#toggle_button_1").parent().find("button").removeClass("active");
	jQuery("#toggle_button_1").addClass("active");
	console.log("toggle1");
} 
function toggle2() {
	jQuery("#<?=$settings["id1"] ?>").show();
	jQuery("#<?=$settings["id2"] ?>").hide();
	jQuery("#toggle_button_2").parent().find("button").removeClass("active");
	jQuery("#toggle_button_2").addClass("active");
	console.log("toggle2");
} 
jQuery(document).ready(function($) {
	$("#matogglebutton INPUT").on("click change", function() {
		var a = $(this).is(":checked");
		console.log(a);
		jQuery("#<?=$settings["id2"] ?>").toggle(!a);
		jQuery("#<?=$settings["id1"] ?>").toggle(a);
	});
	$("#<?=$settings["id1"] ?>").hide();
	console.log("loaded");

});
</script>
		<?php
		}
        /*//
        return;
        $html = wp_oembed_get( $settings['url'] );
		echo '<div class="oembed-elementor-widget">';
		echo ( $html ) ? $html : $settings['url'];
		echo '</div>';*/

	}

}
