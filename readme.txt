=== F5 Sites | WooCommerce shop_order Tables ===
Contributors: franciscof5
Tags: post_type, data management, sync, woocommerce, wpmu, database 
Requires at least: 3.2
Tested up to: 4.7.2
Stable tag: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Hack plugin to make WordPress painless synching server instances database (aka: dev and production)

== Description ==

Hack plugin to make WordPress painless synching server instances database (aka: dev and production). Neither wordpress or woocommerce are made to operate in that specific way, all hack solution has it`s own problems, that is why it is a hack plugin. You don't need to be experto to use, but it was cleary made for advanced/expert developers, so be carefull to don't mess you site database, risk of data lost. It is just a fork version of Post Type Tables pre configured for woocommerce shop_order. Based on original plugin F5 Sites | Shared WordPress Posts and Taxonomies Tables + Upload Folder.
 Version: 1.0

 == Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'F5 Sites | WooCommerce shop_order Tables'
3. Activate it from your Plugins page.

== Frequently Asked Questions ==

= So. It really works? =

Yes! Just enable it and you will have 2 additional tables (wpprefix_shop_order_post & wpprefix_shop_order_posmeta), that will initially have all information from original posts tables. But now, everywhere wp requests posts from post_type=shop_order it will make wordpress redirect the query to new tables, other posts type will work the same.

= What the plugin change in default wordpress development work schema? =

It is a hack, so you will need to have a simple thing in mind, products can easily be synched between servers instances, imported and exported freely without touching orders

= I can't see the value of it's solution =

That can happen, it was made to reduce time in 2 ways:
1. Reduces maintance time: if you clone production data to dev server than you must enable maintance time in the production server to prevent orders losts
2. Reduces time in development: maybe you add the products directly in production server, that's is always slow than work in local development server.

If you still doesn't have a clue what is that about is because the wordpress data management is very trick.

== Upgrade Notice ==

= 1.0 =
Initial release
