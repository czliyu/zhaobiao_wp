<?php
if (  class_exists( 'WP_Customize_Control' ) ){

	class WP_Customize_Company_Upgrade_To_Pro extends WP_Customize_Control {
		public $type = "company_upgrade_to_pro";

		public function enqueue() {
			wp_enqueue_style( "company_customizer_control_css", get_template_directory_uri() . "/extras/customizer/style/customizer.css" );
		}

		public function render_content(){

		}

		public function content_template() {
			?>
			<p class="customize-control-title"><?php _e( 'COMPANY UPGRADE TO PRO', 'company' ); ?></p>
			<p class="textfield "><?php _e( 'Go Pro and discover more awesome content!</br>With the professional version of the Company Theme for WordPress you will have access to this list of additional cool features:', 'company' ); ?></p>
			<ul class="company-customizer-upgrade-features" >
				<li><?php _e( 'Homepage layout customization.', 'company' ); ?></li>
				<li><?php _e( 'Additional tools for homepage designFull color control of the layout.', 'company' ); ?></li>
				<li><?php _e( 'Full color control of the layout.', 'company' ); ?></li>
				<li><?php _e( 'Full font and typography control.', 'company' ); ?></li>
				<li><?php _e( 'Google Maps integration.', 'company' ); ?></li>
				<li><?php _e( 'Contact Form.', 'company' ); ?></li>
				<li><?php _e( 'Additional static page templates.', 'company' ); ?></li>
				<li><?php _e( 'Footer customization options.', 'company' ); ?></li>
			</ul>
			<a href="http://huge-it.com/wordpress-theme-company" class="button-primary" target="_blank" ><?php _e( 'Purchase PRO License', 'company' ) ?></a>
			<?php
		}
	}

	class WP_Customize_Company_Product_Notice_Control extends WP_Customize_Control {
		public $type = "company_product_notice";

		public $url;

		public $anchor = false;

		public function enqueue() {
			wp_enqueue_style( "company_customizer_control_css", get_template_directory_uri() . "/extras/customizer/style/customizer.css" );
		}

		public function to_json() {
			parent::to_json();
			$this->json['anchor'] = $this->anchor ? $this->anchor : __( 'Go Pro', 'company' );
			$this->json['label']  = $this->label;
			$this->json['value']  = $this->value();
			$this->json['url']    = $this->url;

		}

		public function render_content() {

		}
		
		public function content_template(){
			?>
			<div class="customizer_product_notice">
				<span class="cutomizer_notice_label">{{data.label}}</span>
				<a class="" href="{{data.url}}" target="_blank">{{data.anchor}}</a>
			</div>
			<?php
		}
	}

	class WP_Customize_Layout_Select_Control extends WP_Customize_Control {
		public $type = 'layout_selection';

		public function enqueue() {
			wp_enqueue_style( "company_customizer_control_css", get_template_directory_uri() . "/extras/customizer/style/customizer.css" );
		}

		public function to_json() {
			parent::to_json();
			$this->json['label'] = $this->label;
			$this->json['value'] = $this->value();
		}

		public function render_content() {

		}


		public function content_template(){
			?>
			<span class="customize-control-title">{{data.label}}</span>
			<ul class="customizer_layout_select_list">
				<li data-sidebar_layout="no" <# if(data.value=="no"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/no-sb.png "; ?>" alt="" />
				</li>
				<li data-sidebar_layout="left" <# if(data.value=="left"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/left-sb.png "; ?>" alt="" />
				</li>
				<li data-sidebar_layout="right" <# if(data.value=="right"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/right-sb.png "; ?>" alt="" />
				</li>
				<li data-sidebar_layout="both-left" <# if(data.value=="both-left"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-left-sb.png "; ?>" alt="" />
				</li>
				<li data-sidebar_layout="both-right" <# if(data.value=="both-right"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-right-sb.png "; ?>" alt="" />
				</li>
				<li data-sidebar_layout="both" <# if(data.value=="both"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-sb.png "; ?>" alt="" />
				</li>
			</ul>
			<input type="hidden" class="layout_select_input" name="layout_select_input" <?php $this->link(); ?> />
			<?php
		}
	}

	/* Google fonts selectbox */
	class WP_Customize_Google_Fonts_Control extends WP_Customize_Control {
		public $type = 'google_fonts_select';

		public $fonts;

		public function enqueue() {

			foreach ( $this->fonts as $font ) {
				$font_name     = str_replace( " ", "+", $font["family"] );
				$font_variants = "";
				$font_subset   = "";
				if ( $font["variants"] ) {
					$font_variants = implode( $font["variants"], "," );
					$font_variants = ":" . $font_variants;
				}
				if ( $font["subsets"] ) {
					$font_subset = implode( $font["subsets"], "," );
					$font_subset = "&subset=" . $font_subset;
				}
				$font_url = "http://fonts.googleapis.com/css?family={$font_name}{$font_variants}{$font_subset}";
				wp_enqueue_style( "company_google_font_" . $font['family'], $font_url );
			}

			wp_enqueue_style( "company_customizer_control_css", get_template_directory_uri() . "/extras/customizer/style/customizer.css" );
		}

		public function to_json() {
			parent::to_json();

			$product = "";

			$this->json['label']   = $this->label;
			$this->json['fonts']   = $this->fonts;
			$this->json['product'] = $product;
			$this->json['value']   = $this->value();
		}

		public function render_content(){

		}


		public function content_template(){
			?>
			<label>
				<span class="customize-control-title">{{data.label}}<span class="product_label">{{data.product_text}}</span></span>
				<select style="font-family:{{data.value}}" class="customize_google_fonts_select" <?php $this->link(); ?>>
					<#
					for(var i=0;i<data.fonts.length;i++){
						#>
						<option <# if(data.value == data.fonts[i].family){ #> selected="selected" <# } #> value="{{data.fonts[i].family}}" style="font-family:{{data.fonts[i].family}}">{{data.fonts[i].family}}</option>
						<#
					}
					#>
				</select>
			</label>
			<?php
		}
	}
	
	class WP_Customize_Footer_Layout_Select_Control extends WP_Customize_Control {
		public $type = 'footer_layout_selection';

		public function enqueue() {
			wp_enqueue_style( "company_customizer_control_css", get_template_directory_uri() . "/extras/customizer/style/customizer.css" );
		}

		public function to_json() {
			parent::to_json();
			$this->json['label'] = $this->label;
			$this->json['value'] = $this->value();
		}

		public function render_content() {

		}


		public function content_template(){
			?>
			<span class="customize-control-title">{{data.label}}</span>
			<ul class="customizer_footer_layout_select_list">
				<li data-val="1" <# if(data.value=="1"){ #> class='active' <# } #> >
						<img src="<?php echo  get_template_directory_uri()."/extras/customizer/images/footer_1.png "; ?>" alt="" />
				</li>
				<li data-val="2" <# if(data.value=="2"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/footer_2.png "; ?>" alt="" />
				</li>
				<li data-val="3" <# if(data.value=="3"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/footer_3.png "; ?>" alt="" />
				</li>
				<li data-val="4" <# if(data.value=="4"){ #> class='active' <# } #> >
						<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/footer_4.png "; ?>" alt="" />
				</li>
			</ul>
			<input type="hidden" class="footer_layout_select_input" name="footer_layout_select_input" <?php $this->link(); ?> />
			<?php
		}
	}
	

}
