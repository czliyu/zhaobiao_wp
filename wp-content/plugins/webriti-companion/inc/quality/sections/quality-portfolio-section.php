<?php
/**
 * Portfolio section for the homepage.
 */
if ( ! function_exists( 'quality_portfolio' ) ) :

	function quality_portfolio() {
		
		$quality_pro_options= companion_theme_data_setup(); 
		$current_theme_content = wp_parse_args(  get_option( 'quality_pro_options', array() ), $quality_pro_options ); 
		
		$current_options = get_option( 'quality_pro_options');
		$hide_section = isset($current_options['home_projects_enabled'])? $current_options['home_projects_enabled']:true;
		$quality_portfolio_title    = isset($current_options['project_heading_one'])? $current_options['project_heading_one'] : esc_html__('Featured portfolio project','webriti-companion');
		$quality_portfolio_subtitle = isset($current_options['project_tagline'])?$current_options['project_tagline']: esc_html__('Maecenas sit amet tincidunt elit. Pellentesque habitant morbi tristique senectus et netus et Nulla facilisi.','webriti-companion');
		$quality_portfolio_button_text = isset($current_options['project_button_text'])?$current_options['project_button_text']: esc_html__('View All Projects','webriti-companion');
		$quality_portfolio_button_link = isset($current_options['project_button_text_link'])?$current_options['project_button_text_link']: '#';
		if (  $hide_section == true ) {
		?>
		
	<div class="qua_portfolio_carusel">
	<div class="container">
		<div class="qua_port_title">
		<?php
		if ( ! empty( $quality_portfolio_title ) || is_customize_preview() ) {
			echo '<h1>' . esc_html( $quality_portfolio_title ) . '</h1>';
		}
		if ( ! empty( $quality_portfolio_subtitle ) || is_customize_preview() ) {
			echo '<p class="description">' . esc_html( $quality_portfolio_subtitle ) . '</p>';
		}
		?>	
		<div class="qua-separator" id=""></div>
		</div>
		<div class="row home_portfolio_row">
		
		<div class="col-md-3 col-sm-6 qua_col_padding quality_project_one" id="quality_project_one">
				<?php if($current_theme_content['project_one_thumb']) { ?>
				<div class="qua_portfolio_image">
					<img  src="<?php echo $current_theme_content['project_one_thumb']; ?>" class="img-responsive" alt="thumb one">
					<div class="qua_home_portfolio_showcase_overlay">
						<div class="qua_home_portfolio_showcase_overlay_inner">
							<div class="qua_home_portfolio_showcase_icons">
								<a href="<?php echo $current_theme_content['project_one_thumb']; ?>" data-lightbox="image" title="Time to raise your voice" class="hover_thumb"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php }
				if($current_theme_content['project_one_title']) { ?>
				<div class="qua_home_portfolio_caption">
					<a href="#"><?php echo $current_theme_content['project_one_title']; ?></a>			
				</div>
				<?php } ?>
			</div>
			
			<div class="col-md-3 col-sm-6 qua_col_padding" id="quality_project_two">
				<?php if($current_theme_content['project_two_thumb']) { ?>
				<div class="qua_portfolio_image">
					<img  src="<?php echo $current_theme_content['project_two_thumb']; ?>" class="img-responsive" alt="thumb one">
					<div class="qua_home_portfolio_showcase_overlay">
						<div class="qua_home_portfolio_showcase_overlay_inner">
							<div class="qua_home_portfolio_showcase_icons">
								<a href="<?php echo $current_theme_content['project_two_thumb']; ?>" data-lightbox="image" title="Time to raise your voice" class="hover_thumb"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php }
				if($current_theme_content['project_two_title']) { ?>
				<div class="qua_home_portfolio_caption">
					<a href="#"><?php echo $current_theme_content['project_two_title']; ?></a>			
				</div>
				<?php } ?>
			</div>
			
			<div class="col-md-3 col-sm-6 qua_col_padding" id="quality_project_three">
				<?php if($current_theme_content['project_three_thumb']) { ?>
				<div class="qua_portfolio_image">
					<img  src="<?php echo $current_theme_content['project_three_thumb']; ?>" class="img-responsive" alt="thumb one">
					<div class="qua_home_portfolio_showcase_overlay">
						<div class="qua_home_portfolio_showcase_overlay_inner">
							<div class="qua_home_portfolio_showcase_icons">
								<a href="<?php echo $current_theme_content['project_three_thumb']; ?>" data-lightbox="image" title="Time to raise your voice" class="hover_thumb"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php }
				if($current_theme_content['project_three_title']) { ?>
				<div class="qua_home_portfolio_caption">
					<a href="#"><?php echo $current_theme_content['project_three_title']; ?></a>			
				</div>
				<?php } ?>
			</div>
			
			<div class="col-md-3 col-sm-6 qua_col_padding" id="quality_project_four">
				<?php if($current_theme_content['project_four_thumb']) { ?>
				<div class="qua_portfolio_image">
					<img  src="<?php echo $current_theme_content['project_four_thumb']; ?>" class="img-responsive" alt="thumb one">
					<div class="qua_home_portfolio_showcase_overlay">
						<div class="qua_home_portfolio_showcase_overlay_inner">
							<div class="qua_home_portfolio_showcase_icons">
								<a href="<?php echo $current_theme_content['project_four_thumb']; ?>" data-lightbox="image" title="Time to raise your voice" class="hover_thumb"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php }
				if($current_theme_content['project_four_title']) { ?>
				<div class="qua_home_portfolio_caption">
					<a href="#"><?php echo $current_theme_content['project_four_title']; ?></a>			
				</div>
				<?php } ?>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="qua_proejct_button">
			<a href="<?php echo $quality_portfolio_button_link; ?>"> <?php _e( $quality_portfolio_button_text ); ?> </a>
			</div>			
		</div>
	</div>
</div>
		<?php
}
	}

endif;

		if ( function_exists( 'quality_portfolio' ) ) {
		$section_priority = apply_filters( 'quality_section_priority', 11, 'quality_portfolio' );
		add_action( 'quality_sections', 'quality_portfolio', absint( $section_priority ) );

		}
	function companion_theme_data_setup()
{	
	return $theme_options=array(
			
			//Projects Section Settings
			
			'project_one_thumb' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port1.jpg',
			'project_one_title' => 'Lorem Ipsum',
			
		    'project_two_thumb' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port2.jpg',
			'project_two_title' => 'Postao je popularan',
			
			'project_three_thumb' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port3.jpg',
			'project_three_title' => 'kojekakve promjene s',
			
			'project_four_thumb' => WC__PLUGIN_URL .'/inc/quality/images/portfolio/home-port4.jpg',
			'project_four_title' => 'kojekakve promjene s',
			
			
			
			
		);
}	
		

