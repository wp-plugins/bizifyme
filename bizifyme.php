<?php

/*
Plugin Name: Bizify.me
Plugin Script: bizifyme.php
Plugin URI: https://www.bizify.me/wordpress/
Description: Activates Bizify.me on your WordPress blog.
Version: 1.3
Author: Bizify.me
Author URI: https://www.bizify.me
License: GPL2+
*/
/*
Copyright 2013 Bizify.me

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
GNU General Public License for more details.

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

if(isset($_GET["html"]))
{ 
	?>
	
	<!DOCTYPE HTML>
	<HTML>
	<HEAD>
	<STYLE>
	html, body
	{
		height: 100%;
		margin: 0px;
		padding: 0px;
	}
	</STYLE>
	</HEAD>
	<BODY>

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
	<tr valign="middle">
	<td align="center">
	<IMG SRC="loader.gif" BORDER="0" WIDTH="64" HEIGHT="64" />
	</td>
	</tr>
	</table>

	<script type="text/javascript">
	window.top.send_to_editor('<?php echo preg_replace("/\r|\n/", "", $_GET['html']) ?>');
	</script>

	</BODY>
	</HTML>

	<?php
	exit;
}

if(!function_exists('add_action'))
{
	echo 'Hi there! I\'m just a plugin. Not much I can do when called directly.';
	exit;
}

function bizifyme_script()
{
	if(is_ssl())
	{
		wp_enqueue_script('bizifyme', 'https://cdn.bizify.me/1.1/', false, null, true);
	}
	else
	{
		wp_enqueue_script('bizifyme', 'http://js.bizify.me/1.1/', false, null, true);
	}
}

function bizifyme_image_shortcode($attributes, $content = null)
{
    $src = '';
	$alt = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
    extract(shortcode_atts(array('src' => '', 'alt' => 'Bizify.me image','width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    return '<img alt="' . $alt . '" src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" />';
}

function bizifyme_player_shortcode($attributes, $content = null)
{
    $src = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => 'border: none'), $attributes));
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    return '<iframe src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '"></iframe>';
}

function bizifyme_video_shortcode($attributes, $content = null)
{
    $src = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    return '<video src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></video>';
}

function bizifyme_audio_shortcode($attributes, $content = null)
{
    $src = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    return '<audio src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></audio>';
}

function bizifyme_media_button()
{
    if(get_bloginfo('version') >= 3.3)
	{
		echo '<a href="' . esc_url('https://bizify.me/login/?callback=' . urlencode(plugins_url('bizifyme.php', __FILE__ )) . '&shortcode=true&TB_iframe=true') . '" class="button thickbox" data-editor="content" title="' . __('Sell your digital product using Bizify.me', 'bizifyme') . '"><span class="bizifyme-buttons-icon" style="background: url(\'' . esc_url( plugins_url('icon.png', __FILE__ ) ) . '\') no-repeat top left;"></span> ' . __('Sell Product', 'bizifyme') . '</a>';
	}
	else
	{
		echo '<a href="' . esc_url('https://bizify.me/login/?callback=' . urlencode(plugins_url('bizifyme.php', __FILE__ )) . '&shortcode=true&TB_iframe=true') . '" class="thickbox" title="' . __('Sell your digital products using Bizify.me') . '"><img src="' . esc_url( plugins_url('icon.png', __FILE__ ) ) . '" alt="' . __('Sell your digital products using Bizify.me') . '" /></a>';
	}
}

function bizifyme_admin()
{
	wp_register_style('prefix-style', plugins_url('admin.css', __FILE__));
	wp_enqueue_style('prefix-style');
	
	wp_enqueue_script('bizifyme_admin', plugins_url('admin.js', __FILE__ ), array('media-upload'), null, true);
}

function bizifyme_wp()
{
	wp_register_style('prefix-style', plugins_url('bizifyme.css', __FILE__));
	wp_enqueue_style('prefix-style');
}
	
function bizifyme_init()
{
	load_plugin_textdomain('bizifyme', false, dirname(plugin_basename( __FILE__ )) . '/languages/');
}

add_action('init', 'bizifyme_init');
add_action('media_buttons_context',  'bizifyme_media_button');

add_action('admin_enqueue_scripts', 'bizifyme_admin');
add_action('wp_enqueue_scripts', 'bizifyme_wp');

add_shortcode('BizifyMeImage', 'bizifyme_image_shortcode');
add_shortcode('BizifyMePlayer', 'bizifyme_player_shortcode');
add_shortcode('BizifyMeVideo', 'bizifyme_video_shortcode');
add_shortcode('BizifyMeAudio', 'bizifyme_audio_shortcode');

add_action('wp_enqueue_scripts', 'bizifyme_script', 1000);

?>