<?php 

class RenderAssestsClass extends Lecture_Pg {

   public function __construct() { 
   		add_action('wp_enqueue_scripts', array($this, 'render_plugin_aasets_wp_enqueue_scripts'));   //for frontend
   
   }


   function render_plugin_aasets_wp_enqueue_scripts() {

       wp_enqueue_style('lectire_pg_css', CUSTOMPOST_URL . 'assets/css/style.css');
       wp_enqueue_script('lectire_pg_js', CUSTOMPOST_URL . 'assets/js/custom.js', array('jquery'), 1.0);

   
   }

}

new RenderAssestsClass();