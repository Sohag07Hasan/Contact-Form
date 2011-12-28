<?php
/*
 * plugin name: Contact From Customized
 * description: This will add a contact form below every care details for the buyer to coantact with the site holder
 * author: Mahibul Hasan
 * plugin uri: http://usedcarwestpalmbeach.net/
 * author uri: http://sohag07hasan.elance.com
 * 
 * */
 
 if(!class_exists('ove_contact_info')) : 
 
	class ove_contact_info{
		function __construct(){
			add_action('ove_contact_form',array($this,'contact_form'));
		}
		
		function contact_form($post){
			
			//if the form is submitted
			$notification = '';
			
			if($_POST['ove_conatact_form'] == 'Y') :
				if(!function_exists('wp_mail')){
					include ABSPATH . 'wp-includes/pluggable.php';
				}
				include dirname(__FILE__) . '/includes/form-submitted.php';
			endif;
			
			$vin = get_post_meta($post->ID, 'vin_value', true);
			$mmr = $this->mmr_sanitization(get_post_meta($post->ID, 'mmr_value', true));
			$ove_link = 'https://www.ove.com/vdp/show/' . $mmr;
			$retail_link = 'https://www.ove.com/listing/retail_view/' . $mmr;
			
			echo $notification;
			?>
			
			<style type='text/css'>
				div.error, div.updated{
					margin: 5px 0 15px;
					border-radius: 3px 3px 3px 3px;
					border-style: solid;
					border-width: 1px;
					padding: 0 0.6em;
				}
				div.updated{
					background-color: #FFFFE0;
					border-color: #E6DB55;					
				}
				div.error{
					background-color: #FFEBE8;
					border-color: #CC0000;	
				}
				
			</style>
			
			<form action='' method='post' id="commentsform">
				<input type='hidden' name='ove_conatact_form' value='Y' />
				
				<input type='hidden' name='ove_vin' value="<?php echo $vin; ?>" />
				<input type='hidden' name='ove_link' value="<?php echo $ove_link; ?>" />
				<input type='hidden' name='retail_link' value="<?php echo $retail_link; ?>" />
				
				<p>
					<label for="buyer_name">Name <span>(required)</span></label>
					<br />
					<input type="text" name="buyer_name" value='' size="40" tabindex="1" />
				</p>
				<p>
					<label for="buyer_email">Email <span>(required)</span></label>
					<br />
					<input type="text" name="buyer_email" value='' size="40" tabindex="2" />
				</p>
				<p>
					<label for="buyer_phone">Phone <span>(required) xxx-xxx-xxxx </span></label>
					<br />
					<input type="text" name="buyer_phone" value='' size="40" tabindex="3" />
				</p>
				<p>
					<label for="buyer_subject">Subject <span>(required)</span></label>
					<br />
					<input type="text" name="buyer_subject" value="<?php echo $post->post_title; ?>" size="40" tabindex="3" />
				</p>
				
				<p>
					<label for="buyer_message">Message <span>(required)</span></label>
					<br/>
					<textarea name="buyer_message" rows="8"></textarea>
				</p>
				<input type="submit" name='conatact-form-submit' value='Send'>
			
			</form>
			
			<?
		}
		
		function mmr_sanitization($mmr){
			preg_match('/<tr id="above_mmr_\d+">/',$mmr,$b);
			return preg_replace('/[^\d]/','',$b[0]);
		}
	}
	
	$ove_contact = new ove_contact_info();
 
 endif;

?>
