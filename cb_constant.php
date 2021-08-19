<?php 
//---Constant-----------------------------------------------------------------------------

$wa_css='#cb_wa_icon{
  color: white;
  font-size: 22px; /*WA-ICON-SIZE*/
}

#cb_wa_button{
  width: 40px; /*WA-BUTTON-WIDTH*/
  height: 40px; /*WA-BUTTON-HEIGHT*/
  line-height: 39px; /*WA-VERTICAL-ALIGN*/
  background-color: #25D366; /*WA-BGCOLOR*/
  border-radius: 40px;
  position: fixed;
  text-align: center;
  align: center;
}';
$tg_css='#cb_tg_icon{
  color: white;
  font-size: 22px; /*TG-ICON-SIZE*/
}

#cb_tg_button{
  width: 40px; /*TG-BUTTON-WIDTH*/
  height: 40px; /*TG-BUTTON-HEIGHT*/
  line-height: 39px; /*TG-VERTICAL-ALIGN*/
  background-color: #0088cc; /*TG-BGCOLOR*/
  border-radius: 40px;
  position: fixed;
  text-align: center;
  align: center;
}';

define('PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('PLUGIN_ICON', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktY2hhdC1sZWZ0LWRvdHMtZmlsbCIgdmlld0JveD0iMCAwIDE2IDE2Ij4KICA8cGF0aCBkPSJNMCAyYTIgMiAwIDAgMSAyLTJoMTJhMiAyIDAgMCAxIDIgMnY4YTIgMiAwIDAgMS0yIDJINC40MTRhMSAxIDAgMCAwLS43MDcuMjkzTC44NTQgMTUuMTQ2QS41LjUgMCAwIDEgMCAxNC43OTNWMnptNSA0YTEgMSAwIDEgMC0yIDAgMSAxIDAgMCAwIDIgMHptNCAwYTEgMSAwIDEgMC0yIDAgMSAxIDAgMCAwIDIgMHptMyAxYTEgMSAwIDEgMCAwLTIgMSAxIDAgMCAwIDAgMnoiLz4KPC9zdmc+');
define('PLUGIN_DB_BUTTONS_META_TABLE','cb_buttons_meta');
define('WHATSAPP_BUTTON_ID',0);
define('TELEGRAM_BUTTON_ID',1);
define('BUTTONS_ARRAY', array
(
	0 => array("button_id" => WHATSAPP_BUTTON_ID, "button_name" => "WhatsApp", "button_status" => 0, "button_url" => "https://wa.me/+1XXXXXXXXXX", "button_tooltip" => "Hello!", "button_txt" => "Hello!", "button_css" => ''),
	1 => array("button_id" => TELEGRAM_BUTTON_ID, "button_name" => "Telegram", "button_status" => 0, "button_url" => "https://t.me/telegram", "button_tooltip" => "Hello!", "button_txt" => "Hello!", "button_css" => ''),
));

$cb_plugin_panel_link=admin_url($path = 'admin.php?page=chatbutton-bygt', $scheme = 'admin');
define('CB_PLUGIN_PANEL_LINK',$cb_plugin_panel_link);
define('CB_SETTINGS_XML',PLUGIN_URL.'xml/cb_settings.xml');
define('CB_SETTINGS_XML_PATH',explode('wp-admin', $_SERVER['SCRIPT_FILENAME'])[0].'wp-content/plugins/chatbuttonbygt/xml/cb_settings.xml');
define('CB_WA_BUTTON_CSS_DEFAULT',$wa_css);
define('CB_TG_BUTTON_CSS_DEFAULT',$tg_css);
//---------------------------------------------------------------------------------------

 ?>