<?php 
/*
 Plugin Name: Advance Pet Care Pro Posttype
 Plugin URI: https://www.themeshopy.com/
 Description: Creating new post type for Advance Pet Care Pro Theme.
 Author: Themeshopy
 Version: 1.0
 Author URI: https://www.themeshopy.com/
*/

define( 'ADVANCE_PET_CARE_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'advance_pet_care_pro_posttype_create_post_type' );

function advance_pet_care_pro_posttype_create_post_type() {
  
  register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => __( 'Testimonials','advance-pet-care-pro-posttype' ),
        'singular_name' => __( 'Testimonials','advance-pet-care-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-businessman',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Our Team','advance-pet-care-pro-posttype' ),
        'singular_name' => __( 'Our Team','advance-pet-care-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

/*----------------------Testimonial section ----------------------*/
/* Adds a meta box to the Testimonial editing screen */
function advance_pet_care_pro_posttype_bn_testimonial_meta_box() {
  add_meta_box( 'advance-pet-care-pro-posttype-testimonial-meta', __( 'Enter Details', 'advance-pet-care-pro-posttype' ), 'advance_pet_care_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'advance_pet_care_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function advance_pet_care_pro_posttype_bn_testimonial_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'advance_pet_care_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  if(!empty($bn_stored_meta['advance_pet_care_pro_posttype_testimonial_desigstory'][0]))
      $bn_advance_pet_care_pro_posttype_testimonial_desigstory = $bn_stored_meta['advance_pet_care_pro_posttype_testimonial_desigstory'][0];
    else
      $bn_advance_pet_care_pro_posttype_testimonial_desigstory = '';
  ?>
  <div id="testimonials_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Designation', 'advance-pet-care-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="advance_pet_care_pro_posttype_testimonial_desigstory" id="advance_pet_care_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $bn_advance_pet_care_pro_posttype_testimonial_desigstory ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function advance_pet_care_pro_posttype_bn_metadesig_save( $post_id ) {
  if (!isset($_POST['advance_pet_care_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['advance_pet_care_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'advance_pet_care_pro_posttype_testimonial_desigstory' ] ) ) {
    update_post_meta( $post_id, 'advance_pet_care_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'advance_pet_care_pro_posttype_testimonial_desigstory']) );
  }
}

add_action( 'save_post', 'advance_pet_care_pro_posttype_bn_metadesig_save' );

/*------------------------- Team Section-----------------------------*/
/* Adds a meta box for Designation */
function advance_pet_care_pro_posttype_bn_team_meta() {
    add_meta_box( 'advance_pet_care_pro_posttype_bn_meta', __( 'Enter Details','advance-pet-care-pro-posttype' ), 'advance_pet_care_pro_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'advance_pet_care_pro_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function advance_pet_care_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'advance_pet_care_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    if(!empty($bn_stored_meta['meta-desig'][0]))
      $bn_meta_desig = $bn_stored_meta['meta-desig'][0];
    else
      $bn_meta_desig = '';

    //facebook details
    if(!empty($bn_stored_meta['meta-facebookurl'][0]))
      $bn_meta_facebookurl = $bn_stored_meta['meta-facebookurl'][0];
    else
      $bn_meta_facebookurl = '';

    //linkdenurl details
    if(!empty($bn_stored_meta['meta-linkdenurl'][0]))
      $bn_meta_linkdenurl = $bn_stored_meta['meta-linkdenurl'][0];
    else
      $bn_meta_linkdenurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-twitterurl'][0]))
      $bn_meta_twitterurl = $bn_stored_meta['meta-twitterurl'][0];
    else
      $bn_meta_twitterurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-googleplusurl'][0]))
      $bn_meta_googleplusurl = $bn_stored_meta['meta-googleplusurl'][0];
    else
      $bn_meta_googleplusurl = '';

    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-0">
                  <td class="left">
                    <?php _e( 'Designation', 'advance-pet-care-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-desig" id="meta-desig" value="<?php echo esc_attr( $bn_meta_desig ); ?>" />
                  </td>
                </tr>
                <tr id="meta-1">
                  <td class="left">
                    <?php esc_html_e( 'Facebook Url', 'advance-pet-care-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-facebookurl" id="meta-facebookurl" value="<?php echo esc_url($bn_meta_facebookurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-2">
                  <td class="left">
                    <?php esc_html_e( 'Linkedin URL', 'advance-pet-care-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-linkdenurl" id="meta-linkdenurl" value="<?php echo esc_url($bn_meta_linkdenurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php esc_html_e( 'Twitter Url', 'advance-pet-care-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-twitterurl" id="meta-twitterurl" value="<?php echo esc_url( $bn_meta_twitterurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php esc_html_e( 'GooglePlus URL', 'advance-pet-care-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-googleplusurl" id="meta-googleplusurl" value="<?php echo esc_url($bn_meta_googleplusurl); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function advance_pet_care_pro_posttype_ex_bn_metadesig_save( $post_id ) {
    if( isset( $_POST[ 'meta-desig' ] ) ) {
        update_post_meta( $post_id, 'meta-desig', esc_html($_POST[ 'meta-desig' ]) );
    }
    
    // Save facebookurl
    if( isset( $_POST[ 'meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-facebookurl', esc_url($_POST[ 'meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-linkdenurl', esc_url($_POST[ 'meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-twitterurl', esc_url($_POST[ 'meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-googleplusurl', esc_url($_POST[ 'meta-googleplusurl' ]) );
    }
}
add_action( 'save_post', 'advance_pet_care_pro_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'advance_pet_care_pro_posttype_team_featured' ] )) {
      update_post_meta( $post_id, 'advance_pet_care_pro_posttype_team_featured', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'advance_pet_care_pro_posttype_team_featured', esc_attr(0));
  }
}
/*------------------------ Team Shortcode --------------------------*/
function advance_pet_care_pro_posttype_team_func( $atts ) {
    $team = ''; 
    $team = '<div class="row" id="team">';
      $new = new WP_Query( array( 'post_type' => 'team') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = advance_pet_care_pro_string_limit_words(get_the_excerpt(),5);
          $desig = get_post_meta($post_id,'meta-desig',true);          
          $facebookurl = get_post_meta($post_id,'meta-facebookurl',true);
          $linkedin = get_post_meta($post_id,'meta-linkdenurl',true);
          $twitter = get_post_meta($post_id,'meta-twitterurl',true);
          $googleplus = get_post_meta($post_id,'meta-googleplusurl',true);

          $team .= '<div class="col-md-4 col-sm-2">
            <div class="box">';
              if (has_post_thumbnail()){
               $team .= '<img src="'.esc_url($url).'">
                <div class="overlay">
                  <div class="box-content">
                    <div class="teambox-content">
                      <h4 class="teamtitle"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
                      $team .= '<span class="teampost">'.$excerpt.'</span>
                      <div class="socialbox">';
                        if($facebookurl != '' || $linkedin != '' || $twitter != '' || $googleplus != ''){?>
                          <?php if($facebookurl != ''){
                            $team .= '<a class="" href="'.esc_url($facebookurl).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                           } if($twitter != ''){
                            $team .= '<a class="" href="'.esc_url($twitter).'" target="_blank"><i class="fab fa-twitter"></i></a>';                          
                           } if($linkedin != ''){
                           $team .= ' <a class="" href="'.esc_url($linkedin).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                          }if($googleplus != ''){
                            $team .= '<a class="" href="'.esc_url($googleplus).'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                          }
                        }
                      $team .= '</div>
                    </div>
                  </div>
                </div>';
              }
            $team .= '</div>
            </div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $team = '<div id="team" class="team_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','advance-pet-care-pro-posttype').'</h2></div>';
      endif;
    $team .= '</div>';
    return $team;
}
add_shortcode( 'advance-pet-care-pro-team', 'advance_pet_care_pro_posttype_team_func' );

/*------------------- Testimonial Shortcode -------------------------*/
function advance_pet_care_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = advance_pet_care_pro_string_limit_words(get_the_excerpt(),20);
          $designation = get_post_meta($post_id,'advance_pet_care_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-md-6 mb-4">
                <div class="testimonial_box w-100 mb-3" >
                  <div class="image-box media">';
                    if (has_post_thumbnail()){ 
                   $testimonial .= '<img src="'.esc_url($url).'">';
                   } 
                   $testimonial .= '<div class="testimonial-box media-body">
                    <div class="content_box w-100">
                      <div class="short_text pt-1 pl-2"><blockquote>'.$excerpt.'</blockquote></div>
                    </div>                  
                    <div class="testimonial_name_designation">';
                      $custom_url = ''; if(get_post_meta(get_the_ID(), 'meta-testimonial-url', true !='')){  $custom_url = get_post_meta(get_the_ID(), 'meta-testimonial-url', true); } 
                      $testimonial .='<h4 class="testimonial_name mt-0"><a href="<'.  get_the_permalink().'">'. get_the_title().'</a></h4>
                      <h5 class="border_heading">'.esc_html($designation).' </h5>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','advance-pet-care-pro-posttype').'</h2></div>';
      endif;
    $testimonial .= '</div></div>';
    return $testimonial;
}
add_shortcode( 'advance-pet-care-pro-testimonials', 'advance_pet_care_pro_posttype_testimonials_func' );

