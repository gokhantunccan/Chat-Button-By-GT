<?php 
if (!defined('ABSPATH')) {
    exit;
}

function add_chat_button(){
    $whatsapp_button_array=get_button_data_array(WHATSAPP_BUTTON_ID);
    $telegram_button_array=get_button_data_array(TELEGRAM_BUTTON_ID);
    $settings_xml = get_cb_button_xml();
    $chat_button_tooltip=$settings_xml->cb_mainbutton_tooltip;

    
?>
<link rel="stylesheet" href="<?=PLUGIN_URL."assets/cb_output_style.php"?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<div id="cb_buttton_container" style="display: none;">
    <a id="cb_wa_button" style="<?=get_button_status_display(WHATSAPP_BUTTON_ID)?>" href="<?=$whatsapp_button_array['button_url']."?text=".$whatsapp_button_array['button_txt']?>" target="_blank"><i id="cb_wa_icon" class="bi bi-whatsapp"></i></a>
    <br style="<?=get_button_status_display(TELEGRAM_BUTTON_ID)?>"><a id="cb_tg_button" style="<?=get_button_status_display(TELEGRAM_BUTTON_ID)?>" href="<?=$telegram_button_array['button_url']."?text=".$telegram_button_array['button_txt']?>" target="_blank"><i id="cb_tg_icon"  class="bi bi-telegram"></i></a>
<div id="ayirac"></div>
</div>
<a id="cb_onoff_button" onclick="myFunction()"><i id="cb_button_icon" class="bi bi-chat-right-dots-fill"></i><span id="tooltip" class="tooltiptext"><?=$chat_button_tooltip?></span></a>


<script type="text/javascript" language="javascript">
window.onload=function()  //executes when the page finishes loading
{

    setTimeout(delay_show, 2000); 
};
function delay_show()
{
    document.getElementById("tooltip").className="tooltiptext_show";
}

// End hiding -->

function myFunction() {
  var x = document.getElementById("cb_buttton_container");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<?php
}


 ?>
