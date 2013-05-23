=== PayPerAccess ===
Contributors: webextends
Donate link: http://www.webextends.it/
Tags: paid access,site protection
Requires at least: 3.0.0
Tested up to: 3.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use this plugin to filter the access to your website redirecting 
the non-auth users to a payment page o something similar.

== Description ==

If you need to grant access to your website only to those peaople that had paid 
a fee or have done something you need before they access: this plugin allow you
to setup an "access URL" that permit you to access all website contents.

If users don't access through this URL, they'll be redirected to another page
(for eg. a payment page) and then redirected back by that page to the "access URL"
if they pay or do something you want.


== Installation ==

To install the plugin you can simply use the "plugin installer" of Wordpress,
or manually:
1. upload hte files you can find in the ZIP file, to the directory '/wp-content/plugins/wx_payperaccess/'
2. thourgh the plugin page in the admin panel, activate the plugin
3. go to Settings -> PayPerAccess and configure all options you need
4. save
5. test trying to access the website: yiou should be redirected to the URL you specified in RUrl parameter
6. try to access the Access URL you can see in the setting page, and you will be able to navigate the site for the duration of your session

== Frequently Asked Questions ==

== Changelog ==

= 1.1 =
* grouped options in serialized data

= 1.0 =
* first version of plugin
