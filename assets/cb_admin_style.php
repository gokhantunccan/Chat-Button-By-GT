<?php 
 $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 $wp_load = $absolute_path[0] . 'wp-load.php';
 require_once($wp_load);
 //require_once('../../../../wp-load.php');

  $wa_button_css=get_button_data_array(0)['button_css'];
  $tg_button_css=get_button_data_array(1)['button_css'];
  $settings_xml = get_cb_button_xml();
  $chat_button_status=$settings_xml->cb_mainbutton_status;
  $chat_button_tooltip=$settings_xml->cb_mainbutton_tooltip;
  $chat_button_position=$settings_xml->cb_mainbutton_position;
  $chat_button_color=$settings_xml->cb_mainbutton_color;
  $chat_button_tooltip_bgcolor=$settings_xml->cb_mainbutton_tooltip_bgcolor;
  $chat_button_tooltip_txtcolor=$settings_xml->cb_mainbutton_tooltip_txtcolor;
  $chat_button_iconcolor=$settings_xml->cb_mainbutton_iconcolor;
  $chat_button_size=$settings_xml->cb_mainbutton_size."px";
  $chat_button_iconsize=$settings_xml->cb_mainbutton_iconsize."px";
  $chat_button_vertical_align=$settings_xml->cb_mainbutton_vertical_align."px";
  $chat_button_margin_top=$settings_xml->cb_mainbutton_margin_top."px";
  $chat_button_container_height=$settings_xml->cb_mainbutton_container_height."px";

  header('Content-type: text/css');
  header('Cache-control: must-revalidate');


$css="#cb_onoff_button {
  width: $chat_button_size;
  height: $chat_button_size;
  background-color: #$chat_button_color;
  margin-top: $chat_button_margin_top;
  border-radius: 50px;
  text-align: center;
  align: center;
  z-index: 1;
  
}
#cb_button_icon {
  color: #$chat_button_iconcolor;
  font-size: $chat_button_iconsize;
  line-height: $chat_button_vertical_align;
}

#cb_buttton_container{
  line-height: $chat_button_container_height;
  z-index: 1;
  margin-bottom: 40px;
  margin-left: 5px;
}

$wa_button_css
$tg_button_css


.tooltiptext {
  width: 140px;
  line-height: 20px;
  background-color: #$chat_button_tooltip_bgcolor;
  color: #$chat_button_tooltip_txtcolor;
  text-align: center;
  font-size: 14px;
  padding: 5px 0;
  margin-left: 20px;
  margin-top: 10px;
  border-radius: 6px;
  position: absolute;
  //left: 100px;
  //bottom: 70px;
  z-index: 1;
}

* {
  box-sizing: border-box;
}
.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
.main {
  float: left;
  width: 40%;
  padding: 0 20px;
  overflow: hidden;
}
.right {
  float: left;
  width: 40%;
  padding: 10px 15px;
  margin-top: 7px;
}

@media only screen and (max-width:800px) {
  /* For tablets: */
  .main {
    width: 80%;
    padding: 0;
  }
  .right {
    width: 100%;
  }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width: 100%;
  }

}
";
echo $css;


 ?>