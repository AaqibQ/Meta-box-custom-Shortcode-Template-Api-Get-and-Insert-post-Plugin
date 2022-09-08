
<?php 

class DisplayMetaBox {


	public function __construct() {
        
        add_action( 'add_meta_boxes', array($this, 'call_constructor'));
        add_action('save_post' ,  array($this, 'lg_lecture' ));
        add_action('the_post' ,  array($this, 'get_custommeta_the_post'));
        

        }



    function call_constructor(){
        add_meta_box('display_name',  'Display name' , array($this,'display_blog_posts_meta_box_callback'), [ 'post' , 'page'] );

    }

// add_action('admin_init' , function(){
//     add_meta_box('display_name',  'Display name' , 'display_blog_posts_meta_box_callback', [ 'post' , 'page'] );

//  });  
         
// this one call in constructor 
 


function display_blog_posts_meta_box_callback($post_id) {
        $mymetaboxInput = '';
		if ($_GET['post']) {
			$mymetaboxInput = get_post_meta($_GET['post'], 'mymetabox', true);
		} 
          ?>
 		<label>Enter Minutes Read</label><br><br>
 		<input type="text" name="mymetabox" class='' value="<?php echo $mymetaboxInput; ?> "/>
 		<?php
 	}






function lg_lecture($post_id){

    if(array_key_exists('mymetabox' , $_POST)){
        update_post_meta($post_id, 'mymetabox', $_POST['mymetabox']);
    }

 }



//  render metx on frontend 





function get_custommeta_the_post(){
   $post_id = get_the_id();
//    echo $post_id;

   if ( get_post_type( $post_id ) == 'post' ) {
    $meta = get_post_meta( $post_id, 'mymetabox', true);

    ?>


        <style>
        
        article#post-<?php echo $post_id ?>  {
            background-color : <?php echo $meta ; ?>;
        }

    </style>


    <?php

    // print_r($meta);

    }
  
    // print_r($mymetaboxInput);
    // exit;

}


}
new DisplayMetaBox();