<?php

/*
Plugin Name: Bizify.me
Plugin Script: bizify.php
Plugin URI: https://www.bizify.me/wordpress/
Description: Activates Bizify.me on your WordPress blog.
Version: 1.1
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

function bizify_script()
{
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
	{
		wp_enqueue_script('bizify', 'https://cdn.bizify.me/1.1/', false, null, true);
	}
	else
	{
		wp_enqueue_script('bizify', 'http://js.bizify.me/1.1/', false, null, true);
	}
}

add_action('wp_enqueue_scripts', 'bizify_script', 1000);

?>