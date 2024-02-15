<?php
// Template Setting Malika Popup
$id_post = get_page_by_title('malika popup setting',OBJECT,'mcp_setting');
$mcp_setting = get_post_meta($id_post->ID);
foreach($mcp_setting as $key => $_setting){
	$arr_setting[$key] = $_setting[0];
}

function malika_field_popup( $data ){

	$defaults = array(
      'model'             => 'input',
	  'type'              => 'text',
      'label'             => '',
      'description'       => '',
      'placeholder'       => '',
      'maxlength'         => false,
      'required'          => false,
      'id'                => '',
      'class'             => array(),
      'options'           => array(),
	  'value'             => '',
	  'rows'              => 10,
	  'cols'              => 30,
	  'element'           => ''
	  
	);
	
	foreach($data as $args){
		if(!empty($args['key'])){
			$args = wp_parse_args( $args, $defaults );
			
			$key = $args['key'];
			$field = '';
			$value = '';
			$class = '';
			$place = '';
			if(!empty($args['value'])){
				$args['value'] = 'value="'.$args['value'].'"';
			}
			if(is_array($args['class'])){
				$args['class'] = 'class="'.implode(" ",$args['class']).'"';
			}else{
				$args['class'] = 'class="'.$args['class'].'"';
			}
			if(!empty($args['placeholder'])){
				$args['placeholder'] = 'placeholder="'.$args['placeholder'].'"';
			}
		
			switch($args['model']){
				case 'input':
					$field = mcp_field_input($key,$args);
					break;
				case 'textarea':
					$field = '<textarea name="'.$key.'" rows="'.$args['rows'].'" cols="'.$args['cols'].'">'.$args['description'].'</textarea>';
					break;
				case 'select':
					break;
				case 'custom':
					$field = $args['element'];
					break;
				default:
					break;
			}
			
			echo '<tr>';
			echo '<th scope="row">'.$args['label'].'</th>';
			echo '<td><fieldset>';
			echo '<label for="'.$key.'">';
			echo $field;
			echo '</label>';
			echo '</fieldset></td>';
			echo '</tr>';
		}else{
			echo 'key field not found';
		}
	}
}

function mcp_field_input($key,$args){
	$value = $args['value'];
	$class = $args['class'];
	$place = $args['placeholder'];
	$checkbox = '';

	switch($args['type']){
		case 'text':
			break;
		case 'password':
			break;
		case 'submit':
			break;
		case 'radio':
			if(is_array($args['options'])){
				foreach($args['options'] as $arg){
					$field .= '<input '.$class.' name="'.$key.'" id="'.$key.'_'.$value.'" type="'.$args['type'].'" '.$value.' '.$place.'>';
				}
			}else{
				$field = '<input '.$class.' name="'.$key.'" id="'.$key.'_'.$value.'" type="'.$args['type'].'" '.$value.' '.$place.'>';
			}
			
			return $field;
			break;
		case 'checkbox':
			if($args['checkbox']=='checked' || $args['checkbox']=='on'){
				$checkbox = 'checked';
			}
			break;
		case 'date':
			break;
		default:
			return false;
			break;
	}
	
	$field = '<input '.$class.' name="'.$key.'" id="'.$key.'" type="'.$args['type'].'" '.$value.' '.$place.' '.$checkbox.'>';

	return $field;
}
?>

<div class="wrap">
<h1>Setting Popup</h1>
<form method="post" action="<?php echo malika_this_loc_popup().'malika-popup.php';?>">
    <?php settings_fields( 'malika-popup-coupon-setting' ); ?>
    <?php do_settings_sections( 'malika-popup-coupon-setting' ); ?>
	<table class="form-table">
		<?php
			$args[] = array(
				'key'               => 'mcp_enable',
				'model'             => 'input',
				'type'              => 'checkbox',
				'label'             => 'Aktifkan',
				'value'             => '',
				'checkbox'          => $arr_setting['mcp_enable']
			);
			$args[] = array(
				'key'               => 'mcp_expired',
				'model'             => 'input',
				'type'              => 'date',
				'label'             => 'expired',
				'class'             => array('date-picker','hasDatepicker'),
				'value'             => $arr_setting['mcp_expired']
			);
			malika_field_popup($args)
		?>
	</table>
    <p><h2>User Login</h2></p>
	<table class="form-table">
		<?php
			unset($args);
			$args[] = array(
					'key'               => 'mcp_head_login',
					'model'             => 'input',
					'type'              => 'text',
					'label'             => 'Header',
					'value'             => $arr_setting['mcp_head_log'],
			);
			$args[] = array(
					'key'               => 'mcp_content_login',
					'model'             => 'textarea',
					'label'             => 'Contents',
					'description'       => $arr_setting['mcp_content_log'],
					'rows'              => 10,
					'cols'              => 30
			);
			$args[] = array(
					'key'               => 'mcp_footer_login',
					'model'             => 'textarea',
					'label'             => 'Footer',
					'description'       => $arr_setting['mcp_footer_log'],
					'rows'              => 10,
					'cols'              => 30
			);
			malika_field_popup($args)
		?>
    </table>
	
	<p><h2>User belum login</h2></p>
	<table class="form-table">
		<?php
			unset($args);
			$args[] = array(
					'key'               => 'mcp_head',
					'model'             => 'input',
					'type'              => 'text',
					'label'             => 'Header',
					'value'             => $arr_setting['mcp_head_nlog'],
			);
			$args[] = array(
					'key'               => 'mcp_content',
					'model'             => 'textarea',
					'label'             => 'Contents',
					'description'       => $arr_setting['mcp_content_nlog'],
					'rows'              => 10,
					'cols'              => 30
			);
			$args[] = array(
					'key'               => 'mcp_footer',
					'model'             => 'textarea',
					'label'             => 'Footer',
					'description'       => $arr_setting['mcp_footer_nlog'],
					'rows'              => 10,
					'cols'              => 30
			);
			malika_field_popup($args)
		?>
    </table>
	<p><h2>Custom Scripts</h2></p>
	<table class="form-table">
		<?php
			unset($args);
			$args[] = array(
					'key'               => 'mcp_css_custom',
					'model'             => 'textarea',
					'label'             => 'CSS Custom',
					'description'       => $arr_setting['mcp_css_custom'],
					'rows'              => 10,
					'cols'              => 40
			);
			$args[] = array(
					'key'               => 'mcp_js_custom',
					'model'             => 'textarea',
					'label'             => 'JS Custom',
					'description'       => $arr_setting['mcp_js_custom'],
					'rows'              => 10,
					'cols'              => 40
			);
			malika_field_popup($args)
		?>
    </table>
	<p><h2>Email</h2></p>
	<table class="form-table">
		<?php
				unset($args);
			$args[] = array(
					'key'               => 'mcp_preview_email',
					'model'             => 'custom',
					'label'             => 'Preview Email Popup',
					'element'           => '<div><a href="'.malika_this_loc_popup().'template/coupon_code.php" target="_blank" class="button">Preview</a></div>'
			);
			$args[] = array(
					'key'               => 'mcp_send_mail',
					'model'             => 'custom',
					'label'             => 'Send Email',
					'element'           => '<div id="mcp_sendMail"><input name="email" type="email"><a onclick="mcp_sendMail(this)">send</a></div>'
			);
			malika_field_popup($args)
		?>
    </table>
    
    <?php submit_button('','','mcp_submit'); ?>

</form>
</div>