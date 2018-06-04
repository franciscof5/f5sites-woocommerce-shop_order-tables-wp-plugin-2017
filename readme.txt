=== F5 Sites | WooCommerce shop_order Tables ===
Contributors: f5sites, franciscof5
Tags: post_type, data management, sync, woocommerce, wpmu, database 
Requires at least: 3.2
Tested up to: 4.7.2
Stable tag: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Donate link: http://www.f5sites.com/donate/

Hack plugin to make WordPress painless synching server instances database (aka: dev and production)

== Description ==

Hack plugin to make WordPress painless synching server instances database (aka: dev and production). Neither wordpress or woocommerce are made to operate in that specific way, all hack solution has it`s own problems, that is why it is a hack plugin.

You don"t need to be experto to use, but it was cleary made for advanced/expert developers, so be carefull to don"t mess you site database, risk of data lost. It is just a fork version of Post Type Tables pre configured for woocommerce shop_order. 

Compared to other plugins like WP STAGECOACH, WP-MIGRATEDB-PRO, and all others I tested, or simple plugin solution, additional to F5 Sites | WordPress MySQL Manager (wpsql) will make you think we came from another galaxy, it is far from superior, it is a killer solution that put all alternatives in my pocket, and it is GNU licensed and you don"t need to pay for any service, why will you try something else?

Tested with:
* WooCommerce
* Sensei

Based on original plugin F5 Sites | Shared Posts and Upload Folder

[F5 Sites | WordPress Dev](https://www.f5sites.com/software/wordpress/)

[F5 Sites | WooCommerce shop_order Tables](https://www.f5sites.com/software/wordpress/f5sites-woocommerce-shop_order-tables/)

[F5 Sites | WordPress MySQL Manager (wpsql)](https://www.f5sites.com/software/wordpress/f5sites-wordpress-mysql-manager/)

== Installation ==

= From your WordPress dashboard =

1. Visit "Plugins > Add New"
2. Search for "F5 Sites | WooCommerce shop_order Tables"
3. Activate it from your Plugins page.

== Screenshots ==

1. Overview of new tables schema via phpMyAdmin


== Frequently Asked Questions ==

= So. It really works? =

Yes! Just enable it and you will have 2 additional tables (wpprefix_shop_order_post & wpprefix_shop_order_posmeta), that will initially have all information from original posts tables. But now, everywhere wp requests posts from post_type=shop_order it will make wordpress redirect the query to new tables, other posts type will work the same.

= What the plugin change in default wordpress development work schema? =

It is a hack, so you will need to have a simple thing in mind, products can easily be synched between servers instances, imported and exported freely without touching orders

= I can"t see the value of it"s solution =

That can happen, it was made to reduce time in 2 ways:
1. Reduces maintance time: if you clone production data to dev server than you must enable maintance time in the production server to prevent orders losts
2. Reduces time in development: maybe you add the products directly in production server, that's is always slow than work in local development server, so you can use wherever server you need and sync it both ways.

If you still doesn"t have a clue what is that about is because the wordpress data management is very trick.

== Discussion ==

Stackoverflow: Woocommerce working in 2 environments (development and production) (https://stackoverflow.com/questions/27122581/woocommerce-working-in-2-environments-development-and-production)

How to sync WordPress / WooCommerce staging and production site. A current overview. (https://conschneider.de/sync-wordpress-woocommerce-staging-production-site-current-overview/)

== ChangeLog ==

= 1.0 =
* Initial release