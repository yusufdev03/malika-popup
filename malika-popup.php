<?php
// custom plugin by yusuf eko n.
/**
 * Plugin Name: Malika Popup
 * Plugin URI: http://malika.id/
 * Description: Generate Coupon Pop Up for Customer
 * Version: 0.0.3
 * Author: Yusuf Eko N.
 * Author URI: http://malika.id/
 */

require_once 'function.php';

if (isset($_POST['mcp_submit'])) {
	include '../../../wp-load.php';
	
	$id_post = get_page_by_title('malika popup setting',OBJECT,'mcp_setting');
	$id_post = $id_post->ID;
	
	if(empty($id_post)){
		$setting = array(
			'post_title' 	=> 'malika popup setting',
			'post_content'	=> '',
			'post_status' 	=> 'publish',
			'post_author' 	=> 1,
			'post_type'		=> 'mcp_setting'
		);
					
		$id_post = wp_insert_post( $setting );
	}
	
	update_post_meta($id_post,'mcp_enable',$_POST['mcp_enable']);
	update_post_meta($id_post,'mcp_expired',$_POST['mcp_expired']);
	update_post_meta($id_post,'mcp_head_log',$_POST['mcp_head_login']);
	update_post_meta($id_post,'mcp_content_log',$_POST['mcp_content_login']);
	update_post_meta($id_post,'mcp_footer_log',$_POST['mcp_footer_login']);
	update_post_meta($id_post,'mcp_head_nlog',$_POST['mcp_head']);
	update_post_meta($id_post,'mcp_content_nlog',$_POST['mcp_content']);
	update_post_meta($id_post,'mcp_footer_nlog',$_POST['mcp_footer']);
	update_post_meta($id_post,'mcp_css_custom',$_POST['mcp_css_custom']);
	update_post_meta($id_post,'mcp_js_custom',$_POST['mcp_js_custom']);
	
	wp_redirect(esc_url( home_url( '/' ) ).'wp-admin/admin.php?page=malika-popup-setting');
}

if(isset($_REQUEST['t'])){
	include '../../../wp-load.php';

	if($_REQUEST['t']=='popup'){
		if(isset($_REQUEST['ty'])){
			$type = $_REQUEST['ty'];
			
			if(isset($_REQUEST['e'])){
				switch($type){
					case "popup":
						$id_post = malika_get_id_post();
						$email = $_REQUEST['e'];
						$email = strtolower($email);
					
						if(empty($id_post)){
							$id_post = malika_insert_post();
						}
					
						malika_check_reg($id_post,$email);
						break;
					case "delete":
						$id = $_REQUEST['e'];
						$code = wc_get_coupon_code_by_id($id);
						delete_post_meta(malika_get_id_post(),'mcp_'.$code);
						wp_delete_post($id);
						echo "data telah di hapus";
						break;
					case "send_mail":
						$email = $_REQUEST['e'];
						$code = '';
						malika_send_mail_coupon($email,$code);
						break;
					default:
						break;
				}
			}
		}
	}
}else{
	require 'admin/admin-setting.php';
}

function malika_popup_activate(){
$id_post = get_page_by_title('malika popup setting',OBJECT,'mcp_setting');
$mcp_setting = get_post_meta($id_post->ID);
foreach($mcp_setting as $key => $_setting){
	$arr_setting[$key] = $_setting[0];
}

$now = strtotime(date('Y-m-d'));
$exp = strtotime(date($arr_setting['mcp_expired']));
	
	if(!empty($arr_setting['mcp_enable']) || $now < $exp){
		$current_user = get_current_user_id();
		if($current_user != 0 || !empty($current_user)){
			$user = get_userdata( $current_user );
			$user_roles = $user->roles;
			$user_roles = $user_roles[0];
			
			if($user_roles=='customer'){
				$email = strtolower($user->user_email);
				$id_post = malika_get_id_post();
				
				if(empty($id_post)){
					$id_post = malika_insert_post();
				}
				
				if(!malika_check_email_reg($id_post,$email)){
					include 'include/popup-coupon.php';
				}
			}
		}else{
			require 'include/popup-coupon.php';
		}
	}
}
add_action('plugins_loaded', 'malika_popup_activate');

function malika_check_reg($id_post,$email){
	if(!malika_check_email_reg($id_post,$email)){
		$code = malika_code_coupon($email);
		$code_check = get_page_by_title( $code,OBJECT,'shop_coupon');
				
		if(!empty($code_check)){
			malika_update_email($id_post,$email,$code);
			malika_send_mail_coupon($email,$code);
//			echo 'kode kupon anda : '.$code;			
		}else{
//			echo 'Maaf untuk sekarang, permintaan kupon anda belum dapat di proses';
		}
	}else{
		echo 'gagal
		';
		$data = [
			'class'  => 'mcp_ups',
			'node'   => '<img src="data:image/png;base64,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">',
			'msg'    => 'uuppss !',
			'status' => 'maaf email anda sudah terdaftar, coba lagi dengan email yang lain'
		];
		print_r(json_encode($data));
	}
}

add_action( 'admin_enqueue_scripts', 'malika_style_admin_popup' );
    
	function malika_style_admin_popup() {
        wp_enqueue_style( 
		'mcp_style',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' 
		);
    }
	
add_action('admin_footer','malika_delete_coupon_reg');
	
function malika_delete_coupon_reg(){
	?>
	<script>
		function mcp_callBack(data,id){
			if(data.innerHTML=="hapus"){
				data.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:20px"></i>';
				malika_request_popup(data,id,"delete");
			}
		}

		function mcp_sendMail(data){
			if(data.innerHTML=="send"){
				data.innerHTML = '<i class="fa fa-spinner fa-spin" style="font-size:20px"></i>';
				var id = document.getElementById("mcp_sendMail");
				id = id.querySelector('[name="email"]').value;
				if(id){
					malika_request_popup(data,id,"send_mail");
				}else{
					data.innerHTML = "send";
					alert("email kosong!!!");
				}
			}
		}
		
		function malika_request_popup(dt,id,ty){
			var str;var ab;
			if (id == '') {
				switch(ty){
					case "delete":
						ab = "hapus";
						break;
					case "send_mail":
						ab = "send";
						break;
					default:
						break;
				}
				dt.innerHTML = ab;
				alert('undefined!!!');
			} else {
				str = 't=popup&ty='+ty+'&e='+id;
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					
				if (this.readyState == 4 && this.status == 200)
					{malika_check_request(dt,this.responseText,ty);}
				};
			xmlhttp.open("GET", "<?php echo malika_this_loc_popup();?>malika-popup.php?" + str, true);
			xmlhttp.send();
			}
		}
		
		function malika_check_request(id,dt,ty){
			switch(ty){
					case "delete":
						id.innerHTML = dt;
						break;
					case "send_mail":
						id.innerHTML = "send";
						alert(dt);
						break;
					default:
						break;
				}
		}
	</script>
		<?php
	}

function malika_this_loc_popup(){
	return plugin_dir_url(__FILE__);
}