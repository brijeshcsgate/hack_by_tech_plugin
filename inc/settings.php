<?php 
function wpac_settings_page_html(){

if(!is_admin() ){
    return;
}
?>
 <div class="wrap">
 <h1 style="padding:10px; background:#333;color:#fff"><?=esc_html(get_admin_page_title())?></h1>
    <form action="options.php" method="post">
    <?php 
    // settings_fields(option_group);
    
    settings_fields('wpac-settings');
    do_settings_sections('wpac-settings');
    submit_button('save changes');
    ?>
     </form>
</div>
<?php
}

function wpac_plugin_settings(){
    // create group for settings as slug
    // register_setting(option_group,option_name, sanitize_callback);
    // add_settings_section(id, tittle, callback,page);
    // add_settings_fields(id, title, callback, page, section,args);

    register_setting('wpac-settings','wpac_like_btn_label');
    register_setting('wpac-settings','wpac_dislike_btn_label');
    add_settings_section('wpac_label_settings_section','WPAC Button Labels', 
    'wpac_plugin_settings_section_cb'
    ,'wpac-settings');
    add_settings_field('wpac_like_label_field','Like Button label',
    'wpac_like_label_field_cb',
    'wpac-settings','wpac_label_settings_section');
    
    add_settings_field('wpac_dislike_label_field','DisLike Button label',
    'wpac_dislike_label_field_cb',
    'wpac-settings','wpac_label_settings_section');


}

add_action('admin_init','wpac_plugin_settings');
function wpac_plugin_settings_section_cb(){
    echo '<p>Define Button Label</>';
}
function wpac_like_label_field_cb(){
    //get the value of the setting we have registered with register_setting()
    $setting=get_option('wpac_like_btn_label');
    //output the field
    ?>
    <input type="text" name="wpac_like_btn_label" value= "<?php echo isset ($setting )? esc_attr($setting):'';?>">
    <?php
}

function wpac_dislike_label_field_cb(){
    //get the value of the setting we have registered with register_setting()
    $setting=get_option('wpac_dislike_btn_label');
    //output the field
    ?>
    <input type="text" name="wpac_dislike_btn_label" value= "<?php echo isset ($setting )? esc_attr($setting):'';?>">
    <?php
}





function wporg_settings_init() {
	// register a new setting for "reading" page
	register_setting('reading', 'wporg_setting_name');
	register_setting('reading', 'wporg_setting_name2');

	// register a new section in the "reading" page
	add_settings_section(
		'wporg_settings_section',
		'WPOrg Settings Section', 'wporg_settings_section_callback',
		'reading'
	);

	// register a new field in the "wporg_settings_section" section, inside the "reading" page
	add_settings_field(
		'wporg_settings_field',
		'Like', 'wporg_settings_field_callback',
		'reading',
		'wporg_settings_section'
	);
	add_settings_field(
		'wporg_settings_field2',
		'Dislike', 'wporg_settings_field_callback2',
		'reading',
		'wporg_settings_section'
	);

}

/**
 * register wporg_settings_init to the admin_init action hook
 */
add_action('admin_init', 'wporg_settings_init');

/**
 * callback functions
 */

// section content cb
function wporg_settings_section_callback() {
	echo '<p>WPOrg Section Introduction.</p>';
}

// field content cb
function wporg_settings_field_callback() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('wporg_setting_name');
	// output the field
	?>
	<input type="text" name="wporg_setting_name" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
// field content cb
function wporg_settings_field_callback2() {
	// get the value of the setting we've registered with register_setting()
	$setting = get_option('wporg_setting_name2');
	// output the field
	?>
	<input type="text" name="wporg_setting_name2" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}













