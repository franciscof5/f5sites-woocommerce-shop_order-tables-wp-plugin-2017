<?php
/**
 Plugin Name: F5 Sites | Woocommerce shop_order Tables
 Plugin URI: https://www.f5sites.com/software/wordpress/f5sites-woocommerce-shop_order-tables/
 Description: Hack plugin to make WordPress painless synching server instances database (aka: dev and production). Neither wordpress or woocommerce are made to operate in that specific way, all hack solution has it`s own problems, that is why it is a hack plugin. You don't need to be experto to use, but it was cleary made for advanced/expert developers, so be carefull to don't mess you site database, risk of data lost. It is just a fork version of Post Type Tables pre configured for woocommerce shop_order. Based on original plugin F5 Sites | Shared WordPress Posts and Taxonomies Tables + Upload Folder.
 Version: 1.0
 Tags: post_type, data management, sync, woocommerce, wpmu, database admin
 Author: Francisco Matelli Matulovic
 Author URI: https://www.franciscomat.com/woocommerce-order-database
 License: GPLv3

 */

if(!is_network_admin()) {
	//check if type
	add_action( 'pre_get_posts', 'force_database_post_type_creation', 10, 2 );//FOR BLOG 
	//
	#add_action( 'init', 'force_database_post_type_creation', 10, 2 );//FOR BLOG 
	
	//	
	add_action('before_woocommerce_init', 'force_database_post_type_creation', 10, 2);
	//TO INSERT IT ON THE TABLE
	add_action('woocommerce_after_checkout_validation', 'force_new_names', 10, 2);
	//TO VIEW
	add_action('woocommerce_view_order', 'force_new_names', 10, 2);
	
	#if(is_admin())
	#add_action( 'switch_blog', 'force_database_post_type_creation', 10, 2 );	
}
function force_new_names() {
	#echo "forcou";die;
	global $wpdb;
	#$wpdb->posts 				= $wpdb->prefix."shop_order_posts";
	#$wpdb->postmeta 			= $wpdb->prefix."shop_order_postmeta";
	$wpdb->posts 				= "9woo_".$wpdb->prefix."shop_order_posts";
	$wpdb->postmeta 			= "9woo_".$wpdb->prefix."shop_order_postmeta";
}
function force_database_post_type_creation($query) {
	global $wpdb;
	global $wp_the_query;
	#var_dump($wp_the_query);
	if($wp_the_query!=NULL && $query==NULL)
		$query = $wp_the_query;

	$types_new_table = array("shop_order", "shop_order_refund", "customize_changeset");
		
	if(isset($query->query["post_type"])) 
		$type = $query->query["post_type"];
	else
		$type="notknow";#(post or page problably, but maybe menu)
	//
	//
	
		
	if(is_array($type)) {
		foreach ($type as $t) {
			if(in_array($t, $types_new_table)) {
				#echo $t;die;
				force_new_names();
			}
			# code...
		}
		#var_dump($type);die;
		#$type = $type[0];
		
	} else {
		if(in_array($type, $types_new_table)) {
		#echo $wpdb->prefix.$type."_posts111";
		/**/
		force_new_names();
		#echo $wpdb->prefix."shop_order_posts222";
		#foreach ($types_new_table as $type) {
			#if(in_array($type, $types_new_table)) {
				
			#}
		}
		/*foreach ($types_new_table as $type) {
			if(in_array($type, $types_new_table)) {
				$wpdb->posts 				= $wpdb->prefix.$type."_posts";
				$wpdb->postmeta 			= $wpdb->prefix.$type."_postmeta";
			}
		}*/
	}
}

?>

