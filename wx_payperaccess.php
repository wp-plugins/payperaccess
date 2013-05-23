<?php
/*
Plugin Name: WX PayPerAccess for Wordpress
Plugin URI: http://www.webextends.it/
Description: Protect your blog redirectig to payment gateway
Version: 1.0
Author: Webextends
Author URI: http://www.webextends.it/
*/

register_deactivation_hook(__FILE__, 'wx_payperaccess_uninstall');

function wx_payperaccess_uninstall(){
		delete_option("wx_ppa_options");
}


include "wx_ppa_class.php";


function wx_PayPerAccess() {
	$opts = get_option("wx_ppa_options");
	$active = $opts["active"];
	if ($active=="yes") {
		session_start();
		$d = $_REQUEST;
		$rkey = $opts["rkey"];
		$bkey = $opts["bkey"];
		$skey = $opts["skey"];
		$rurl = $opts["rurl"];
		if($bkey===$d[$rkey])
			$_SESSION["WX_PPA_$rkey"]=$skey;
		if($_SESSION["WX_PPA_$rkey"]!=$skey) {
			$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
			$rurl = str_replace("%%lang%%",$lang, $rurl);
			header("location:".$rurl);
			unset($rkey,$bkey,$skey,$rurl,$lang,$opts);
			exit;
		}
		unset($rkey,$bkey,$skey,$rurl,$opts);
	}
}
add_action('send_headers', 'wx_PayPerAccess');
