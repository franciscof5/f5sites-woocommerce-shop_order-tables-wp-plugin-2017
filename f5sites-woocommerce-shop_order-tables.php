<?php
/**
 Plugin Name: F5 Sites | Woocommerce shop_order Tables
 Plugin URI: https://www.f5sites.com/woocommerce-shop_order-tables
 Description: Hack plugin to make WordPress painless synching server instances database (aka: dev and production). Neither wordpress or woocommerce are made to operate in that specific way, all hack solution has it`s own problems, that is why it is a hack plugin. You don't need to be experto to use, but it was cleary made for advanced/expert developers, so be carefull to don't mess you site database, risk of data lost. It is just a fork version of Post Type Tables pre configured for woocommerce shop_order. Based on original plugin F5 Sites | Shared WordPress Posts and Taxonomies Tables + Upload Folder.
 Version: 1.0
 Tags: post_type, data management, sync, woocommerce, wpmu, database admin
 Author: Francisco Matelli Matulovic
 Author URI: https://www.franciscomat.com/woocommerce-order-database
 License: GPLv2 or later

 */

/*
Woocommerce shop_order Tables is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.
 
Woocommerce shop_order Tables is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with https://www.f5sites.com/woocommerce-shop_order-tables. If not, see https://www.f5sites.com/woocommerce-shop_order-tables.
*/
if(!is_network_admin()) {
	//
	add_action( 'pre_get_posts', 'force_database_post_type_creation', 10, 2 );//FOR BLOG 
	//
	if(is_admin())
	add_action( 'switch_blog', 'force_database_post_type_creation', 10, 2 );	
}

function force_database_post_type_creation($query) {
	global $wpdb;
	global $wp_the_query;
	
	if($wp_the_query!=NULL)
		$query = $wp_the_query;

	$types_new_table = array("shop_order");
		
	//var_dump($query);
	if(isset($query->query["post_type"])) 
		$type = $query->query["post_type"];
	else
		$type="notknow";#(post or page problably, but maybe menu)
	//
	
	if(in_array($type, $types_new_table)) {
		//echo $wpdb->prefix.$type."_posts";die;
		foreach ($types_new_table as $type) {
			if(in_array($type, $types_new_table)) {
				$wpdb->posts 				= $wpdb->prefix.$type."_posts";
				$wpdb->postmeta 			= $wpdb->prefix.$type."_postmeta";
			}
		}
	}
}

?>

