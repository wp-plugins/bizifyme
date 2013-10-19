<?php

/*
Plugin Name: Bizify.me
Plugin Script: bizifyme.php
Plugin URI: https://www.bizify.me/wordpress/
Description: Activates Bizify.me on your WordPress blog.
Version: 1.2
Author: Bizify.me
Author URI: https://www.bizify.me
License: GPL2
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
	<IMG SRC="loader.gif" BORDER="0" WIDTH="32" HEIGHT="32" STYLE="margin-bottom: 10px;" />
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
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

function bizify_script()
{
	if(is_ssl())
	{
		wp_enqueue_script('bizify', 'https://cdn.bizify.me/1.1/', false, null, true);
	}
	else
	{
		wp_enqueue_script('bizify', 'http://js.bizify.me/1.1/', false, null, true);
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
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => 'border: none'), $attributes));
	
    return '<iframe src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '"></iframe>';
}

function bizifyme_video_shortcode($attributes, $content = null)
{
    $src = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
    return '<video src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></video>';
}

function bizifyme_audio_shortcode($attributes, $content = null)
{
    $src = '';
    $width = '';
    $height = '';
	$class = '';
	$style = '';
	
	if(is_ssl())
	{
		$src = str_replace("http://bizify.me", "https://bizify.me", $src);
		$src = str_replace("http://cdn.bizify.me", "https://cdn.bizify.me", $src);
	}
	
    extract(shortcode_atts(array('src' => '', 'width' => '', 'height' => '', 'class' => '', 'style' => ''), $attributes));
	
    return '<audio src="' . $src . '" width="' . $width . '" height="' . $height . '" class="' . $class . '" style="' . $style . '" controls="controls"></audio>';
}

function bizifyme_media_button()
{
    print '<a href="' . esc_url('https://bizify.me/login/?callback=' . urlencode(plugins_url('bizifyme.php', __FILE__ )) . '&shortcode=true&TB_iframe=true') . '" class="thickbox" title="Sell your digital products using Bizify.me"><img src="' . esc_url( content_url('/plugins/bizifyme/icon.png') ) . '" alt="Add Bizify.me content" /></a>';
}

function bizifyme_admin_javascript()
{
	wp_enqueue_script('tb_position', plugins_url('tb_position.js', __FILE__ ), array('media-upload'));
}

function bizifyme_stylesheet()
{
	wp_register_style('prefix-style', plugins_url('stylesheet.css', __FILE__));
	wp_enqueue_style('prefix-style');
}

add_shortcode('BizifyMeImage', 'bizifyme_image_shortcode');
add_shortcode('BizifyMePlayer', 'bizifyme_player_shortcode');
add_shortcode('BizifyMeVideo', 'bizifyme_video_shortcode');
add_shortcode('BizifyMeAudio', 'bizifyme_audio_shortcode');
add_action('media_buttons_context',  'bizifyme_media_button');
add_action('admin_enqueue_scripts', 'bizifyme_admin_javascript');
add_action('wp_enqueue_scripts', 'bizifyme_stylesheet');
add_action('wp_enqueue_scripts', 'bizify_script', 1000);

?>