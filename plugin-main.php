<?php 
/*
Plugin Name: Winsome Gallery
Plugin URI:http://www.mhost.5gbfree.com/demo
Description: This plugin will enable awesome image and video gallery in your wordpress theme via shortcode .
Author: Masum Abdullah
Author URI:http://abdullahmasum.elance.com/
Version: 1.1
*/

	  // add script

	function gallery_wp_latest_jquery() {
		wp_enqueue_script('jquery');
	}
	add_action('init', 'gallery_wp_latest_jquery');


	function gallery_plugin_main_js() {
		wp_enqueue_script( 'customgallery-js', plugins_url( '/js/lightGallery.min.js', __FILE__ ), array('jquery'), 1.0, false);
		wp_enqueue_style( 'customgallery-css', plugins_url( '/css/lightGallery.php', __FILE__ ));
		wp_enqueue_style( 'custgallery-css', plugins_url( '/css/font-awesome.min.css', __FILE__ ));
	}

add_action('init','gallery_plugin_main_js');


	  // add activation code

function gallery_active(){ ?>

	<script type="text/javascript">
	  jQuery(document).ready(function(){
	  
		jQuery("#light-gallery").lightGallery({
		
						mode:"<?php echo  vp_option('gallery_option.gallery_mode') ?>",
						
						speed:<?php echo  vp_option('gallery_option.gallery_speed') ?>,
						
						counter:<?php echo  vp_option('gallery_option.gallery_counter') ?>,
						

					
						auto:<?php echo  vp_option('gallery_option.gallery_auto') ?>,
						
						loop:<?php echo  vp_option('gallery_option.gallery_loop') ?>,
						
						lang: {
							  allPhotos:"<?php echo  vp_option('gallery_option.gallery_lang') ?>"
							  },
				  
		});
		
		  jQuery("#video").lightGallery({
		  
		  
						  mode:"<?php echo  vp_option('gallery_option.gallery_mode') ?>",
						
						speed:<?php echo  vp_option('gallery_option.gallery_speed') ?>,
						
						counter:<?php echo  vp_option('gallery_option.gallery_counter') ?>,
						
						loop:<?php echo  vp_option('gallery_option.gallery_loop') ?>,
						
						lang: {
							  allPhotos:"<?php echo  vp_option('gallery_option.gallery_lang') ?>"
							  },
		  
		  });
		
	  });
	</script>
	<?php
}
add_action('wp_head','gallery_active');



	  // add image custom post support
	  
	 function gallery_register_custom() {
	       
		   register_post_type('image-gallery',
		     array(
			    'labels'=>array(
				         'name'=>__('Images'),
						 'singular_name'=>__('Image')
				),
				'public'=>true,
				'supports'=> array('title','editor','thumbnail'),
				'has_archive'=>true ,
				'rewrite'=>array('slug'=>'image-item')
			 )
		   );
		   
		   register_post_type('utube-gallery',
		     array(
			    'labels'=>array(
				         'name'=>__('Youtube video'),
						 'singular_name'=>__('utube video')
				),
				'public'=>true,
				'supports'=> array('title','thumbnail'),
				'has_archive'=>true ,
				'rewrite'=>array('slug'=>'utube-item')
			 )
		   );
		   
		   
		      }
     add_action('init', 'gallery_register_custom');

	 
	  // add image custom post taxonomy support
	 
	 	function add_custom_taxonomy(){
		
		   register_taxonomy(
		          'image-category', 
				  'image-gallery',
				  array(
				    'hierarchical'=>true,
					'label'=>'Image category',
					'query_var'=>true,
					'show_admin_column'=>true,
					'rewrite'=>array(
									'slug'=>'image-category',
									'with_front'=>true
									)
					)
		       );
			   
			   
			     register_taxonomy(
		          'utube-category',  
				  'utube-gallery', 
				  array(
				    'hierarchical'=>true,
					'label'=>'youtube category',
					'query_var'=>true,
					'show_admin_column'=>true,
					'rewrite'=>array(
									'slug'=>'youtube-category',
									'with_front'=>true
									)
					)
		       );
	   
			   }
			   
		add_action('init','add_custom_taxonomy');
		
		
		
		// Add image gallery Loop 
		
  
  
   function wws_get_image_shortcode($atts){
  
	   extract(shortcode_atts(
	      array(
			   'category'=>'',
	         ),$atts)
			 );
			 $q=new WP_Query(array(
			 
					'post_type'=>'image-gallery',
					'image-category'=>$category
					
					));
					
			$markup='<ul id="light-gallery" class="gallery ">';
			while($q->have_posts()): $q->the_post();
			  $idd=get_the_ID();
			  
	   $large  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large-image' );
        $small  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small_image' );
	
			  
			  $markup.='
					 <li data-src="' . $small[0] . '" alt="' . get_the_title() . '">
                  <a href="#"><img src="' . $large[0] . '" alt="' . get_the_title() . '" /></a>
                      </li>
						';
			endwhile;
			$markup.='</ul>';
			wp_reset_query();
			return $markup;
  }
  add_shortcode('wws_igallery','wws_get_image_shortcode');
  
  

	 /********************* FOR YOUTUBE VIDEO  ************************/
	 
	 
	 
  
   function wws_get_utube_shortcode($atts){
  
	   extract(shortcode_atts(
	      array(
			   'category'=>'',
	         ),$atts)
			 );
			 $q=new WP_Query(array(
			 
					'post_type'=>'utube-gallery',
					'utube-category'=>$category
					
					));
					
			$markup='<ul id="video" class="utube ">';
			while($q->have_posts()): $q->the_post();
			
			  $idd=get_the_ID();
			  
	   $id=vp_metabox('my_vimeo_mb.textbox_vdoid');
		
  $poster  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'small_poster' );
  
			  
			  $markup.='
					  <li data-src="http://www.youtube.com/watch?v='.$id.'">
		 
				<a href="#">
					<div class="play-icon "><i class="fa fa-play "></i></div>
					<img src="' . $poster[0] . '" />
				</a>
						</li>
						';
			endwhile;
			$markup.='</ul>';
			wp_reset_query();
			return $markup;
  }
  add_shortcode('wws_ygallery','wws_get_utube_shortcode'); 
  
 
    // Add set featured image and crop it
	
	

	add_theme_support( 'post-thumbnails', array( 'post','image-gallery' ) ); // Add it for posts
	add_image_size( 'small_image',200, 160, true ); // Normal post thumbnails, hard crop mode
	add_image_size( 'large-image', 600, 300, true ); // Post thumbnails, hard crop mode
	add_image_size( 'small_poster', 500, 300, true );

	 // Add style to admin panel
	
	function admin_style(){
	?>
		<style type="text/css">
		#toplevel_page_gallery_option{
		background:rgba(255,0,0,0.5);
		}
		.active strong{color:green;}
		</style>
	<?php
	}
	add_action('admin_head','admin_style');	




// LOAD VAFPRESS FRAMEWORK

	require_once 'vafpress/bootstrap.php';
 
 
 //////////////////////   OPTION PANEL    //////////////////
 
 
 
     function my_gallery_init_options()
        {
 // Built path to options template array file from plugin directory
	
        $tmpl_opt = plugin_dir_path( __FILE__ ) . '/admin/option/option.php';
		
 // Initialize the Option's object
		
        $theme_options = new VP_Option(array(
        'is_dev_mode' => false,
        'option_key' => 'gallery_option',
        'page_slug' => 'gallery_option',
        'template' => $tmpl_opt,
         'menu_page' => array(),
        'use_auto_group_naming' => true,
        'use_exim_menu' => true,
        'minimum_role' => 'edit_theme_options',
        'layout' => 'fixed',
        'page_title' => __( 'Winsome Gallery', 'vp_textdomain' ),
        'menu_label' => __( 'Winsome Gallery', 'vp_textdomain' ),
        ));
        }
 // the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
 
        add_action( 'after_setup_theme', 'my_gallery_init_options' );
		
	

//////////////////////  YOUTUBE METABOX   //////////////////


        function my_gallery_init_metaboxes()
        {
        // Built path to metabox template array file
        $mb_path = plugin_dir_path( __FILE__ ) . '/admin/metabox.php';
        // Initialize the Metabox's object
        // We can use array or file path to the array specification file.
        $mb = new VP_Metabox(array(
        'id' => 'my_mb',
        'types' => array('post','utube-gallery'),
        'title' => __('<h2 style="color:rgba(255,0,0,0.4);"><b>CLICK ME AND GIVE YOUR YOUTUBE VIDEO ID</b></h2>', 'vp_textdomain'),
        'priority' => 'high',
        'is_dev_mode' => false,
        'template' => $mb_path
        ));
        }
        // the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
        add_action( 'after_setup_theme', 'my_gallery_init_metaboxes' );
			
?>
