<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  certo web & design GmbH 2012 
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch> 
 * @package    swekey 
 * @license    LGPL 
 * @filesource
 */


include(dirname(__FILE__).'/lib/swekey/swekey_integration.php');

class ContaoSwekeyIntegration extends SwekeyIntegration
{
	/**
	 * Config object
	 * @var SweekeyConfig
	 */
	 private $objConfig = null;

	/**
	 * Initialize the object. Pass your configuration object to the constructor. Dependency Injection.
	 * @param SwekeyConfigInterface A configuration instance
	 */
	public function __construct(SwekeyConfigInterface $objConfig)
	{
		$this->objConfig		= $objConfig;
		$this->show_debug_info	= $this->objConfig->showDebugInfo();
		$this->swekey_dir_url	= Environment::getInstance()->base . 'system/modules/swekey/lib/swekey/';
		$this->input_names		= $this->objConfig->getInputNames();
		$this->is_user_logged	= $this->objConfig->userIsLoggedIn();
	
		if ($this->is_user_logged)
		{
			$this->swekey_id_of_logged_user	= $this->objConfig->getSwekeyId();
			
			// this is special! The Javascript has to be included on every page the user opens, so you have to make sure that your ContaoSwekeyIntegration instance is always initialized
			// as it has to be present on every page, we can simply call the current url and add a certain parameter so we know that we have to call the logout() method of the interface
			$strUrl = Environment::getInstance()->base . Environment::getInstance()->request;
			if (strpos($strUrl, '?') !== false)
			{
				$strUrl .= '&swekeyLogout=' . REQUEST_TOKEN;
			}
			else
			{
				$strUrl .= '?swekeyLogout=' . REQUEST_TOKEN;
			}
			
			$this->logout_url	= $strUrl;
			
			if (Input::getInstance()->get('swekeyLogout') && RequestToken::getInstance()->validate(Input::getInstance()->get('swekeyLogout')))
			{
				$this->objConfig->logout();
			}
		}
		
		$this->lang					= $GLOBALS['TL_LANGUAGE'];
		$this->multiple_logos		= $this->objConfig->hasMultipleLogos();
		$this->dynamic_login_form	= $this->objConfig->hasDynamicLoginForm();
		$this->logFile				= TL_ROOT . '/system/modules/swekey/log/swekey-integration.log';
		
		// Ajax handler
		if (Input::getInstance()->post('swekey_ajax'))
		{
			// make $_POST array secure
			$arrPost = array();
			foreach ($_POST as $k => $v)
			{
				$arrPost[$k] = Input::getInstance()->post($k);
			}

			echo json_encode(array('token'=>REQUEST_TOKEN, 'content'=>$this->AjaxHandler($arrPost)));exit;
		}
	}


	/**
	 * Return the name of the user from a given swekey id 
	 * This is used to auto-fill the username when a swekey is plugged
	 * @param string 32 character swekey id
	 * @return string The user name
	 */
	public function GetUserNameFromSwekeyId($swekey_id)
	{
		return $this->objConfig->getUserNameFromSwekeyId($swekey_id);
	}


	/**
	 * Set the swekey_id of the current user
	 * @param string 32 character swekey id
	 * @return null|string Return null in case of success or a string in case of an error
	 */
	function AttachSwekeyToCurrentUser($swekey_id)
	{
		return $this->objConfig->attachSwekeyToCurrentUser($swekey_id);
	}


	/**
	 * Add your own javascript files
	 * @return string
	 */
	function GetJavaScriptIncludes()
	{
		// Mandatory includes
		$strBuffer = parent::GetJavaScriptIncludes();
		
		// Make sure the request token is set
		$strBuffer .= '<script type="text/javascript">
			REQUEST_TOKEN=\'' . REQUEST_TOKEN . '\';
		</script>'."\n";
		
		// Those includes are necessary for the default inplemtation of the ajax calls.
		// If you want to use you own implementation you can remove the following lines and use your own files. 
		//$strBuffer .= '<script type="text/javascript" src="'.$this->swekey_dir_url.'json/swekey_json_client.js"></script>'."\n";
		$strBuffer .= '<script type="text/javascript" src="' . Environment::getInstance()->base . 'system/modules/swekey/html/contao_json.js"></script>'."\n";
		
		$strBuffer = $this->objConfig->getJavascriptIncludes($strBuffer);
		
		return $strBuffer;
	}


	/**
	 * This method gives you a chance to localize the strings
	 * You should return '' if you don' t have a value (English will then be used)
	 *
	 * id             : value
	 * -------------- : ---------
	 *'logo_gray'     : 'No swekey plugged'
	 *'logo_orange'   : 'Authenticating...'
	 *'logo_red'      : 'Swekey authentication failed'
	 *'logo_green'    : 'Swekey plugged and authentified'
	 *'logo_green'    : 'Swekey plugged and validated'
	 *'attach_ask'	  : "A swekey authentication key has been detected.\nDo you want to associate it with your account ?"
	 *'attach_success': "The plugged swekey is now attached to your account"
	 *'attach_failed' : "Failed to attach the plugged swekey to your account"
	 *
	 * @param string The key to associate the right translation
	 * @return string The translation
	 */
	public function LocalizedStr($strId)
	{
		return $this->objConfig->translate($strId);
	}


	/**
	 * This method allows you to extend the configuration array.
	 * There are a lot of configurations you can do for which you better check the swekey_integration.php file
	 * @return array The modified config array
	 */
	public function GetConfig()
	{
		$arrConfig = array();
		$arrConfig['check_server']		= 'http://auth-check.musbe.net';
		$arrConfig['status_server']		= 'http://auth-status.musbe.net';
		$arrConfig['rndtoken_server']	= 'http://auth-rnd-gen.musbe.net';
		
		if ($this->objConfig->useTlsForServers())
		{
			$arrConfig['check_server']		= 'https://auth-check-ssl.musbe.net';
			$arrConfig['status_server']		= 'https://auth-status-ssl.musbe.net';
			$arrConfig['rndtoken_server']	= 'https://auth-rnd-gen-ssl.musbe.net';
		}
		
		$arrConfig = $this->objConfig->getConfig($arrConfig);
		
		return $arrConfig;
	}
}