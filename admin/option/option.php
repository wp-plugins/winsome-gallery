        <?php
        return array(
        'title' => __('<h1>Winsome Gallery Option Panel</h1>', 'vp_textdomain'),
        'logo' => '',
        'menus' => array(
        array(
				'title' => __('<b>Gallery settings</b>', 'vp_textdomain'),
				'name' => 'gallery',
				'icon' => '',
				'controls' => array(
				 

        
				                  array(
								'type' => 'textbox',
								'name' => 'gallery_mode',
								'label' => __('Gallery mode', 'vp_textdomain'),
								'description' => __('Put up gallery view like slide or fade', 'vp_textdomain'),
								'default' => 'slide',
								
								),
								
								  array(
								'type' => 'textbox',
								'name' => 'gallery_speed',
								'label' => __('Gallery items speed', 'vp_textdomain'),
								'description' => __('How fast or slow must be miliseconds', 'vp_textdomain'),
								'default' => '600',
								
								),
				
								  array(
								'type' => 'textbox',
								'name' => 'gallery_counter',
								'label' => __('Gallery items counter', 'vp_textdomain'),
								'description' => __('Enter true for displaying counter', 'vp_textdomain'),
								'default' => 'false',
								
								),
								
								
						
								
										  array(
								'type' => 'textbox',
								'name' => 'gallery_loop',
								'label' => __('Gallery items loop', 'vp_textdomain'),
								'description' => __('Enter true for loop', 'vp_textdomain'),
								'default' => 'true',
								
								),
								
								
								  array(
								'type' => 'textbox',
								'name' => 'gallery_auto',
								'label' => __('Gallery items autoplay', 'vp_textdomain'),
								'description' => __('Enter true for auto play', 'vp_textdomain'),
								'default' => 'false',
								
								),
								
							

								
											  array(
								'type' => 'textbox',
								'name' => 'gallery_lang',
								'label' => __('Gallery items thumbnail\'s title', 'vp_textdomain'),
								'description' => __('Enter title here for your gallery', 'vp_textdomain'),
								'default' => 'new photos',
								
								),
				
							)
			)
		)
        );
        ?>