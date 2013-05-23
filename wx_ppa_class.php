<?php

class wx_ppa_class {

	var $opts;

    public function __construct(){
        if(is_admin()){

			add_action('admin_menu', array($this, 'add_plugin_page'));
			add_action('admin_init', array($this, 'page_init'));

//			add_menu_page('WX PayPerAccess', 'WX PayPerAccess', 'manage_options', 'wx_payperaccess', 'wx_payperaccess_options');

			$this->opts = get_option("wx_ppa_options");

		}
    }
	
    public function add_plugin_page(){
        // This page will be under "Settings"
		add_options_page('WX PayPerAccess', 'PayPerAccess', 'manage_options', 'wx-ppa-setting-admin', array($this, 'create_admin_page'));
    }

    public function create_admin_page(){
        ?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Impostazioni PayPerAccess</h2>			
	    <form method="post" action="options.php">
	        <?php
		    settings_fields('wx_ppa_option_group');	
		    do_settings_sections('wx-ppa-setting-admin');
		?>
	        <?php submit_button(); ?>
	    </form>
	</div>
	<?php
    }
	
    public function page_init(){
		
		register_setting('wx_ppa_option_group', 'wx_ppa_options');
	
        add_settings_section(
			'wx_url_protection',
			'Settings of URL protection',
			array($this, 'print_section_info'),
			'wx-ppa-setting-admin'
		);
		
		add_settings_field(
			'wx_ppa_options[active]', 
			'Active', 
			array($this, 'create_active'), 
			'wx-ppa-setting-admin',
			'wx_url_protection'			
		);
		add_settings_field(
			'wx_ppa_options[rkey]', 
			'RKey', 
			array($this, 'create_rkey'), 
			'wx-ppa-setting-admin',
			'wx_url_protection'			
		);
		add_settings_field(
			'wx_ppa_options[bkey]', 
			'BKey', 
			array($this, 'create_bkey'), 
			'wx-ppa-setting-admin',
			'wx_url_protection'
		);
		add_settings_field(
			'wx_ppa_options[skey]', 
			'SKey', 
			array($this, 'create_skey'), 
			'wx-ppa-setting-admin',
			'wx_url_protection'			
		);
		add_settings_field(
			'wx_ppa_options[rurl]', 
			'RURL',
			array($this, 'create_rurl'), 
			'wx-ppa-setting-admin',
			'wx_url_protection'			
		);

    }
	
    public function print_section_info(){
		$cs = "http://".$_SERVER["SERVER_NAME"]."/";
		print '<strong>Come impostare il plugin:</strong><ul>'
			.'<li>Active: protection active yes/no</li>'
			.'<li>RKey: Name of the return variable in the Access URL (arbitray alphanumeric string, at least 10 chars)</li>'
			.'<li>BKey: Value of the variable in the Access URL (arbitray alphanumeric string, at least 10 chars)</li>'
			.'<li>SKey: Value to save in the session during the navigation of the user (arbitray alphanumeric string, at least 10 chars)</li>'
			.'<li>RURL: URL to redirct non-auth users, absolute or relative paths allowed.
			(If you put in the URL the special tag <b>%%lang%%</b> this will be automatically replaced by 
			the user lang code [it, en, es, etc...])</li></ul><br /><br />
			<h4>Access URL: </h4><h3><span id=wx_testurl>'.$cs.'?'.$this->opts["rkey"].'='.$this->opts["bkey"].'</span></h3>
			<script>
			function wxTestUrl() {
				document.getElementById("wx_testurl").innerHTML = "'.$cs.'?"+document.getElementById("wx_ppa_options[rkey]").value+"="+document.getElementById("wx_ppa_options[bkey]").value;
			}
			</script>
			';
    }
	
    public function create_active(){
		$sel = $this->opts['active'];
        ?><select id="wx_ppa_active" name="wx_ppa_options[active]">
        	<option value="yes" <?php if ($sel=="yes") {print "selected='selected'";} ?>>si</option>
        	<option value="no" <?php if ($sel=="no") {print "selected='selected'";} ?>>no</option>
        </select><?php
    }
    public function create_rkey(){
        ?><input type="text" id="wx_ppa_options[rkey]" name="wx_ppa_options[rkey]" value="<?=$this->opts['rkey'];?>" onChange="wxTestUrl()" /><?php
    }
    public function create_bkey(){
        ?><input type="text" id="wx_ppa_options[bkey]" name="wx_ppa_options[bkey]" value="<?=$this->opts['bkey'];?>" onChange="wxTestUrl()" /><?php
    }
    public function create_skey(){
        ?><input type="text" id="wx_ppa_options[skey]" name="wx_ppa_options[skey]" value="<?=$this->opts['skey'];?>" /><?php
    }
    public function create_rurl(){
        ?><input type="text" id="wx_ppa_options[rurl]" name="wx_ppa_options[rurl]" value="<?=$this->opts['rurl'];?>" /><?php
    }

}

$wx_ppa = new wx_ppa_class();
