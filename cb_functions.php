<?php 

//function header_css_ekle() {
//   wp_enqueue_style('prefix-style','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css');
//}

//function header_script_ekle() {
//   wp_enqueue_script('prefix-style','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
//}


function cb_eklenti_menu(){
 //add_menu_page ile eklenti ana sayfamızı ekliyoruz

 add_menu_page('Chat Button By GT','Chat Button By GT', 'manage_options', 'chatbutton-bygt', 'cb_eklenti_yonetim', PLUGIN_ICON);
}

function eklenti_aktif_yap(){
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;

	// Tablo yoksa oluştur
	if( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) {

		require_once( '../wp-admin/includes/upgrade.php' );
		$charset_collate = 'DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci';
		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		button_id mediumint(9) NOT NULL,
		button_name VARCHAR(255) NOT NULL,
		button_css LONGTEXT,
		button_url VARCHAR(255),
		button_tooltip VARCHAR(255),
		button_txt VARCHAR(255),
		button_status mediumint(9),
		PRIMARY KEY (id),
		UNIQUE KEY (button_id)
		) $charset_collate;";
		dbDelta( $sql );

		foreach (BUTTONS_ARRAY as $buttons) {
			$button_id=$buttons['button_id'];
			$button_name=$buttons['button_name'];
			$button_url=$buttons['button_url'];
			$button_tooltip=$buttons['button_tooltip'];
			$button_txt=$buttons['button_txt'];
			$button_status=$buttons['button_status'];
			$button_css=$buttons['button_css'];
			$sql = "INSERT INTO $table_name (button_id, button_name, button_url, button_tooltip, button_txt, button_status, button_css) VALUES ($button_id, '$button_name', '$button_url', '$button_tooltip', '$button_txt', $button_status, '$button_css')";
			dbDelta( $sql );
		};
	}
	$button_data_array = array('button_css' => CB_WA_BUTTON_CSS_DEFAULT,);
	update_button_data(WHATSAPP_BUTTON_ID,$button_data_array);
	$button_data_array = array('button_css' => CB_TG_BUTTON_CSS_DEFAULT,);
	update_button_data(TELEGRAM_BUTTON_ID,$button_data_array);
}

function eklenti_deaktif_yap(){
	/*
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;
	global $wpdb;
	$sql="DROP TABLE IF EXISTS $table_name";
	$wpdb->query($sql);
	*/
	
}

function eklenti_sil(){
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;
	global $wpdb;
	$sql="DROP TABLE IF EXISTS $table_name";
	$wpdb->query($sql);
	
}


function get_button_data($button_id,$request_data){
	$output="";
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;
	$sql = "SELECT * FROM $table_name WHERE button_id=$button_id";
	$button_data_array=$wpdb->get_results($sql);
	if (!empty($button_data_array[0]->$request_data)) {
	 	$output=$button_data_array[0]->$request_data;
	 };

	return $output;
}

function get_button_data_array($button_id){
	$output="";
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;
	$sql = "SELECT * FROM $table_name WHERE button_id=$button_id";
	$button_data_array=$wpdb->get_results($sql);
	if (!empty($button_data_array[0])) {
	 	$output= (array) $button_data_array[0];
	 };

	return $output;
}

function update_button_data($button_id,$button_data_array){
	$output="";
	global $wpdb;
	$table_name = $wpdb->prefix.PLUGIN_DB_BUTTONS_META_TABLE;
	$wpdb->update($table_name, $button_data_array, array('button_id'=>$button_id));

	
	//https://wpmudev.com/blog/adding-admin-notices/  kullanım için göz at
	$output="<div class='updated notice'><p>Successfully updated...</p></div>";
	return $output;
}


function form_validate($post_array){
	if (!isset($post_array['form_control']) || ! wp_verify_nonce( $post_array['form_control'], 'form_control' ) ) {
    print 'Ooooops, bu sayfaya erişim yetkiniz yok!';
    exit;
  }else{
    // if validate
  	return $post_array;
  }
}


function get_cb_button_xml(){
	$settings_xml = simplexml_load_file(CB_SETTINGS_XML);

	return $settings_xml;
}

function update_cb_button_xml($cb_button_data_array){
	$settings_xml = simplexml_load_file(CB_SETTINGS_XML);

	// update
	$settings_xml->cb_mainbutton_status = $cb_button_data_array['cb_status'];
	$settings_xml->cb_mainbutton_tooltip = $cb_button_data_array['cb_tooltip'];
	$settings_xml->cb_mainbutton_position = $cb_button_data_array['cb_position'];
	$settings_xml->cb_mainbutton_color = $cb_button_data_array['cb_bgcolor'];
	$settings_xml->cb_mainbutton_tooltip_bgcolor = $cb_button_data_array['cb_tooltip_bgcolor'];
	$settings_xml->cb_mainbutton_tooltip_txtcolor = $cb_button_data_array['cb_tooltip_txtcolor'];
	$settings_xml->cb_mainbutton_iconcolor = $cb_button_data_array['cb_iconcolor'];
	$settings_xml->cb_mainbutton_size = $cb_button_data_array['cb_button_size'];
	$settings_xml->cb_mainbutton_iconsize = $cb_button_data_array['cb_iconsize'];
	$settings_xml->cb_mainbutton_vertical_align = $cb_button_data_array['cb_verticalalign'];
	$settings_xml->cb_mainbutton_margin_top = $cb_button_data_array['cb_margin_top'];
	$settings_xml->cb_mainbutton_container_height = $cb_button_data_array['cb_container_height'];
	

	// save the updated document 	
	$settings_xml->asXML(CB_SETTINGS_XML_PATH);
	$output="<div class='updated notice'><p>Successfully updated...</p></div>";
	return $output;
}

function get_button_status_display($button_id){

	$button_display="";
	$button_array=get_button_data_array($button_id);
	$button_status=$button_array['button_status'];
    if ($button_status==0){ 
        $button_display="display: none;";
    }
    return $button_display;
}

function get_wa_button_css($css, $css_data_properties){

	switch ($css_data_properties) {
	case 'WA-BGCOLOR':
	    $wa_css_bgcolor_start=strpos($css, '; /*WA-BGCOLOR*/')-6;
			$output=substr($css, $wa_css_bgcolor_start, 6);
	    break;
	case 'WA-ICON-SIZE':
	    $wa_css_iconsize_start=strpos($css, '; /*WA-ICON-SIZE*/')-4;
			$output=substr($css, $wa_css_iconsize_start, 2);
	    break;
	case 'WA-BUTTON-WIDTH':
	    $wa_css_buttonwidth_start=strpos($css, '; /*WA-BUTTON-WIDTH*/')-4;
			$output=substr($css, $wa_css_buttonwidth_start, 2);
	    break;
	case 'WA-BUTTON-HEIGHT':
	    $wa_css_buttonheight_start=strpos($css, '; /*WA-BUTTON-HEIGHT*/')-4;
			$output=substr($css, $wa_css_buttonheight_start, 2);
	    break;
	case 'WA-VERTICAL-ALIGN':
	    $wa_css_verticalalign_start=strpos($css, '; /*WA-VERTICAL-ALIGN*/')-4;
			$output=substr($css, $wa_css_verticalalign_start, 2);
	    break;
	}

	return $output;

}

function get_tg_button_css($css, $css_data_properties){

	switch ($css_data_properties) {
	case 'TG-BGCOLOR':
	    $tg_css_bgcolor_start=strpos($css, '; /*TG-BGCOLOR*/')-6;
			$output=substr($css, $tg_css_bgcolor_start, 6);
	    break;
	case 'TG-ICON-SIZE':
	    $tg_css_iconsize_start=strpos($css, '; /*TG-ICON-SIZE*/')-4;
			$output=substr($css, $tg_css_iconsize_start, 2);
	    break;
	case 'TG-BUTTON-WIDTH':
	    $tg_css_buttonwidth_start=strpos($css, '; /*TG-BUTTON-WIDTH*/')-4;
			$output=substr($css, $tg_css_buttonwidth_start, 2);
	    break;
	case 'TG-BUTTON-HEIGHT':
	    $tg_css_buttonheight_start=strpos($css, '; /*TG-BUTTON-HEIGHT*/')-4;
			$output=substr($css, $tg_css_buttonheight_start, 2);
	    break;
	case 'TG-VERTICAL-ALIGN':
	    $tg_css_verticalalign_start=strpos($css, '; /*TG-VERTICAL-ALIGN*/')-4;
			$output=substr($css, $tg_css_verticalalign_start, 2);
	    break;
	}

	return $output;

}

function update_wa_button_css($css, $new_css_data, $css_data_properties){
	switch ($css_data_properties) {
	case 'WA-BGCOLOR':
	    $change_start=strpos($css, '; /*WA-BGCOLOR*/')-6;
			$change_stop=6;
	    break;
	case 'WA-ICON-SIZE':
	    $change_start=strpos($css, '; /*WA-ICON-SIZE*/')-4;
			$change_stop=2;
	    break;
	case 'WA-BUTTON-WIDTH':
	    $change_start=strpos($css, '; /*WA-BUTTON-WIDTH*/')-4;
			$change_stop=2;
	    break;
	case 'WA-BUTTON-HEIGHT':
	    $change_start=strpos($css, '; /*WA-BUTTON-HEIGHT*/')-4;
			$change_stop=2;
	    break;
	case 'WA-VERTICAL-ALIGN':
	    $change_start=strpos($css, '; /*WA-VERTICAL-ALIGN*/')-4;
			$change_stop=2;
	    break;
	}

	return substr_replace($css, $new_css_data, $change_start, $change_stop);

}

function update_tg_button_css($css, $new_css_data, $css_data_properties){
	switch ($css_data_properties) {
	case 'TG-BGCOLOR':
	    $change_start=strpos($css, '; /*TG-BGCOLOR*/')-6;
			$change_stop=6;
	    break;
	case 'TG-ICON-SIZE':
	    $change_start=strpos($css, '; /*TG-ICON-SIZE*/')-4;
			$change_stop=2;
	    break;
	case 'TG-BUTTON-WIDTH':
	    $change_start=strpos($css, '; /*TG-BUTTON-WIDTH*/')-4;
			$change_stop=2;
	    break;
	case 'TG-BUTTON-HEIGHT':
	    $change_start=strpos($css, '; /*TG-BUTTON-HEIGHT*/')-4;
			$change_stop=2;
	    break;
	case 'TG-VERTICAL-ALIGN':
	    $change_start=strpos($css, '; /*TG-VERTICAL-ALIGN*/')-4;
			$change_stop=2;
	    break;
	}

	return substr_replace($css, $new_css_data, $change_start, $change_stop);

}

function kenarda_dursun(){

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
  font-size: 20px; /*TG-ICON-SIZE*/
}

#cb_tg_button{
  width: 40px; /*TG-BUTTON-WIDTH*/
  height: 40px; /*TG-BUTTON-HEIGHT*/
  line-height: 40px; /*TG-VERTICAL-ALIGN*/
  background-color: #0088cc; /*TG-BGCOLOR*/
  border-radius: 40px;
  position: fixed;
  text-align: center;
  align: center;
}';



		//$i=0;
		//while ($i < count($button_data_form_array))
        //{
            //$array_key=array_keys($button_data_form_array)[$i];
           // echo  $array_key."='".$button_data_form_array[$array_key]."'<br />";
           // $i++;
       // }
}



 ?>