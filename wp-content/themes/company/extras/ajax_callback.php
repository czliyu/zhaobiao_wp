<?php
//ajax callback for authorized users
add_action("wp_ajax_company_ajax_actions","company_ajax_actions_callback_function");

function company_ajax_actions_callback_function(){
	if( isset($_POST['task']) && $_POST['task'] == "layout_options"){

        if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'company_edit_layout_' ) ){
            wp_die( __('Security check failed','company') );
        }

		foreach( $_POST as $key => $post ){
			if($key != "action" && $key != "task" && $key!= "admin_email" && $key!="header_image" && $key!="body_bg_image" && $key!="body_bg_repeat_x" && $key!="body_bg_repeat_y" && $key!="body_bg_align_x" && $key!="body_bg_align_y" && $key!="primary_menu"){
				$post = sanitize_text_field( $post );
				if( get_theme_mod( "company_".$key ) != $post ){
					set_theme_mod( "company_".$key, $post );
				}
			}
		}
		echo json_encode(array("success"=>1));
		die();
	}
}