<?php

if(!defined('WP_UNINSTALL_PLUGIN')) exit();

//Uncomment this section if you would like to delete all saved Bizify.me settings.

/*

if(!is_multisite()) 
{
    delete_option('bizifyme_options');
} 
else 
{
    $current_blog_id = get_current_blog_id();

	global $wpdb;
	$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    
    foreach($blog_ids as $blog_id) 
    {
        switch_to_blog($blog_id);
        delete_site_option(delete_option('bizifyme_options'));
    }
    
	switch_to_blog($current_blog_id);
}

*/

?>