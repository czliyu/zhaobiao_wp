<?php
function company_save_post_action( $post_id ) {

	// If this is just a revision, don't do anything.
	if ( wp_is_post_revision( $post_id ) )
		return;

	// Check the nonce
	if ( empty( $_REQUEST['company_blog_data_nonce'] ) || ! wp_verify_nonce( $_REQUEST['company_blog_data_nonce'], 'company_save_blog_data' ) ) {
		return;
	}

	// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
	if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
		return;
	}

	// Check user has permission to edit
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if( isset( $_REQUEST['blog_category'] ) ){
		$cat = sanitize_text_field( $_REQUEST['blog_category'] );
		set_theme_mod( "company_blog_category".$post_id, $cat );
	}
}
add_action( 'save_post', 'company_save_post_action' );

add_action( "add_meta_boxes", "company_add_meta_boxes_page" );
function company_add_meta_boxes_page( $post ){
		add_meta_box( 
			'company_editor_layout',
			__( 'Custom Layout', 'company' ), 
			'company_editor_layout', 
			'post', 
			'normal', 
			'high'
		);
		
		add_meta_box( 
			'company_editor_layout',
			__( 'Custom Layout', 'company') , 
			'company_editor_layout', 
			'page', 
			'normal', 
			'high'
		);

}

function company_editor_layout(){
	global $post;
	$id=$post->ID;
	$theme_mods = company_get_theme_mods();
	$layout = isset($theme_mods["company_custom_layout".$id]) ? $theme_mods["company_custom_layout".$id] : "";
	?>
	<script>
		jQuery(document).ready(function(){
			
			jQuery(".sidebar_layout li").on("click",function(){
				if(jQuery(this).hasClass("active")){
					jQuery(this).removeClass("active");
				}else{
					jQuery(this).parent().find("li.active").removeClass("active");
					jQuery(this).addClass("active");
				}
				if(jQuery(this).parent().find("li.active").length){
					var custom_layout<?php echo $id; ?>=jQuery(this).parent().find("li.active").data("sidebar_layout");
				}else{
					var custom_layout<?php echo $id; ?>="";
				}
				var data={
					action:"company_ajax_actions",
					task:"layout_options",
					custom_layout<?php echo $id; ?>:custom_layout<?php echo $id; ?>,
					nonce: '<?php echo wp_create_nonce('company_edit_layout_'.$id); ?>'
				};
				jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>",data,function(response){
					if(response.success){
						jQuery("#custom_sidebar_layout").after("<div class='updated'><strong>Layout auto Saved</strong></div>");
						setTimeout(function(){
							jQuery("#custom_sidebar_layout ~ .updated").remove();
						},3000);
					}
				},"json");
				return false;
			});
		});
	</script>
	<style>
		.sidebar_layout li {
			  display: inline-block;
			width:116px;
			height:80px;
			margin-right:20px;
			border:2px solid #fff;
			cursor:pointer;
			-webkit-transition: 100ms cubic-bezier(0, 0.6, 0.55, 1.4);
			transition: 100ms cubic-bezier(0, 0.6, 0.55, 1.4);
		}
		
		.sidebar_layout li.active {
			border:2px solid #B2B2B2;
			-webkit-animation: rubberBand 0.5s 1; /* Chrome, Safari, Opera */ 
			animation:rubberBand 0.5s 1;
		}
		
		@-webkit-keyframes rubberBand {
		  0% {
			-webkit-transform:scale3d(1.25, 1.25, 1.25);
			transform:scale3d(1.25, 1.25, 1.25);
		  }



		  100% {
			-webkit-transform: scale3d(1, 1, 1);
			transform: scale3d(1, 1, 1);
		  }
		}

		@keyframes rubberBand {
		   0% {
			-webkit-transform:scale3d(1.25, 1.25, 1.25);
			transform:scale3d(1.25, 1.25, 1.25);
		  }
		  100% {
			-webkit-transform: scale3d(1, 1, 1);
			transform: scale3d(1, 1, 1);
		  }
		}


	</style>
	<ul id="custom_sidebar_layout" class="sidebar_layout">
		<li data-sidebar_layout="no" <?php if($layout=="no"){ echo "class='active'"; } ?> >
			<div class="layout_image_block" >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/no-sb.png "; ?>" alt="" />
			</div>
		</li>
		<li data-sidebar_layout="left" <?php if($layout=="left"){ echo "class='active'"; } ?> >
			<div class="layout_image_block" >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/left-sb.png "; ?>" alt="" />
			</div>
		</li>
		<li data-sidebar_layout="right" <?php if($layout=="right"){ echo "class='active'"; } ?> >
			<div class="layout_image_block" >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/right-sb.png "; ?>" alt="" />
			</div>
		</li>
		<li data-sidebar_layout="both-left" <?php if($layout=="both-left"){ echo "class='active'"; } ?> >
			<div class="layout_image_block" >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-left-sb.png "; ?>" alt="" />
			</div>
		</li>
		<li data-sidebar_layout="both-right" <?php if($layout=="both-right"){ echo "class='active'"; } ?> >
			<div class="layout_image_block" >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-right-sb.png "; ?>" alt="" />
			</div>
		</li>
		<li data-sidebar_layout="both" <?php if($layout=="both"){ echo "class='active'"; } ?> >
			<div class="layout_image_block"  >
				<img src="<?php echo get_template_directory_uri()."/extras/customizer/images/both-sb.png "; ?>" alt="" />
			</div>
		</li>
	</ul>
	<?php 
}