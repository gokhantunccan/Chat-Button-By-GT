<?php 
 $absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
 $wp_load = $absolute_path[0] . 'wp-load.php';
 require_once($wp_load);

 
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
  switch ($chat_button_position) {
    case 'left':
      $cb_buttton_container_horizantal="40px";
    break;
    case 'right':
      $cb_buttton_container_horizantal="80px";
    break;

  }
  switch ($chat_button_status) {
    case 0:
      $chat_button_status="hidden";
    break;
    case 1:
      $chat_button_status="visible";
    break;

  }
  


  header('Content-type: text/css');
  header('Cache-control: must-revalidate');


$css="
.tooltiptext_show {
  visibility: $chat_button_status;
  width: 140px;
  line-height: 20px;
  background-color: #$chat_button_tooltip_bgcolor;
  color: #$chat_button_tooltip_txtcolor;
  text-align: center;
  font-size: 14px;
  padding: 5px 0;
  border-radius: 6px;
  position: fixed;
  $chat_button_position: 100px;
  bottom: 70px;
  z-index: 1;
  animation: blinker 5s linear infinite;
  
}
.tooltiptext {
  visibility: hidden;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}

#cb_onoff_button{
  visibility: $chat_button_status;
  width: $chat_button_size;
  height: $chat_button_size;
  background-color: #$chat_button_color;
  border-radius: 50px;
  text-align: center;
  align: center;
  position: fixed;
  $chat_button_position: 30px;
  bottom: 60px;
  z-index: 1;
  //animation: blinker 5s linear infinite;
  
}
#cb_buttton_container{
  line-height: $chat_button_container_height;
  position: fixed;
  $chat_button_position: $cb_buttton_container_horizantal;
  bottom: 160px;
  z-index: 1;
  margin-bottom: $chat_button_margin_top;
}
#cb_button_icon{
  color: #$chat_button_iconcolor;
  font-size: $chat_button_iconsize;
  line-height: $chat_button_vertical_align;
}

$wa_button_css
$tg_button_css
";
echo $css;


 ?>