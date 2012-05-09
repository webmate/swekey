<?php

if (empty($_POST))
{
	echo "This is the swekey JSON server.<br>It should be called using a http POST request.";
	exit;
}

include_once(dirname(__FILE__).'/../my_integration.php');

if (session_id() == '')
	session_start();  
 
$integration = new MySwekeyIntegration;
$result = $integration->AjaxHandler($_POST);
		
echo json_encode($result);
?>
