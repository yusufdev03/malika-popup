<?php
session_start();

	$home = home_url( $path = '/');
	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	 if($home==$url && !isset($_SESSION['reg_popup'])){	 
		add_action('wp_enqueue_scripts', 'malika_style_popup');
		function malika_style_popup() {
			wp_enqueue_style(
				'popup_generate',
				malika_this_loc_popup().'asset/css/popup.css'
			);
		}
		
		add_action('wp_head','malika_popup_css');
		function malika_popup_css(){
			$id_post = get_page_by_title('malika popup setting',OBJECT,'mcp_setting');
			$mcp_setting = get_post_meta($id_post->ID);
			foreach($mcp_setting as $key => $_setting){
				$arr_setting[$key] = $_setting[0];
			}
			?>
				<style>
					<?php echo $arr_setting['mcp_css_custom'] ;?>
				</style>
			<?php
		}
		
		
		add_action('wp_footer','malika_popup_js');
		function malika_popup_js(){
			$id_post = get_page_by_title('malika popup setting',OBJECT,'mcp_setting');
			$mcp_setting = get_post_meta($id_post->ID);
			foreach($mcp_setting as $key => $_setting){
				$arr_setting[$key] = $_setting[0];
			}
			
			if(is_user_logged_in()){
				$current_user = get_current_user_id();
				$user = get_userdata( $current_user );
				$header = $arr_setting['mcp_head_log'];
				$content = $arr_setting['mcp_content_log'];
				$footer = $arr_setting['mcp_footer_log'];
				$sty = 'display:none';
				$email = strtolower($user->user_email);
				$submit = 'Lanjut';
				$load_mail = "'".$email."'";
				$class_log = " mcp_login";
			}else{
				$header = $arr_setting['mcp_head_nlog'];
				$content = $arr_setting['mcp_content_nlog'];
				$footer = $arr_setting['mcp_footer_nlog'];
				$sty = '';
				$email = '';
				$submit = 'Dapatkan Diskon';
				$load_mail = "pop.querySelector('[name=\"email\"]').value";
				$class_log = '';
			}
			
			$input_mail = "['input',[['style','".$sty."'],['type','email'],['name','email'],['placeholder','masukkan email kamu disini'],['value','".$email."']],'']";
		?>
				
				<script>
					setTimeout(function(){
					malika_cElement(document.body,['ul',[['style','display:none']],'<li class="active"><a href="#"></a></li>']);
					pop = malika_cElement(document.body,['div',[['id','malika_popup'],['class','popup-wrapper']],'']);malika_popup(pop);
					}, 10000);
					
					function malika_popup(){
						var a;var b;var c;var id;
						a = ['div',[['class','popup-container']],''];b = malika_cElement(pop,a);
						a = ['form',[['method','post'],['class','popup-form']],''];id=malika_cElement(b,a);
						a = ['h2','','<?php echo $header ;?>'];malika_cElement(id,a);
						a = ['p','','<?php echo $content ;?>'];malika_cElement(id,a);				
						a = ['div',[['class','input-group<?php echo $class_log ;?>']],''];b = malika_cElement(id,a);
						a = <?php echo $input_mail;?>;malika_cElement(b,a);
						a = ['a',[['class','popup_submit_email']],'<?php echo $submit ;?>'];c = malika_cElement(b,a);
						a = ['p','','<?php echo $footer ;?>'];malika_cElement(id,a);					
						a = ['a',[['class','popup-close']],'X'];id = malika_cElement(b,a);id.addEventListener("click",malika_popup_close);
						c.addEventListener("click",function() {
							str = <?php echo $load_mail ;?>;
							if (str == '') { 
								alert('kotak email masih kosong!!!');
							} else {
								malika_popup_close();str = 't=popup&ty=popup&e='+str;
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {mcp_popup_info(this.responseText);}
								};
							xmlhttp.open("GET", "<?php echo malika_this_loc_popup();?>malika-popup.php?" + str, true);
							xmlhttp.send();
							}
						});
					}				
					function malika_popup_close(){pop.innerHTML='';pop.classList.add('malika_popup_close');}
					function mcp_popup_info(dt){
						var a;var id;
						dt = dt.split('\n');
						dt = JSON.parse(dt[1]);
						pop.setAttribute('class','popup-wrapper');
						a = ['div',[['class','popup-container'],['style','text-align:center;background-color:#fff']],''];id = malika_cElement(pop,a);
						a = ['form',[['method','post'],['class','popup-form']],''];id=malika_cElement(id,a);
						a = ['div',[['class',dt.class]],dt.node];malika_cElement(id,a);
						a = ['div',[['style','font-weight:bold;font-size:20px;']],dt.msg];malika_cElement(id,a);
						a = ['div',[['style',';font-size:12px;']],dt.status];malika_cElement(id,a);
						a = ['a',[['class','popup-close']],'X'];id = malika_cElement(id,a);id.addEventListener("click",malika_popup_close);
						
					}
					// --------------------------------------------------------
					// --------------- JS Custom Popup malika -----------------
					// --------------------------------------------------------
					<?php echo $arr_setting['mcp_js_custom'] ;?>
				</script>
		<?php
		}
		 
		 $_SESSION['reg_popup'] = 'reg_session';
	}