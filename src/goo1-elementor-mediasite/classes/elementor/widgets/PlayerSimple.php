<?php
/**
 * 
 */
namespace plugins\goo1\elementor\mediasite\elementor\widgets;

class PlayerSimple extends \Elementor\Widget_Base {

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'goo1-videoplayersimple';
	}

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Video Player Simple', 'plugin-name' );
	}

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa far fa-solid fa-youtube-play';
	}

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['andreaskasper' ];
	}

	/**
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
			'type',
			[
				'label' => __( 'Type', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
				'options' => [
					'video' => esc_html__( 'video', 'plugin-name' ),
					'poster' => esc_html__( 'poster', 'plugin-name' ),
					'captions' => esc_html__( 'captions', 'plugin-name' ),
                    'chapters' => esc_html__( 'chapters', 'plugin-name' )
				]
			]
		);

        $repeater->add_control(
			'url',
			[
				'label' => __( 'URL', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL
			]
        );

        $repeater->add_control(
			'videotype',
			[
				'label' => __( 'Format', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
				'options' => [
					'video/mp4' => esc_html__( 'video/mp4', 'plugin-name' )
				]
			]
		);

        $repeater->add_control(
			'quality',
			[
				'label' => __( 'Quality', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1080p',
			]
		);

        $repeater->add_control(
			'quality_label',
			[
				'label' => __( 'Quality Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1080p',
			]
		);

        $this->add_control(
			'sources',
			[
				'label' => esc_html__( 'Sources', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Source', 'plugin-name' )
					]
				],
				'title_field' => '{{{ type }}} {{{ videotype }}} {{{ quality }}}',
			]
		);
		        
 		$this->end_controls_section();

        $this->start_controls_section(
			'poster_section',
			[
				'label' => __( 'Poster', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

        $this->add_control(
			'poster_local',
			[
				'label' => __( 'Poster', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA
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
		//echo("abcdefgh");
        $settings = $this->get_settings_for_display();
        
        //print_r($settings);

        $id = "player".md5(microtime(true));

		
		echo('<div style="position: relative; display: block; width:100%; height: 0px; padding-bottom: 56.25%; overflow: hidden; background: red;">');
		echo('<div style="position: absolute; display: block; width:100%; height: 100%; left: 0px; top: 0px; background: black;">');
		echo('<video id="'.$id.'" class="video-js vjs-default-skin" controls playsinline controlsList="nodownload" preload="auto" style="width:100%; height:100%;">');
        foreach ($settings["sources"] as $row) {
            if ($row["type"] != "video") continue;
            echo('<source src="'.$row["url"]["url"].'" type="'.($row["videotype"] ?? "video/mp4").'" label="'.($row["quality_label"] ?? $row["quality"]).'"/>');
            break;
        }
        //if (!empty($settings["url_mp4"]["url"])) echo('<source src="'.$settings["url_mp4"]["url"].'" type="video/mp4"/>'.PHP_EOL);
        
        //if (!empty($settings["url_chapters_vtt"]["url"])) echo('<track src="'.$settings["url_chapters_vtt"]["url"].'" kind="chapters" label="Kapitel" srclang="de">'.PHP_EOL);

	/*if (file_exists($folder_videos.$settings["file_prefix"].".en.vtt")) echo('<track src="'.$urlpath_videos.$settings["file_prefix"].'.en.vtt" kind="captions" srclang="en" label="English">'.PHP_EOL);
	if (file_exists($folder_videos.$settings["file_prefix"].".de.vtt")) echo('<track src="'.$urlpath_videos.$settings["file_prefix"].'.de.vtt" kind="captions" srclang="de" label="Deutsch">'.PHP_EOL);

	if (file_exists($folder_videos.$settings["file_prefix"].".chapters.en.vtt")) echo('<track src="'.$urlpath_videos.$settings["file_prefix"].'.chapters.en.vtt" kind="chapters" label="Chapters" srclang="en">'.PHP_EOL);
	if (file_exists($folder_videos.$settings["file_prefix"].".chapters.de.vtt")) echo('<track src="'.$urlpath_videos.$settings["file_prefix"].'.chapters.de.vtt" kind="chapters" label="Kapitel" srclang="en">'.PHP_EOL);*/
	
	echo('<p class="vjs-no-js">please enable Javascript to watch the video</p>
</video>');

		echo('</div>');
		echo('</div>');

        echo('<link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">');
    	echo('<link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />');
		echo('<script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>');
        echo('<script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>');

		?>
<style>
/*.vjs-picture-in-picture-control { display: none !important; }*/
.vjs-control button.vjs-cams-button { width: 20px; background: url(/wp-content/plugins/goo1-elementor-mediasite/assets/images/videojs_cam.png) no-repeat center center; padding-left: 0px; padding-right: 0px; }
.vjs-control button.vjs-min10sec-button { width: 20px; background: url(/wp-content/plugins/goo1-elementor-mediasite//assets/videojs_min10sec.png) no-repeat center center; padding-left: 0px; padding-right: 0px; }
.video-js .vjs-big-play-button { margin: -24px 0px 0px -45px; top: 50% !important; left: 50% !important; }
.vjs-quality-button .vjs-quality-value { pointer-events: none; font-size: 1.5em; line-height: 2; text-align: center; }
</style>
<?php
$w = array();
$w["playbackRates"] = array(0.25, 0.5, 1.0, 2.0);
$w["poster"] = $settings["poster_local"]["url"];
//$w["controlBar"]["children"] = array('playToggle','progressControl','volumePanel','qualitySelector','fullscreenToggle');

$w2 = array();
foreach ($settings["sources"] as $row) {
    if ($row["type"] != "video") continue;
    $b = array();
    $b["url"] = $row["url"]["url"];
    $b["type"] = $row["videotype"];
    $b["quality"] = trim($row["quality_label"] ?? $row["quality"]);
    $w2[] = $b;
}

?>
<script>
var akvjs = {
	init: function(id, options) {
		console.log("Optionen", options);
		akvjs.options = options;
		akvjs.id = id;
        akvjs.sources = <?=json_encode($w2); ?>;
		akvjs.ele = jQuery(id);
		akvjs.quality = 1080;
		akvjs.vjs = videojs(id, <?=json_encode($w); ?>, function(){
			console.log(akvjs.ele.length);
			jQuery(akvjs.id+" .vjs-progress-control").before('<div class="vjs-min10sec-button vjs-menu-button vjs-control vjs-button"><button class="vjs-min10sec-button vjs-button" type="button" aria-disabled="false" title="10sec zurück" aria-haspopup="true" aria-expanded="false"><span aria-hidden="true" class="vjs-icon-placeholder"></span><span class="vjs-control-text" aria-live="polite">-10sec</span></button></div>');
			jQuery(akvjs.id+" div.vjs-audio-button").after('<div class="vjs-quality-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button"><div class="vjs-quality-value">HD</div><button class="vjs-quality-rate vjs-menu-button vjs-menu-button-popup vjs-button" type="button" aria-disabled="false" title="Playback Rate" aria-haspopup="true" aria-expanded="false"><span aria-hidden="true" class="vjs-icon-placeholder"></span><span class="vjs-control-text" aria-live="polite">Playback Rate</span></button><div class="vjs-menu"><ul class="vjs-menu-content" role="menu"><li class="vjs-menu-title">Qualität</li></ul></div></div>');
            for (var i = 0; i < akvjs.sources.length; i++) {
                obj = akvjs.sources[i];
                console.log(i,obj);
                jQuery(akvjs.id+" div.vjs-quality-button ul").append('<li class="vjs-menu-item" role="menuitemradio" aria-disabled="false" tabindex="-1" aria-checked="false" onclick="akvjs.setquality(\''+obj.quality+'\', '+i+');"><span class="vjs-menu-item-text">'+obj.quality+'</span><span class="vjs-control-text" aria-live="polite"></span></li>');
            }
			jQuery("div.vjs-quality-button").hover(function() {
				console.log("hover quality");
				jQuery(this).addClass("vjs-hover");
			}, function() {
				jQuery(this).removeClass("vjs-hover");
			});
			
			jQuery("button.vjs-min10sec-button").click(function() {
				akvjs.secback(10);
			});

			console.log("player loaded", akvjs.vjs.language(), akvjs.vjs);
		});
	},
	setquality: function(value,id) {
		console.log("switch to quality", value);
		akvjs.quality = value;
        jQuery(akvjs.id+" div.vjs-quality-value").text(value);
		/*switch (value) {
			case 1080:
				
				break;
			case 480:
				jQuery(akvjs.id+" div.vjs-quality-value").text('SD');
				break;
            case 360:
				jQuery(akvjs.id+" div.vjs-quality-value").text('360');
				break;
			case 240:
				jQuery(akvjs.id+" div.vjs-quality-value").html('<i class="far fa-mobile-android-alt"></i>');
				break;
			case 120:
				jQuery(akvjs.id+" div.vjs-quality-value").html('<i class="fas fa-pager"></i>');
				break;
		}*/
		var pos = akvjs.vjs.currentTime();
		akvjs.vjs.src({
            type: akvjs.sources[id].type,
            src: akvjs.sources[id].url
        });
		akvjs.vjs.play();
		akvjs.vjs.currentTime(pos);
	},
	secback: function (sec) {
		var pos = akvjs.vjs.currentTime();
		pos = Math.max(0, pos - sec);
		akvjs.vjs.currentTime(pos);
	},
	secforward: function (sec) {
		var pos = akvjs.vjs.currentTime();
		pos = Math.min(akvjs.vjs.duration(), pos +sec);
		akvjs.vjs.currentTime(pos);
	}
}

jQuery(document).ready(function($) {
    akvjs.init("#<?=$id ?>", <?=json_encode(array()); ?>);
});
</script>
<?php
	}


	

	private static function get5678index($mustreload = false) {
		$local = __DIR__."/5678-index.json";
		if ($mustreload OR filemtime($local) < time()-rand(86400,2*86400)) {
			$str = file_get_contents("https://cdnkylesarah.5678.video/mediaconvertserver/index.json");
			$json = json_decode($str,true);
			if (!empty($json["pres"]) AND !empty($json["meta"])) {
				file_put_contents($local, json_encode($json));
				return $json;
			}
		}
		$str = file_get_contents($local);
		return json_decode($str,true);
	}
}