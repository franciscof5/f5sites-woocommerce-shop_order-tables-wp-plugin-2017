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
#global $debug;$debug = true;

#if(!is_network_admin() and !(function_exists("force_database_aditional_tables_share"))) {

if(!is_network_admin()) {
	{
		#Gracefull integration, it need manual update on WOO core
		add_action("get_orders_F5SITES_inserted_hook", "force_new_names_AKA", 10, 2);//for users on front-end
		add_action("order_received_F5SITES_inserted_hook", "force_new_names_AKA", 10, 2);
		###
		add_action("woocommerce_before_checkout_process", "force_new_names_AKA", 10, 2);
		add_action("wc_frontend_scripts", "revert_database_schema_after_get_order", 5, 2);
		
	}
	#woocommerce_after_checkout_validation
	#woocommerce_checkout_update_order_review
	
	#add_action('woocommerce_after_checkout_validation', 'revert_database_schema_after_get_order', 10, 2);#OBRIGATORIO HORTICAL

	#add_action('woocommerce_checkout_order_processed', 'revert_database_schema_after_get_order', 10, 2);#OBRIGATORIO HORTICAL
		

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

/*add_action( 'template_redirect', 'custom_template_redirect' );

function custom_template_redirect() {

    if( is_shop() ) :

         // code logic here

    endif;    
}*/

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
		#var_dump($wpdb);die;
		if($debug)
			echo " table 6woo_".$wpdb->prefix."shop_order_posts";
		if($wpdb->posts!="6woo_".$wpdb->prefix."shop_order_posts") {
			$wpdb->posts 				= "6woo_".$wpdb->prefix."shop_order_posts";
			$wpdb->postmeta 			= "6woo_".$wpdb->prefix."shop_order_postmeta";	
		}
		
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

	if($debug) {
		echo " force_database_shop_order_separated_tables(); <br>";

	}

	if(!function_exists("force_database_aditional_tables_share")) {
 		if($debug)
 		echo " SITE INDEPENDENTE, FORA DA FNET ";
 		#die;
 		#revert_database_schema_after_get_order();

		#add_action( 'pre_get_posts', 'revert_database_schema_after_get_order', 10, 2 );//FOR BLOG 
 	} else {
 		if($debug)
 		echo " ESTA NUM SITE COM F5SITES SHARED POSTS ATIVADO ";
 		#die;
 	}
	#
	#if($debug)
	#var_dump(is_wc_endpoint_url( 'order-received' ));
	
	#

	#$isreceived = is_wc_endpoint_url( 'order-received' );
	$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	#$is_customize = strpos($url,'customize');
	#if($is_customize)return;
	#if(isset($_GET["return"]))return;
	$pos_on_url = strpos($url,'order-received');
	#if ($pos_on_url !== false) {
	#    $isreceived = true;
	#} else {
	#	$isreceived = false;
	#}
	
	if($debug)
	echo " is_order_received_page(): ".$pos_on_url;
	#
	
	#global $type;
	if($pos_on_url) {
		
		#https://www.f5sites.com/plugins-br/woocommerce/checkout/order-received/4/?key=wc_order_5adba095996e
		#https://br.f5sites.com/plugins-br/woocommerce/checkout/order-received/21/?key=wc_order_5adba2d1abcc3
		#https://www.f5sites.com/plugins-br/woocommerce/checkout/order-received/5/?key=wc_order_5adba34d80f0
		#https://br.f5sites.com/plugins-br/woocommerce/checkout/order-received/22/?key=wc_order_5adba39927a9

		$url_no_order_received = substr($url, 0, $pos_on_url);
		$order_received = substr($url, $pos_on_url, strlen($url));
		$url_correct = substr(wc_get_page_permalink( 'checkout' ),0,-1)."/".$order_received;
		#echo "CHK:".wc_get_page_permalink( 'checkout' );
		#echo "URL:".$url_no_order_received;
		#echo "URLCO:".$url_correct;
		#echo " I:".strpos($url_correct, $url);
		#die;
		#if (strpos(wc_get_page_permalink( 'checkout' ),$url)) {
		#if (strpos($url_correct, $url)) {
		if ($url_correct==$url) {
		    #echo 'PAGINA CRTA';
		} else {
			#echo 'PAGINA RRRADA';
			if(is_404()) {
				#echo "is_404";
				if (!defined('DOING_AJAX') && DOING_AJAX)
				echo "<script>parent.self.location='".$url_correct."';</script>";//enter location..example www.google.com, or profile.php etc
				#echo $url_correct;
				#wp_redirect($url_correct);
				#exit();	
			}
			
		}
		#die;
		#var_dump($_SERVER['REQUEST_URI']);die;
		#var_dump(wc_get_page_permalink( 'checkout' ));die;
		#wp_redirect(wc_get_page_permalink( 'checkout' ).$_SERVER['REQUEST_URI']);
		if($debug)
		echo " vi que estou na pagina de ver ordem, porem nao eh o momento de trocar de tabela... ";

		#force_new_names();
		#revert_database_schema_after_get_order();
		#return;
		#revert_database_schema_after_get_order();
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
	
	#if($debug)
	#var_dump($query);
	
		#IF TYPE IS NOT PASSED AS GLOBAL VAR
	if(isset($query->query["post_type"])) {
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
		#if($debug)
		#echo " EU fui chamado para type: $type, ";
		//
		#if($type=="page")
		#	return;
	} else {
		if($debug)
		echo " NAO TEM tipo retornar ";
		#revert_database_schema_after_get_order();
		return;
	}
	
	//HACK FOR VIEW ORDER
	#if($type=="notknow" && $wp_the_query->queried_object->post_content=="[woocommerce_my_account]")
	#	force_new_names();

	//else {}
	#echo "GET: ".$_GET['post_type']." <br>";
	if(isset($type)) {
		if($type=="customize_changeset")return;#br.franciscomat.com
		if(is_array($type)) {

			if($debug)
				echo " is array ";
				#var_dump($type);
			return;

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
			if($debug)
			echo " EU fui chamado para type: $type, ";
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
				#if($type=="page" OR $type=="nav_menu_item" OR $type=="attachment") {
					if($debug)
					echo "REVERTI PARA PADRAO";
					
					if($type=="course" || $type=="lesson") {
						if($debug)
						echo " TIPO is course OR lesson FORCEI REVERT";
						revert_database_schema_after_get_order();
					}
				#} else {
				#	if($debug)
				#	echo " POREM nada fiz... ";
				#}

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
	
}