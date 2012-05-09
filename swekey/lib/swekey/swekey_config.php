<?php

$config = array
(
	//
	// By default the swekey module uses the http swekey servers
	// If you need more security use the https server (higher response time)
	//

	'check_server'		=> 'http://auth-check.musbe.net',
	'status_server'		=> 'http://auth-status.musbe.net',
	'rndtoken_server'	=> 'http://auth-rnd-gen.musbe.net',

	//'check_server'		=>'https://auth-check-ssl.musbe.net',
	//'status_server'		=>'https://auth-status-ssl.musbe.net',
	//'rndtoken_server'	=> 'https://auth-rnd-gen-ssl.musbe.net',


	//
	// By default we do allow Swekey users to emulate their Swekey with their Smartphone
	// If your site should not be accessed using smartphone or tablet PC set this value to false.
	//

	'allow_mobile_emulation' => true,


	//
	// By default we do not allow Swekey users to login when the authentication server can not be reached
	// (more secure)
	//

	'allow_when_no_network' => false,


	//
	// By default we allow users that have disabled swekeys 
	// (less secure but user friendly)
	//

	'allow_disabled' => true,


	//
	// By default each user can manage its swekey 
	// Set this value to false if only the admin can manage the swekeys
	//	

	'user_managment' => true,


	//
	// By default we accept all swekeys
	// A brand is a 8 chars hexacimal number (upper case)
	// Brands are coma separated
	//	

	//'brands' => '00000123,00000A4F,00000345',


	//
	// In case of you use a tricky https server you may want to
	// disable the linked OTP feature
	//	

	//	'no_linked_otp' => '',


	//
	// In case of you use a reverse proxy you may want to 
	// hardcode the name of your https server
	//	

	// 'https_server_hostname' => 'my-https-server.mydomain.com',

	
  	//
	// Those 2 values can help you move the swekey logo to align it 
	// with the user_name edit box
	//	

      'logo_xoffset' => '1px',
      'logo_yoffset' => '-2px',
      
	//
	// You can also try to shorten the width of the user_name edit box
	//	
      
    //'loginname_width_offset' => 16,
      
      
 	//
	// With this option you can hide the swekey logo when no swekey are plugged
	//	

    //'show_only_plugged ' => true,
      
      
 	//
	// The swekey logo in tle login page in a link to http://www.swekey.com
	// You can change this value here
	//	

    //'logo_url' => 'http://www.mycompany.com/purchase-swekey.php',
 );

?>