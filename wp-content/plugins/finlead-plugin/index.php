<?php
function form_head() {
  if (!is_admin()) {
    acf_form_head();
  }
}

add_action('init', 'form_head');

// function my_footer_fncs(){
//   acf_enqueue_uploader();
// }
// add_action( 'wp_footer', 'my_footer_fncs', 100);
/**
 * Plugin Name: Fin-Lead Plugin. Added to function.php
 */

 function my_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'city_to_objs',
		'from' => 'gorod',
		'to' => 'nedvizhimost',
    'cardinality' => 'one-to-many'
	) );
}
add_action( 'p2p_init', 'my_connection_types' );

function all_acf_fields( $atts ) {
  $res = '';
  if($fields = get_field_objects()){
    unset($fields["bild"]);
    unset($fields["asin"]);
    unset($fields["preis"]);
    unset($fields["bewertung"]);
    unset($fields["produktname"]);
    $res = "<ul class='data'>";
  
    foreach($fields as $field){
      $res .= "<li class='item'><div class='row'>"
        ."<div class='term col-4'>"
          . $field["label"]
        . "</div>"
        . "<div class='value col-8'>";
          
          if(isset($field["prepend"])) $res .= $field["prepend"]." ";
          if(isset($field["choices"])){
            if(is_array($field["value"])){
              $newarray = array();
              foreach($field["value"] as $value){
                $newarray[] = $field["choices"][$value];
              }
              $res .= implode(",",$newarray);
            } else {
              $res .= $field["choices"][$field["value"]];
            }
          } else { 
            $res .= $field["value"]; 
          } 
          if(isset($field["append"])) $res .= " ".$field["append"];
          $res .= "</div>"
      . "</div></li>";      
    }
    $res .= "</ul>";
  }
  return $res;
}
add_shortcode( 'all_acf_fields', 'all_acf_fields' );

