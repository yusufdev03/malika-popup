<?php

function malika_check_email_reg($id_post,$email){
	$data = malika_email_reg($id_post);

	if(!empty($data)){
		if (in_array($email, $data)) {
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function malika_email_reg($id_post){
	$data = get_post_meta($id_post);
	$i = 0;
	foreach($data as $val){
		$reg[$i] = $val[0];
		$i += 1;
	}

	return $reg;
}

function malika_email_user(){
	$data = get_users( array( 'fields' => array( 'user_email' ) ) );

	foreach ( $data as $key => $user ) {
		$reg[$key] = $user->user_email;
	}
		return $data;
}

function malika_filter_coupon(){
	$result = array_intersect($array1, $array2);
}

function malika_get_id_post(){
	$id_post = get_page_by_title( 'register-email',OBJECT,'malika_user_coupon');
	
	return $id_post->ID;
}

function malika_update_email($id_post,$email,$code){
	$data = malika_email_reg($id_post);
	
	if(!empty($data)){
		$no = count($data);
	}else{
		$no = 0;
	}
	
	add_post_meta( $id_post, 'mcp_'.$code, $email );
}

function malika_insert_post(){
$user_coupon = 'register-email';

	$coupon = array(
		'post_title' => $user_coupon,
		'post_content' => '',
		'post_status' => 'publish',
		'post_author' => 1,
		'post_type'		=> 'malika_user_coupon'
	);
					
$id_post = wp_insert_post( $coupon );

return $id_post;
}