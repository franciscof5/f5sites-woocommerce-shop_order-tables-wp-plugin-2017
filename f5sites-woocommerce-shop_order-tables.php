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

#if(!is_network_admin() and !(function_exists("force_database_aditional_tables_share"))) {

if(!is_network_admin()) {
	{
		#Gracefull integration, it need manual update on WOO core
		add_action("get_orders_F5SITES_inserted_hook", "force_new_names_AKA", 10, 2);
		add_action("order_received_F5SITES_inserted_hook", "force_new_names_AKA", 10, 2);
	}
	add_action('woocommerce_after_checkout_validation', 'force_new_names', 10, 2);#OBRIGATORIO HORTICAL
	add_action( 'pre_get_posts', 'force_database_shop_order_separated_tables', 10, 2 );

	#force_new_names();
	#echo "force_database_aditional_tables_share(from 3d): ".function_exists("force_database_aditional_tables_share");
	//check if type
	#add_action( 'pre_get_posts', 'revert_database_schema_after_get_order', 10, 2 );//FOR BLOG 
	#add_action( 'pre_get_posts', 'force_database_shop_order_separated_tables', 10, 2 );//FOR BLOG 
	//
	#add_action( 'init', 'force_database_shop_order_separated_tables', 10, 2 );//FOR BLOG 
	#woocommerce_before_template_part
	
	##add_action('parse_site_query', 'force_new_names', 10, 2);
	//	
	#add_action('before_woocommerce_init', 'force_database_shop_order_separated_tables', 10, 2);
	#add_action('before_woocommerce_init', 'force_database_shop_order_separated_tables', 10, 2);
	
	//TO INSERT IT ON THE TABLE
	#add_action('woocommerce_after_checkout_validation', 'force_new_names', 10, 2);
 	/**/
 		#add_action( 'pre_get_posts', 'force_database_shop_order_separated_tables', 10, 2 );//FOR BLOG 
 		
 		#add_action('before_woocommerce_init', 'force_database_shop_order_separated_tables', 10, 2);

 		#woocommerce_checkout_order_processed NAO DEU 
 		#after_woocommerce_pay NAO DEU
 		#woocommerce_account_content NAO DEU

 		#add_action('woocommerce_view_order', 'force_new_names', 10, 2);
 		
 		#add_action('woocommerce_account_content', 'force_new_names', 10, 2);

 		#add_action('woocommerce_view_order', 'force_new_names', 10, 2);
 		#add_action('woocommerce_new_order', 'force_new_names');
 	#}
	#add_action("f5sites_woo_get_order_forced_hook", "force_new_names_AKA", 10, 2);
	//TO VIEW
	#add_action('woocommerce_view_order', 'force_new_names', 10, 2);

	#
	#add_action('get_post_type', 'dieee', 10, 2);
		
	#if(is_admin()) {
		#IT MUST BE HERE FOR ADMIN VIEW
		#FOR MY-ACCOUNT ALSO
		#if(!function_exists("force_database_aditional_tables_share")) {
			#echo "funcao plugin1 nao existe...";
 			//FOR BLOG 
		#} else {
		#	echo "NADA DE ALTERAR O PRE_GET_POSTS, deixa pro plugin1";
		#}
	#}
	#add_action( 'switch_blog', 'force_database_shop_order_separated_tables', 10, 2 );	
	#add_action('woocommerce_new_order', 'force_new_names');
}

#global $debug;$debug = true;

function revert_database_schema_after_get_order() {
	global $debug;
	if($debug)
	echo " revert_database_schema_after_get_order(); ";
	global $f5sites_force_shared_posts_query;
	
	if($f5sites_force_shared_posts_query) {
		if($debug)
		echo " revertidmento NAO cancelado por outro plugin";
		#return;
	}

	global $wpdb;
	global $table_prefix;
	$prefix=$table_prefix;
	$wpdb->posts=$prefix."posts";
	$wpdb->postmeta=$prefix."postmeta";
	#echo $prefix."posts, ";
}

#else {
	#echo "f5sites woo DESABLED";
	#O PLUGIN f5sites shared posts esta habilitado e ira cuidar disso para voce, nada a fazer
	#DONT DEACTIVA THIS PLUGINS, f5sites will call functions in here
#}

function dieee () {
	if($debug)
	echo "woocommerce_checkout_order_processed";
	#die;
}

function force_new_names_AKA() {
	global $debug;
	if($debug)
		echo " force_new_names_AKA(); ";
	force_new_names();
}

function force_new_names() {
	global $debug;
	global $please_dont_change_wpdb_woo_separated_tables;
	global $wpdb;

	if($debug)
	echo "force_new_names();";

	
	#f5sites shared posts plugin integration


	#if(function_exists("force_database_aditional_tables_share")) {
		#if($debug)
		#	echo "forcou 9fnetwork_woo_shop_order_posts";
		#echo " the plugin is enabled - post still shared - only shop orders have its own table";
		
		$please_dont_change_wpdb_woo_separated_tables = true;
		
		#$wpdb->posts 				= "9fnetwork_woo_shop_order_posts";
		#$wpdb->postmeta 			= "9fnetwork_woo_shop_order_postmeta";
		#die;
	#} else {
		#YOU CAN CHOOSE WHEREVER NAME YOU WANT, but create it before use
		#todo: create automatic post table
		if($debug)
			echo " table 9woo_".$wpdb->prefix."shop_order_posts";
		$wpdb->posts 				= "9woo_".$wpdb->prefix."shop_order_posts";
		$wpdb->postmeta 			= "9woo_".$wpdb->prefix."shop_order_postmeta";
	#}*/
}

function force_database_shop_order_separated_tables_via_other_plugin() {
	global $type;
	#echo "GLOBAL TYPE ".$type;
}

function force_database_shop_order_separated_tables($query) {
	global $debug;
	global $wpdb;
	global $wp_the_query;

	if($debug)
	echo " force_database_shop_order_separated_tables(); ";

	if(!function_exists("force_database_aditional_tables_share")) {
 		if($debug)
 		echo " SITE INDEPENDENTE, FORA DA FNET ";
 		#die;
 		#revert_database_schema_after_get_order();

		#add_action( 'pre_get_posts', 'revert_database_schema_after_get_order', 10, 2 );//FOR BLOG 
 	} else {
 		if($debug)
 		echo " ESTA NUM SITE COM F5SITES SHARED POSTS ATIVADO";
 		#die;
 	}
	#
	if($debug)
	echo " is_order_received_page(): ".is_order_received_page();
	#
	
	#global $type;
	if(is_order_received_page()) {
		if($debug)
		echo " vi que estou na pagina de ver ordem, porem nao eh o momento de trocar de tabela... ";
		#force_new_names();
		#return;
	}
	#var_dump($wp_the_query);
	#var_dump($query->query["post_type"]);
	#if($wp_the_query->query["pagename"])
	#	return;
	#if($debug)
	#var_dump($query);
	if($wp_the_query!=NULL && $query==NULL)
		$query = $wp_the_query;

	$types_new_table = array("shop_order", "shop_order_refund", "customize_changeset", "subscription");
	

	#$types_new_table = array("shop_order");
	if($debug)
	echo " EU fui chamado para type: $type, ";
	#if($debug)
	#var_dump($query);
	
		#IF TYPE IS NOT PASSED AS GLOBAL VAR
		if(($query->query["post_type"])) {
			$type = $query->query["post_type"];
			if($debug)
			echo "query tem post_type definido $type";
			#revert_database_schema_after_get_order();
			#if($debug)
			#	var_dump(debug_backtrace());
		} else {
			if($debug)
			echo "post_type nao definido na query principal";
			//THE LAST RESOURCE, WP pass post_type sometimes as a GET var, the last chance we know what type query is searching for
			if($_GET['post_type']) {
				$type = $_GET['post_type'];
			} else {
				
				if(!$type) {
					$type="notknow";#(post or page problably, but maybe menu)
				} else {
					#echo "GLOBAL TYPE ".$type;
				}
			}
		}
		//
		#if($type=="page")
		#	return;
	
	

	//HACK FOR VIEW ORDER
	#if($type=="notknow" && $wp_the_query->queried_object->post_content=="[woocommerce_my_account]")
	#	force_new_names();

	//else {}
	#echo "GET: ".$_GET['post_type']." <br>";
	if($debug)
	echo " EU fui chamado para type: $type, ";
	if(is_array($type)) {
		foreach ($type as $t) {
			if(in_array($t, $types_new_table)) {
				if($debug)
				echo $t;
				force_new_names();
			}
			# code...
		}
		#var_dump($type);die;
		#$type = $type[0];
		
	} else {
		#echo $type;
		if(in_array($type, $types_new_table)) {
		#echo $wpdb->prefix.$type."_posts111";
			if($debug)
			echo " esta no YIPO ";
		/**/
			force_new_names();
		#echo $wpdb->prefix."shop_order_posts222";
		#foreach ($types_new_table as $type) {
			#if(in_array($type, $types_new_table)) {
				
			#}
		} else {
			if($type=="page" OR $type=="nav_menu_item" OR $type=="attachment") {
				if($debug)
				echo "REVERTI PARA PADRAO";
				revert_database_schema_after_get_order();
			} else {
				if($debug)
				echo " POREM nada fiz... ";
			}

			#	echo "REVERTI PARA PADRAO";
			#revert_database_schema_after_get_order();
			
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

