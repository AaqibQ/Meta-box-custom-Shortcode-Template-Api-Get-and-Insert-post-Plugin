<?php
/*
Template Name: Brewery
*/
get_header();
?>
<?php 

// $result = wp_remote_retrieve_body(wp_remote_get('https://api.openbrewerydb.org/breweries/?page='));
// echo '<pre>';
// print_r($result);
// echo '</pre>';
// die;


get_breweries_from_api ();
// echo do_shortcode("[post_grid id='1240']");
function get_breweries_from_api() {
    $current_page = ( ! empty( $_POST['current_page'] ) ) ? $_POST['current_page'] : 1;
    $breweries = [];
    $result= wp_remote_retrieve_body( wp_remote_get('https://api.openbrewerydb.org/breweries/?page=' . $current_page . '&per_page=50') );
    $results = json_decode( $result );  
 
    if( ! is_array( $results ) || empty( $results ) ){
        return false;
      }
    
    $breweries = $results;

    echo '<pre>';
    print_r($results);  
    echo '</pre>';

    global $wpdb;
   
    foreach( $breweries as $brewery ){ 
        $brewery_slug = $brewery->name ;  
      
      
         // $query_check = "SELECT * post_id FROM $wpdb->postmeta";
        $query_check = "SELECT ID FROM $wpdb->posts WHERE post_title = '$brewery_slug'";
    //    echo $query_check;
        $myposts = $wpdb->get_results( $wpdb->prepare($query_check) );
     
        // echo $myposts;
        if ( empty ($myposts)) {
            $id = wp_insert_post( [
                'post_name' => $brewery_slug,
                'post_title' => $brewery_slug,
                'post_type' => 'brewery',
                'post_status' => 'publish'
              ] );
           
             
            update_post_meta($id , 'name' , $brewery -> name);
            update_post_meta($id , 'BreweryType' , $brewery -> brewery_type);
            update_post_meta($id , 'street' , $brewery -> street);
            update_post_meta($id , 'city_' , $brewery -> city);
            update_post_meta($id , 'state' , $brewery -> state);
            update_post_meta($id , 'postal_code' , $brewery -> postal_code);
            update_post_meta($id , 'longitude' , $brewery -> longitude);
            update_post_meta($id , 'latitude' , $brewery -> latitude);
            update_post_meta($id , 'phone' , $brewery -> phone);
            update_post_meta($id , 'websites' , $brewery -> website_url);
            update_post_meta($id , 'upadated_at' , $brewery -> updated_at);
            }

    }


    // $current_page = $current_page + 1;
    // wp_remote_post( admin_url('admin-ajax.php?action=get_breweries_from_api'), [
    //   'blocking' => false,
    //   'sslverify' => false, // we are sending this to ourselves, so trust it.
    //   'body' => [
    //     'current_page' => $current_page
    //   ]
    // ] );

    // Should return an array of objects
    // $id = wp_insert_post( [
    //     //   'post_name' => $brewery_slug,
    //       'post_title' => 'post1',
    //       'post_type' => 'brewery',
    //       'post_status' => 'publish'
    //     ] );
    // echo $id;
    // Either the API is down or something else spooky happened. Just be done.
    // if( ! is_array( $results ) || empty( $results ) ){
    //   return false;
    // }
    // die;
  

    
}


?>




<?php get_footer(); ?>