<?php 
/*
Plugin Name: Chat Button By GT
Plugin URI: https://gtestcenter.cf
Description: Chat Button By GT Açıklaması
Version: 1.5
Author: GT
Author URI: https://gtestcenter.cf
License: GNU
*/
if (!defined('ABSPATH')) {
    exit;
}

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/gokhantunccan/Chat-Button-By-GT/',
	__FILE__,
	'cb_index'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');


//---Require_Once-------------------------------------------------------------------------
require_once( 'cb_functions.php' );
require_once( 'cb_output.php' );
require_once( 'cb_constant.php' );
//----------------------------------------------------------------------------------------

//---Add_actions--------------------------------------------------------------------------
add_action('admin_menu','cb_eklenti_menu');
//add_action('admin_enqueue_scripts',"header_script_ekle");
//add_action('admin_enqueue_style',"header_css_ekle");
add_action('wp_head',"add_chat_button");
//----------------------------------------------------------------------------------------


//---TO DO LIST Acvitation, Deactivation and Uninstall------------------------------------
register_activation_hook( __FILE__, 'eklenti_aktif_yap' );
register_deactivation_hook( __FILE__, 'eklenti_deaktif_yap' );
register_uninstall_hook( __FILE__, 'eklenti_sil' );
//----------------------------------------------------------------------------------------

 

function cb_eklenti_yonetim(){



	if (empty($_GET['button_link'])){
		$button_link="CB";
		}
		else
		{
			$button_link=$_GET['button_link'];
		}
	
	//---IF POST-----------------------------------------------
	if (!empty($_POST)){

		switch ($button_link) {

		//---WA-POST-------------------------------------------	
		case 'WA':
		if (!empty($_POST['cb_wa_status_form'])){
			$cb_wa_status=1;
			
		}else{
			$cb_wa_status=0;
		}
			
		$form_post_validate=form_validate($_POST); //Form Validate Control
		
		//---WA CSS UPDATE------------------------------------
		$css=get_button_data(WHATSAPP_BUTTON_ID,'button_css');
        $new_css=update_wa_button_css($css, sanitize_text_field($_POST['cb_wa_bgcolor_form']), 'WA-BGCOLOR');
        $new_css=update_wa_button_css($new_css, sanitize_text_field($_POST['cb_wa_iconsize_form']), 'WA-ICON-SIZE');
        $new_css=update_wa_button_css($new_css, sanitize_text_field($_POST['cb_wa_button_width_form']), 'WA-BUTTON-WIDTH');
        $new_css=update_wa_button_css($new_css, sanitize_text_field($_POST['cb_wa_button_height_form']), 'WA-BUTTON-HEIGHT');
        $new_css=update_wa_button_css($new_css, sanitize_text_field($_POST['cb_wa_verticalalign_form']), 'WA-VERTICAL-ALIGN');
        //----------------------------------------------------

		//---WA UPDATE----------------------------------------
		$button_data_form_array = array(
			'button_url' => sanitize_text_field($_POST['cb_wa_url_form']),
			'button_txt' => sanitize_text_field($_POST['cb_wa_txt_form']),
			'button_status' => $cb_wa_status,
			'button_css' => $new_css,
		);      

        echo update_button_data(WHATSAPP_BUTTON_ID,$button_data_form_array);
        //----------------------------------------------------
        break;
        //---WA-POST END--------------------------------------
        
        //---TG-POST-------------------------------------------	
		case 'TG':
		if (!empty($_POST['cb_tg_status_form'])){
			$cb_tg_status=1;
			
		}else{
			$cb_tg_status=0;
		}
			
		$form_post_validate=form_validate($_POST); //Form Validate Control
		
		//---TG CSS UPDATE------------------------------------
		$css=get_button_data(TELEGRAM_BUTTON_ID,'button_css');
        $new_css=update_tg_button_css($css, sanitize_text_field($_POST['cb_tg_bgcolor_form']), 'TG-BGCOLOR');
        $new_css=update_tg_button_css($new_css, sanitize_text_field($_POST['cb_tg_iconsize_form']), 'TG-ICON-SIZE');
        $new_css=update_tg_button_css($new_css, sanitize_text_field($_POST['cb_tg_button_width_form']), 'TG-BUTTON-WIDTH');
        $new_css=update_tg_button_css($new_css, sanitize_text_field($_POST['cb_tg_button_height_form']), 'TG-BUTTON-HEIGHT');
        $new_css=update_tg_button_css($new_css, sanitize_text_field($_POST['cb_tg_verticalalign_form']), 'TG-VERTICAL-ALIGN');
        //----------------------------------------------------

		//---TG UPDATE----------------------------------------
		$button_data_form_array = array(
			'button_url' => sanitize_text_field($_POST['cb_tg_url_form']),
			'button_txt' => sanitize_text_field($_POST['cb_tg_txt_form']),
			'button_status' => $cb_tg_status,
			'button_css' => $new_css,
		);      

        echo update_button_data(TELEGRAM_BUTTON_ID,$button_data_form_array);
        //----------------------------------------------------
        break;
        //---TG-POST END--------------------------------------

        //---CB-POST-------------------------------------------
        case 'CB':
        $form_post_validate=form_validate($_POST); //Form Validate Control
        if (!empty($_POST['cb_cb_status_form'])){
			$cb_cb_status=1;
			
		}else{
			$cb_cb_status=0;
		}

        $cb_button_data_form_array = array(
        	'cb_status' => $cb_cb_status,
        	'cb_tooltip' => sanitize_text_field($_POST['cb_cb_tooltip_form']),
	        'cb_position' => sanitize_text_field($_POST['cb_cb_position_form']),
	        'cb_bgcolor' => sanitize_text_field($_POST['cb_cb_bgcolor_form']),
	        'cb_tooltip_bgcolor' => sanitize_text_field($_POST['cb_cb_tooltip_bgcolor_form']),
	        'cb_tooltip_txtcolor' => sanitize_text_field($_POST['cb_cb_tooltip_txtcolor_form']),
	        'cb_iconcolor' => sanitize_text_field($_POST['cb_cb_iconcolor_form']),
	        'cb_button_size' => sanitize_text_field($_POST['cb_cb_button_size_form']),
	        'cb_iconsize' => sanitize_text_field($_POST['cb_cb_iconsize_form']),
	        'cb_verticalalign' => sanitize_text_field($_POST['cb_cb_verticalalign_form']),
	        'cb_margin_top' => sanitize_text_field($_POST['cb_cb_margin_top_form']),
	        'cb_container_height' => sanitize_text_field($_POST['cb_cb_container_height_form']),
		);

		echo update_cb_button_xml($cb_button_data_form_array); 
        break;
        //---CB-POST END--------------------------------------
    	}
	}
	//---IF POST END------------------------------------------

	//---GET WA BUTTON SETTINGS-------------------------------
	$whatsapp_button_array=get_button_data_array(WHATSAPP_BUTTON_ID);

	$whatsapp_button_id=$whatsapp_button_array['button_id'];
	$whatsapp_button_name=$whatsapp_button_array['button_name'];
	$whatsapp_button_url=$whatsapp_button_array['button_url'];
	$whatsapp_button_tooltip=$whatsapp_button_array['button_tooltip'];
	$whatsapp_button_txt=$whatsapp_button_array['button_txt'];
	$whatsapp_button_status=$whatsapp_button_array['button_status'];
	$whatsapp_button_css=$whatsapp_button_array['button_css'];

	
	$wa_css_bgcolor=get_wa_button_css($whatsapp_button_css, 'WA-BGCOLOR');
	$wa_css_iconsize=get_wa_button_css($whatsapp_button_css, 'WA-ICON-SIZE');
	$wa_css_button_width=get_wa_button_css($whatsapp_button_css, 'WA-BUTTON-WIDTH');
	$wa_css_button_height=get_wa_button_css($whatsapp_button_css, 'WA-BUTTON-HEIGHT');
	$wa_css_verticalalign=get_wa_button_css($whatsapp_button_css, 'WA-VERTICAL-ALIGN');
	//--------------------------------------------------------

	//---GET TG BUTTON SETTINGS-------------------------------
	$telegram_button_array=get_button_data_array(TELEGRAM_BUTTON_ID);

	$telegram_button_id=$telegram_button_array['button_id'];
	$telegram_button_name=$telegram_button_array['button_name'];
	$telegram_button_url=$telegram_button_array['button_url'];
	$telegram_button_tooltip=$telegram_button_array['button_tooltip'];
	$telegram_button_txt=$telegram_button_array['button_txt'];
	$telegram_button_status=$telegram_button_array['button_status'];
	$telegram_button_css=$telegram_button_array['button_css'];

	
	$tg_css_bgcolor=get_tg_button_css($telegram_button_css, 'TG-BGCOLOR');
	$tg_css_iconsize=get_tg_button_css($telegram_button_css, 'TG-ICON-SIZE');
	$tg_css_button_width=get_tg_button_css($telegram_button_css, 'TG-BUTTON-WIDTH');
	$tg_css_button_height=get_tg_button_css($telegram_button_css, 'TG-BUTTON-HEIGHT');
	$tg_css_verticalalign=get_tg_button_css($telegram_button_css, 'TG-VERTICAL-ALIGN');
	//--------------------------------------------------------

	//---GET CHAT BUTTON SETTINGS-------------------------------
	$settings_xml = get_cb_button_xml();
	$chat_button_status=$settings_xml->cb_mainbutton_status;
	$chat_button_tooltip=$settings_xml->cb_mainbutton_tooltip;
	$chat_button_position=$settings_xml->cb_mainbutton_position;
	$chat_button_color=$settings_xml->cb_mainbutton_color;
	$chat_button_tooltip_bgcolor=$settings_xml->cb_mainbutton_tooltip_bgcolor;
	$chat_button_tooltip_txtcolor=$settings_xml->cb_mainbutton_tooltip_txtcolor;
	$chat_button_iconcolor=$settings_xml->cb_mainbutton_iconcolor;
	$chat_button_size=$settings_xml->cb_mainbutton_size;
	$chat_button_iconsize=$settings_xml->cb_mainbutton_iconsize;
	$chat_button_vertical_align=$settings_xml->cb_mainbutton_vertical_align;
	$chat_button_margin_top=$settings_xml->cb_mainbutton_margin_top;
	$chat_button_container_height=$settings_xml->cb_mainbutton_container_height;
	//----------------------------------------------------------
	
?>
<link rel="stylesheet" href="<?=PLUGIN_URL."assets/cb_admin_style.php"?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<div style="background-color:#f1f1f1;padding:15px;">
  <h1>Chat Button By GT</h1>
  <h3>Plugin Control Panel</h3>
</div>
<hr>
<div style="overflow:auto">
  <div class="menu">
    <div class="menuitem"><a href="<?=CB_PLUGIN_PANEL_LINK?>&button_link=CB">Chat Button</a></div>
    <div class="menuitem"> <a href="<?=CB_PLUGIN_PANEL_LINK?>&button_link=WA">WhatsApp</a> </div>
    <div class="menuitem"><a href="<?=CB_PLUGIN_PANEL_LINK?>&button_link=TG">Telegram</a></div>
  </div>

  <div class="main">
  	<?php if ($button_link=="CB") {?>
    <h2>Chat Button Settings:</h2>
    <p>
    	<form method="post">
		<input type="checkbox" <?php if ($chat_button_status==1){?>checked<?php }?> name="cb_cb_status_form"><label for="cb_cb_status_form">Chat Button Enable</label><br><br>
		<label for="cb_cb_tooltip_form">Tooltip:</label><br>
		<textarea name="cb_cb_tooltip_form" cols="35" rows="3" placeholder="Tooltip Text"><?=$chat_button_tooltip?></textarea>
		<br>
		<label for="cb_cb_position_form">Chat Button Position:</label><br>
		<select name="cb_cb_position_form" id="cb_cb_position_form">
		  <option value="left" <?php if ($chat_button_position=="left"){?> selected <?php }?>>Left</option>
		  <option value="right" <?php if ($chat_button_position=="right"){?> selected <?php }?>>Right</option>
		</select>
		<br>
		<label for="cb_cb_bgcolor_form">Background Color (HEX):</label><br>
		<input type="text" name="cb_cb_bgcolor_form" required size=32 placeholder="Default: 800080" maxlength="6" minlength="6" value="<?=$chat_button_color?>"> Default: 800080
		<br>
		<label for="cb_cb_tooltip_bgcolor_form">Tooltip Background Color (HEX):</label><br>
		<input type="text" name="cb_cb_tooltip_bgcolor_form" required size=32 placeholder="Default: 000000" maxlength="6" minlength="6" value="<?=$chat_button_tooltip_bgcolor?>"> Default: 000000
		<br>
		<label for="cb_cb_tooltip_txtcolor_form">Tooltip Text Color (HEX):</label><br>
		<input type="text" name="cb_cb_tooltip_txtcolor_form" required size=32 placeholder="Default: FFFFFF" maxlength="6" minlength="6" value="<?=$chat_button_tooltip_txtcolor?>"> Default: FFFFFF
		<br>
		<label for="cb_cb_iconcolor_form">Icon Color (HEX):</label><br>
		<input type="text" name="cb_cb_iconcolor_form" required size=32 placeholder="Default: FFFFFF" maxlength="6" minlength="6" value="<?=$chat_button_iconcolor?>"> Default: FFFFFF
		<br>
		<label for="cb_cb_button_size_form">Button Size (px):</label><br>
		<input type="number" name="cb_cb_button_size_form" required style="width: 8em" placeholder="Default: 55" max="99" min="10" value="<?=$chat_button_size?>"> Default: 55
		<br>
		<label for="cb_cb_iconsize_form">Icon Size (px):</label><br>
		<input type="number" name="cb_cb_iconsize_form" required style="width: 8em" placeholder="Default: 25" max="99" min="10" value="<?=$chat_button_iconsize?>"> Default: 25
		<br>
		<label for="cb_cb_verticalalign_form">Vertical Align (px):</label><br>
		<input type="number" name="cb_cb_verticalalign_form" required style="width: 8em" placeholder="Default: 60" max="99" min="10" value="<?=$chat_button_vertical_align?>"> Default: 60
		<br>
		<label for="cb_cb_margin_top_form">Margin Top (px):</label><br>
		<input type="number" name="cb_cb_margin_top_form" required style="width: 8em" placeholder="Default: 1" max="99" min="1" value="<?=$chat_button_margin_top?>"> Default: 1
		<br>
		<label for="cb_cb_container_height_form">Container Height (px):</label><br>
		<input type="number" name="cb_cb_container_height_form" required style="width: 8em" placeholder="Default: 45" max="99" min="10" value="<?=$chat_button_container_height?>"> Default: 45
		<br>
		<?php wp_nonce_field('form_control','form_control');?>
		<br>
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  />
		</form>
	</p>
	<?php } ?>
  	<?php if ($button_link=="WA") {?>
    <h2>WhatsApp Button Settings:</h2>
    <p>
 		<form method="post">
		<input type="checkbox" <?php if ($whatsapp_button_status==1){?>checked<?php }?> name="cb_wa_status_form"><label for="cb_wa_status_form">WhatsApp Button Enable</label><br><br>
		<label for="cb_wa_url_form">URL:</label><br>
		<input type="text" name="cb_wa_url_form" placeholder="Enter Url" size=32 value="<?=$whatsapp_button_url?>">
		<br>
		<label for="cb_wa_txt_form">Message:</label><br>
		<textarea name="cb_wa_txt_form" cols="35" rows="3" placeholder="Add Your Message"><?=$whatsapp_button_txt?></textarea><br>
		<label for="cb_wa_bgcolor_form">Background Color (HEX):</label><br>
		<input type="text" name="cb_wa_bgcolor_form" required size=32 placeholder="Default: 25D366" maxlength="6" minlength="6" value="<?=$wa_css_bgcolor?>"> Default: 25D366
		<br>
		<label for="cb_wa_iconsize_form">Icon Size (px):</label><br>
		<input type="number" name="cb_wa_iconsize_form" required style="width: 8em" placeholder="Default: 22" max="99" min="10" value="<?=$wa_css_iconsize?>"> Default: 22
		<br>
		<label for="cb_wa_verticalalign_form">Vertical Align (px):</label><br>
		<input type="number" name="cb_wa_verticalalign_form" required style="width: 8em" placeholder="Default: 39" max="99" min="10" value="<?=$wa_css_verticalalign?>"> Default: 39
		<br>
		<label for="cb_wa_button_width_form">Button Width (px):</label><br>
		<input type="number" name="cb_wa_button_width_form" required style="width: 8em" placeholder="Default: 40" max="99" min="10" value="<?=$wa_css_button_width?>"> Default: 40
		<br>
		<label for="cb_wa_button_height_form">Button Height (px):</label><br>
		<input type="number" name="cb_wa_button_height_form" required style="width: 8em" placeholder="Default: 40" max="99" min="10" value="<?=$wa_css_button_height?>"> Default: 40
		<br>
		<?php wp_nonce_field('form_control','form_control');?>
		<br>
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  />
		</form>
    			
	</p>
	<?php } ?>
	<?php if ($button_link=="TG") {?>
    <h2>Telegram Button Settings:</h2>
    <p>
    	<form method="post">
		<input type="checkbox" <?php if ($telegram_button_status==1){?>checked<?php }?> name="cb_tg_status_form"><label for="cb_tg_status_form">Telegram Button Enable</label><br><br>
		<label for="cb_tg_url_form">URL:</label><br>
		<input type="text" name="cb_tg_url_form" placeholder="Enter Url" size=32 value="<?=$telegram_button_url?>">
		<br>
		<label for="cb_tg_txt_form">Message:</label><br>
		<textarea name="cb_tg_txt_form" cols="35" rows="3" placeholder="Add Your Message"><?=$telegram_button_txt?></textarea><br>
		<label for="cb_tg_bgcolor_form">Background Color (HEX):</label><br>
		<input type="text" name="cb_tg_bgcolor_form" required size=32 placeholder="Default: 0088cc" maxlength="6" minlength="6" value="<?=$tg_css_bgcolor?>"> Default: 0088cc
		<br>
		<label for="cb_tg_iconsize_form">Icon Size (px):</label><br>
		<input type="number" name="cb_tg_iconsize_form" required style="width: 8em" placeholder="Default: 22" max="99" min="10" value="<?=$tg_css_iconsize?>"> Default: 22
		<br>
		<label for="cb_tg_verticalalign_form">Vertical Align (px):</label><br>
		<input type="number" name="cb_tg_verticalalign_form" required style="width: 8em" placeholder="Default: 39" max="99" min="10" value="<?=$tg_css_verticalalign?>"> Default: 39
		<br>
		<label for="cb_tg_button_width_form">Button Width (px):</label><br>
		<input type="number" name="cb_tg_button_width_form" required style="width: 8em" placeholder="Default: 40" max="99" min="10" value="<?=$tg_css_button_width?>"> Default: 40
		<br>
		<label for="cb_tg_button_height_form">Button Height (px):</label><br>
		<input type="number" name="cb_tg_button_height_form" required style="width: 8em" placeholder="Default: 40" max="99" min="10" value="<?=$tg_css_button_height?>"> Default: 40
		<br>
		<?php wp_nonce_field('form_control','form_control');?>
		<br>
		<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  />
		</form>
	</p>
	<?php } ?>
  </div>

  <div class="right">
    <h2>Button Skin:</h2>
    <p>
    	<table>
    		<tr>
    			<td>
    				<div id="cb_buttton_container">
    				<a id="cb_wa_button" style="position: absolute; <?=get_button_status_display(WHATSAPP_BUTTON_ID)?>" href="<?=$whatsapp_button_url."?text=".$whatsapp_button_txt?>" target="_blank"><i id="cb_wa_icon" class="bi bi-whatsapp"></i></a><br style="<?=get_button_status_display(TELEGRAM_BUTTON_ID)?>">
    				<a id="cb_tg_button" style="position: absolute; <?=get_button_status_display(TELEGRAM_BUTTON_ID)?>" href="<?=$telegram_button_url."?text=".$telegram_button_txt?>" target="_blank"><i id="cb_tg_icon"  class="bi bi-telegram"></i></a>
					</div>
				</td>
			 </tr>
			 <tr>
			    <td>
			    	<div id="cb_onoff_button"><i id="cb_button_icon" class="bi bi-chat-right-dots-fill"></i><span id="tooltip" class="tooltiptext"><?=$chat_button_tooltip?></span>
			    	</div>
			    </td>
			 </tr>
		</table>
	</p>
  </div>
</div>				  		
		
<?php
	}

 ?>