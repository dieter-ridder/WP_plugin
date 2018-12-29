<?php
  /*
   Plugin Name: betterplace - get status
   Plugin URI: https://netz-omi.de/
   Description: holt den Status in der Spendenmeisterschaft ab
   Version: 1.0
   Author: Charlotte Dieter-Ridder
   Author URI: https://netz-omi.de
   License: GPL2
   */
// Registers Script and css in WordPress
wp_register_script( 'bplace_script', plugins_url( 'js/app.js', __FILE__ ),'',null, false );
wp_register_style('bplace_style', plugins_url('css/bplace_status.css', __FILE__));
wp_enqueue_script('bplace_script');
wp_enqueue_style('bplace_style');
		}
// Die Registrierung unseres Widgets
function bplace_widget_init() {
	register_widget('bplace_widget');
}
add_action('widgets_init', 'bplace_widget_init');   
   
class bplace_widget extends WP_Widget{

/**
 * Register widget with WordPress.
 */
	public function __construct() {
		parent::__construct(
	 		'bplace_widget', // Base ID
			'betterplace - get status', // Name
			array( 'description' => __( 'Mit diesem Widget sehen wir unseren Wettbewerbsstatus', 'bplace_widget' ), ) // Args
		);
	}	
	/**
	 *  Register the widget
	 */
	public static function register_widget() {
		register_widget( 'bplace_widget' );
	}

//function bplace_widget(){
   //do setup stuff
//}

	public function form( $instance ){
	   //do form stuff
	}

	public function update($new_instance, $old_instance){
	   //do update stuff
	}

	public function widget($args, $instance){
	// Output all wrappers
		echo $args['before_widget'];
		// Spendenknopf
		?>
<h2>Barrierefreiheit</h2>
<span class="betterplace">
<div class="placeholder">
<h2><a href="https://www.betterplace.org/de/spendenmeisterschaft/paritaetischer">-> zur Rangliste</a></h2>
</div>
<div class="result">
z.Z.:
<span class="place-value ampel">X</span> mit <span class="amount-value ampel">XXX</span><br>
<span class="diff-negative"><span class="diff-value ampel">XX</span> Abstand zum 1. Platz</span><span class="diff-positive"><span class="diff-value ampel">XX</span> Abstand zum 2. Platz</span>
<script>bplace_main();</script>
<br><a href="https://www.betterplace.org/de/spendenmeisterschaft/paritaetischer">-> zur Rangliste</a>
</div>
<a href="https://www.betterplace.org/de/projects/64343-haus-eichkamp-generationenubergreifendes-kultur-und-nachbarschaftshaus/donations/new?utm_campaign=donate_btn&amp;utm_content=project%2364343&amp;utm_medium=external_banner&amp;utm_source=projects">
<img class="aligncenter" style="border:0px" alt="Jetzt Spenden! Das Spendenformular wird von betterplace.org bereit gestellt." width="160" height="100" src="https://betterplace-assets.betterplace.org/static-images/projects/donation-button-de.png" />
</a>
<br><a href="http://hauseichkamp.de/barrierefreiheit/">-> mehr Info</a>
</span>

	<?php
		echo $args['after_widget'] ;
	}
}

