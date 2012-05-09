<?php

include(dirname(__FILE__).'/swekey_integration.php');

// OPTIONAL
// include your include files here

class MySwekeyIntegration extends SwekeyIntegration
{	
	function MySwekeyIntegration()
	{
		// REQUIRED
		// Turn this flag to false once your integration is working
	 	$this->show_debug_info = true;

		// REQUIRED
		// Put the relative URL of your swekey directory.
		// This is used load the swekey javascript files
	  	$this->swekey_dir_url = 'swekey/';

		// REQUIRED
		// Put the name of you user name text input of your login form here.
		// This is used to auto-fill the username when a swekey is plugged
		// You can use multiple names
	 	$this->input_names = array("user_name");

		// REQUIRED
		// Set this value to true if a user is logged
		$this->is_user_logged = false;
		
		
		if ($this->is_user_logged)
		{
			// REQUIRED
			// If the logged user has a swekey associated with his account 
			// fill this value with the id of that swekey.
            //$this->swekey_id_of_logged_user = DoQuery("SELECT `swekey_id` from `users` where id='{$_SESSION['authenticated_user_id']}'");

			// REQUIRED
			// Provide an URL that should be used to logout the current user
			// This is used when a user unplug its swekey
			//$this->logout_url = 'logout.php';
		}
		
		// OPTIONAL
	    // Set this value to the current locale
	    // more than one username/password form
	 	//$this->lang = 'en-US';

		// OPTIONAL
	    // Set this member to true if your login window contains
	    // more than one username/password form
	 	//$this->multiple_logos = true;

		// OPTIONAL
	    // Set this member to true if the login form is
	    // created dynamically using javascript after
	    // the page was loaded
	 	//$this->dynamic_login_form = true;

		// DEGUG
	    // To enable logging set the following var to the path of your log file
	 	//$this->logFile = '/tmp/swekey-integration.log';
	}

	// REQUIRED 
	// Return the name of the user from a given swekey id 
	// This is used to auto-fill the username when a swekey is plugged
	function GetUserNameFromSwekeyId($swekey_id)
	{
		// return DoQuery("SELECT `name` from `users` where swekey_id='$swekey_id'");
	}
	
	// REQUIRED
	// Set the swekey_id of the current user
	// returns null in case of sussess
	// returns a string in case of error 
	function AttachSwekeyToCurrentUser($swekey_id)
	{
  	   // if ( !DoQuery("UPDATE `users` SET swekey_id = '$swekey_id' where id='{$_SESSION['authenticated_user_id']}'")
  	   // 	return "Failed to attach the user";  	    	
	}
	
	// OPTIONAL
	// You can add your own javascript at the end of each page here.
	function AdditionalJavaScript()
	{
	    return "";
	}

	// OPTIONAL
	// You can add your own javascript files here.
 	function GetJavaScriptIncludes()
  	{
  		// Mandatory includes
    	$res = parent::GetJavaScriptIncludes();
    	
		// Those includes are necessary for the default inplemtation of the ajax calls.
		// If you want to use you own implementation you can remove the following lines and use your own files. 
		$res .= '<script type="text/javascript" src="'.$this->swekey_dir_url.'json/swekey_json_client.js"></script>'."\n";

		return $res;
  	}


	// OPTIONAL 
	// by default the swekey configuration is located in the swekey_config.php file
	// You can store those settings somewhere else.
//	function GetConfig()
//	{	
//		$config = array
//		(
//			'check_server'		=> 'http://auth-check.musbe.net',
//			'status_server'		=> 'http://auth-status.musbe.net',
//			'rndtoken_server'	=> 'http://auth-rnd-gen.musbe.net',
//			'allow_disabled' => true,
//			'user_managment' => true,
//			'brands' => '00000123,00000A4F,00000345',
//			'no_linked_otp' => '',
//			'https_server_hostname' => 'my-https-server.mydomain.com',
//		    'logo_xoffset' => '1px',
//		    'logo_yoffset' => '-2px',
//		    'loginname_width_offset' => 16,
//		    'show_only_plugged ' => false,
//		 );
//		return $config;
//	}


	// OPTIONAL
	// This functunction gives you a chance to localize the strings
	// You should return '' if you don' t have a value (English will then be used)
	//
    // id             : value
    // -------------- : ---------
    //'logo_gray'     : 'No swekey plugged',
    //'logo_orange'   : 'Authenticating...',
    //'logo_red'      : 'Swekey authentication failed',
    //'logo_green'    : 'Swekey plugged and authentified',
    //'logo_green'    : 'Swekey plugged and validated',
    //'attach_ask'	  : "A swekey authentication key has been detected.\nDo you want to associate it with your account ?",
    //'attach_success': "The plugged swekey is now attached to your account",
    //'attach_failed' : "Failed to attach the plugged swekey to your account",
//	function LocalizedStr($strId)
//	{
//		return '';
//	}



}


?>
