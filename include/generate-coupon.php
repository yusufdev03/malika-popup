<?php

function malika_code_coupon($email){
$coupon_code = malika_generate_code(); // Code
$amount = '20'; // Amount
$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product
					
$coupon = array(
	'post_title' => $coupon_code,
	'post_content' => '',
	'post_status' => 'publish',
	'post_author' => 1,
	'post_type'		=> 'shop_coupon'
);
					
$new_coupon_id = wp_insert_post( $coupon );
					
// Add meta
// -- general
update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
update_post_meta( $new_coupon_id, 'expiry_date', malika_expire_coupon());
// -- used limited
update_post_meta( $new_coupon_id, 'minimum_amount', 1 );
update_post_meta( $new_coupon_id, 'maximum_amount', '' );
update_post_meta( $new_coupon_id, 'individual_use', 'no' );
update_post_meta( $new_coupon_id, 'product_ids', '' );
update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
update_post_meta( $new_coupon_id, 'product_categories', '' );
update_post_meta( $new_coupon_id, 'exclude_product_categories', 284 );
update_post_meta( $new_coupon_id, 'customer_email', $email );
update_post_meta( $new_coupon_id, 'email_restrictions', $email );
// -- used limit
update_post_meta( $new_coupon_id, 'usage_limit', 1 );
update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '' );
update_post_meta( $new_coupon_id, 'usage_limit_per_user', 1 );

return $coupon_code;
}

function malika_generate_code($j=8){
$string = "";
    for($i=0;$i < $j;$i++){
        srand((double)microtime()*1234567);
        $x = mt_rand(0,2);
        switch($x){
            case 0:$string.= chr(mt_rand(97,122));break;
            case 1:$string.= chr(mt_rand(65,90));break;
            case 2:$string.= chr(mt_rand(48,57));break;
        }
    }
return strtoupper($string); //to uppercase
}

function malika_expire_coupon(){
$tgl1 = date('Y-m-d'); // now date
$tgl2 = date('Y-m-d', strtotime('+30 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
return $tgl2;
}