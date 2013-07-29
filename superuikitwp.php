<?php
/*
Plugin Name: Super UIkit For WordPress
Plugin URI: http://herdboy.com
Description: Super UI Kit is a Wordpress Plugin Extension developed by HerdBoy Web Design and Development to integrate the Super Awesome UIkit into your website..
Author: Mustaq Sheikh
Version: 1.0.1
Author URI: http://www.herdboy.com
*/

function register_scripts() {
	$scripturl = WP_PLUGIN_URL .'/superuikitwp/assets/js/';
	if ( !is_admin() ) {
		wp_enqueue_script('jquery');
		wp_register_script('superuikitwp', $scripturl.'uikit.min.js', '', '1.0.1', true);
		wp_enqueue_script('superuikitwp');
	}
}

function register_css() {
	$suikit_theme = get_option('suikit_theme');

	if($suikit_theme == 'uikit')
	{
		wp_register_style('uikit', WP_PLUGIN_URL .'/superuikitwp/assets/css/uikit.min.css', '', '1.0.1');
		wp_enqueue_style('uikit');
	}
	else if($suikit_theme == 'uikit.gradient')
	{
		wp_register_style('uikit.gradient', WP_PLUGIN_URL .'/superuikitwp/assets/css/uikit.gradient.min.css', '', '1.0.1');
		wp_enqueue_style('uikit.gradient');
	}
	else if($suikit_theme == 'uikit.almostflat')
	{
		wp_register_style('uikit.almostflat', WP_PLUGIN_URL .'/superuikitwp/assets/css/uikit.almostflat.min.css', '', '1.0.1');
		wp_enqueue_style('uikit.almostflat');
	}
}
add_action('wp_enqueue_scripts','register_scripts');
add_action('wp_print_styles','register_css');

function init_superuikitwp() {
	$suikit_theme = get_option('suikit_theme');

	if($suikit_theme == '') $suikit_theme = 'uikit';

}

add_action('wp_head', 'init_superuikitwp');


function create_ui()
{

	$suikit_theme = get_option('suikit_theme');

	if($suikit_theme == '') $suikit_theme = 'uikit';

	?>
	<form method="POST" action="">
		<input type="hidden" name="is_update" value="1" />
		<div class="metabox-holder" style="width:815px;">
			<div class="postbox">
				<table class="form-table" style="margin:0;">
				<tr valign="top"><td style="padding:0;width:180px;"><h3>Name</h3></td><td style="padding:0;width:235px;"><h3>Value</h3></td><td style="padding:0;"><h3>Description</td></h3></tr>

				<tr valign="top" >
					<td  style="padding:5px 0;">
						<label for="suikit_theme" style="padding:10px;font-weight:bold;">Super Uikit:</label>
					</td>
					<td  style="padding:5px 0;">
						<select style="width:100px;"  name="suikit_theme">
							<option value="uikit" <?php if($suikit_theme=='uikit') echo 'selected="selected"'?> >uikit</option>
							<option value="uikit.gradient" <?php if($suikit_theme=='gradient') echo 'selected="selected"'?> >uikit.gradient.min</option>
							<option value="uikit.almostflat" <?php if($suikit_theme=='uikit.almostflat') echo 'selected="selected"'?> >uikit.almostflat.min</option>
						</select>
					</td>
					<td style="padding:5px 0;">
					  <p style="margin:0 10px;font-style:italic;font-size:11px;">
						Theme for the UIkit.</p>
					</td>
				</tr>

				</table>
			</div>
			</div>
		<input type="submit" class="button-primary" name="save-changes" value="Save Changes" style="" />
	</form>
<?php
}
function is_value_exists($value,$array)
{
	if($array ==null) return false;
	else
		return in_array($value,$array);
}
function superuikitwp_settings()
{
	if($_POST['is_update'] == '1')
	{
		if(isset($_POST['suikit_theme']))
			update_option('suikit_theme',$_POST['suikit_theme']);
	}
	create_ui();
}
function setup_superuikitwp_settings()
{
	 add_options_page('Super UIkit WP Plugin Options', 'Super UIkit WP Plugin', 'manage_options', 'superuikitwp', "superuikitwp_settings");
}
add_action('admin_menu','setup_superuikitwp_settings');
?>
